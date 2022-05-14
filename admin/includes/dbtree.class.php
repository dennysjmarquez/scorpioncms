<?php

class DbTree
{


    /**
     * Database layer object.
     *
     * @var $db
     */
    protected $db;

    public function __construct($db)
    {

        $this->db = $db;


    }

    /**
     * Converts array of selected fields into part of SELECT query.
     *
     * @param string|array $fields Fields to be selected
     * @param string|null $table - Table or alias to select form
     * @return string - Part of SELECT query
     */
    protected function PrepareSelectFields($fields = '*', string $table = null)
    {
        if (!empty($table)) {
            $table .= '.';
        }

        if (is_array($fields)) {
            $fields = $table . implode(', ' . $table, $fields);
        } else {
            $fields = $table . $fields;
        }

        return $fields;
    }

    /**
     * Receive all data for node with number $nodeId.
     *
     * @param int $nodeId Unique node id
     * @param string|array $fields Fields to be selected
     * @return array All node data
     * @throws USER_Exception
     */
    public function GetNode($set_table, int $nodeId, $fields = '*')
    {

		if ((int)$nodeId === 0) {

			$result = $this->get_root_node($set_table);

		}else{

			$fields = $this->PrepareSelectFields($fields);

			$result = $this->db->prepare("SELECT ".$fields." FROM " . $set_table . " WHERE id = :id");
			$result->bindParam(':id', $nodeId);

			$result->execute();
			$result = $result->fetchall();

			if($result) $result = $result[0];


		}

        return $result;
    }

    /**
     * Receive data of closest parent for node with number $nodeId.
     *
     * @param $set_table
     * @param int $nodeId
     * @return array All node data
     */
    public function GetParent($set_table, int $nodeId)
	{

		$result = $this->db->prepare("SELECT `parent_id` FROM " . $set_table . " WHERE id = :id");
		$result->bindParam(':id', $nodeId);

		$result->execute();
		$result = $result->fetch();

		if($result) $result = $result['parent_id'];

		return $result;
	}


	 public function GetParent2($set_table, $nodeId, $fields = '*', $condition = '')
    {

        $condition = $this->PrepareCondition($condition, false, 'A.');
        $fields = $this->PrepareSelectFields($fields, 'A');

        $node_info = $this->GetNode($set_table, $nodeId);

        $left_id = $node_info['lft'];
        $right_id = $node_info['rgt'];
        $level = $node_info['level'];
        $level--;

        $sql = 'SELECT ' . $fields . ' FROM ' . $set_table . ' AS A';
        $sql .= ' WHERE lft < ' . $left_id . ' AND rgt > ' . $right_id . ' AND level = ' . $level . ' ';
        $sql .= $condition . ' ORDER BY lft';



		$result = $this->db->prepare($sql);
		$result->execute();
		$result = $result->fetchall();


        if (empty($result)) {
            throw new USER_Exception(DBTREE_NO_ELEMENT, 0);
        }

        return $result;
    }


    /**
     * Add new child element to node with number $parentId.
     *
     * @param int $parentId Id of a parental element
     * @param array $data Contains parameters for additional fields of a tree (if is): 'filed name' => 'importance'
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return int Inserted element id
     */
    public function insert($set_table, int $parentId, array $data = array(), $condition = '')
    {

		$parentId = ($parentId === -1) ? 0 : $parentId;

		global $QueryAdmin;
        $node_info = $this->GetNode($set_table, $parentId);

        $right_id = (int)$node_info["rgt"];
        $level = $node_info["level"];

        $condition = $this->PrepareCondition($condition);

        $sql = 'UPDATE ' . $set_table . ' SET ';
        $sql .= 'lft=CASE WHEN lft> :right_id THEN lft+2 ELSE lft END, ';
        $sql .= 'rgt=CASE WHEN rgt>= :right_id  THEN rgt+2 ELSE rgt END ';
        $sql .= 'WHERE rgt>= :right_id';
        $sql .= $condition;

		$result = $this->db->prepare($sql);
		$result->bindParam(':right_id', $right_id, PDO::PARAM_INT);
		$result->execute();


        $data["lft"] = $right_id;
        $data["rgt"] = $right_id + 1;
        $data["level"] = $level + 1;
		$data["parent_id"] = $parentId;

		$SQLInsert = "INSERT INTO ". $set_table ." (".$QueryAdmin->PDOFieldList($data)
		.") VALUES (".$QueryAdmin->PDOValueList($data).")";


		$result = $this->db->prepare($SQLInsert);

		foreach ($data as $field => $item) {

			$result->bindValue(':'.$field, $item);

		}

		$result->execute();

        $node_id = $this->db->lastInsertId();

        return $node_id;
    }

    /**
     * Add a new element into the tree near node with number $nodeId.
     *
     * @param int $nodeId Id of a node after which new node will be inserted (new node will have same level of nesting)
     * @param array $data Contains parameters for additional fields of a tree (if is): 'filed name' => 'importance'
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return int Inserted element id
     */
    public function InsertNear($nodeId, $data = array(), $condition = '', $set_table)
    {
        $node_info = $this->GetNode($nodeId);

        $right_id = $node_info["rgt"];
        $level = $node_info["level"];

        $condition = $this->PrepareCondition($condition);

        $sql = 'UPDATE ' . $set_table . ' SET ';
        $sql .= 'lft = CASE WHEN lft > ' . $right_id . ' THEN lft + 2 ELSE lft END, ';
        $sql .= 'rgt = CASE WHEN rgt> ' . $right_id . ' THEN rgt + 2 ELSE rgt END ';
        $sql .= 'WHERE rgt > ' . $right_id;
        $sql .= $condition;
        $this->db->query($sql);

        $data["lft"] = $right_id + 1;
        $data["rgt"] = $right_id + 2;
        $data["level"] = $level;

        $sql = 'INSERT INTO ?p SET ?u';
        $this->db->query($sql, $set_table, $data);

        $node_id = $this->db->insertId();

        return $node_id;
    }

    /**
     * Assigns another parent ($parentId) to a node ($nodeId) with all its children.
     *
     * @param int $nodeId Movable node id
     * @param int $parentId Id of a new parent node
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return bool True if successful, false otherwise.
     * @throws USER_Exception
     */
    public function MoveAll($set_table, $nodeId, $parentId, $condition = '')
    {
		$parentId = ((int)$parentId === -1) ? 0 : (int)$parentId;



        $node_info = $this->GetNode($set_table, $nodeId);

        $left_id = $node_info["lft"];
        $right_id = $node_info["rgt"];
        $level = $node_info["level"];

		$SQLInsert = "UPDATE " . $set_table  ." SET `parent_id` = :parentId WHERE id = :id";
		$result = $this->db->prepare($SQLInsert);
		$result->bindParam(':id', $nodeId);
		$result->bindParam(':parentId', $parentId);
		$result->execute();


        $node_info = $this->GetNode($set_table, $parentId);




        $left_idp = $node_info["lft"];
        $right_idp = $node_info["rgt"];
        $levelp = $node_info["level"];

        if ($nodeId == $parentId || $left_id == $left_idp || ($left_idp >= $left_id && $left_idp <= $right_id) || ($level == $levelp + 1 && $left_id > $left_idp && $right_id < $right_idp)) {
            return;
        }

        $condition = $this->PrepareCondition($condition);

        $sql = 'UPDATE ' . $set_table . ' SET ';
        if ($left_idp < $left_id && $right_idp > $right_id && $levelp < $level - 1) {
            $sql .= 'level = CASE WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN level' . sprintf('%+d', -($level - 1) + $levelp) . ' ELSE level END, ';
            $sql .= 'rgt = CASE WHEN rgt BETWEEN ' . ($right_id + 1) . ' AND ' . ($right_idp - 1) . ' THEN rgt-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN rgt+' . ((($right_idp - $right_id - $level + $levelp) / 2) * 2 + $level - $levelp - 1) . ' ELSE rgt END, ';
            $sql .= 'lft = CASE WHEN lft BETWEEN ' . ($right_id + 1) . ' AND ' . ($right_idp - 1) . ' THEN lft-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN lft+' . ((($right_idp - $right_id - $level + $levelp) / 2) * 2 + $level - $levelp - 1) . ' ELSE lft END ';
            $sql .= 'WHERE lft BETWEEN ' . ($left_idp + 1) . ' AND ' . ($right_idp - 1);
        } elseif ($left_idp < $left_id) {
            $sql .= 'level = CASE WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN level' . sprintf('%+d', -($level - 1) + $levelp) . ' ELSE level END, ';
            $sql .= 'lft = CASE WHEN lft BETWEEN ' . $right_idp . ' AND ' . ($left_id - 1) . ' THEN lft+' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN lft-' . ($left_id - $right_idp) . ' ELSE lft END, ';
            $sql .= 'rgt = CASE WHEN rgt BETWEEN ' . $right_idp . ' AND ' . $left_id . ' THEN rgt+' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN rgt BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN rgt-' . ($left_id - $right_idp) . ' ELSE rgt END ';
            $sql .= 'WHERE (lft BETWEEN ' . $left_idp . ' AND ' . $right_id . ' ';
            $sql .= 'OR rgt BETWEEN ' . $left_idp . ' AND ' . $right_id . ')';
        } else {
            $sql .= 'level = CASE WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN level' . sprintf('%+d', -($level - 1) + $levelp) . ' ELSE level END, ';
            $sql .= 'lft = CASE WHEN lft BETWEEN ' . $right_id . ' AND ' . $right_idp . ' THEN lft-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN lft+' . ($right_idp - 1 - $right_id) . ' ELSE lft END, ';
            $sql .= 'rgt = CASE WHEN rgt BETWEEN ' . ($right_id + 1) . ' AND ' . ($right_idp - 1) . ' THEN rgt-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN rgt BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN rgt+' . ($right_idp - 1 - $right_id) . ' ELSE rgt END ';
            $sql .= 'WHERE (lft BETWEEN ' . $left_id . ' AND ' . $right_idp . ' ';
            $sql .= 'OR rgt BETWEEN ' . $left_id . ' AND ' . $right_idp . ')';
        }
        $sql .= $condition;

		$result = $this->db->prepare($sql);

		$result->execute();

        return;
    }

    /**
     * Change position of nodes. Nodes have to have same parent and same level of nesting.
     *
     * @param integer $nodeId1 first node id
     * @param integer $nodeId2 second node id
     * @return bool true if successful, false otherwise.
     */
    public function ChangePosition($nodeId1, $nodeId2, $set_table)
    {
        $node_info = $this->GetNode($nodeId1);

        $left_id1 = $node_info["lft"];
        $right_id1 = $node_info["rgt"];
        $level1 = $node_info["level"];

        $node_info = $this->GetNode($nodeId2);

        $left_id2 = $node_info["lft"];
        $right_id2 = $node_info["rgt"];
        $level2 = $node_info["level"];

        $sql = 'UPDATE ' . $set_table . ' SET ';
        $sql .= 'lft = ' . $left_id2 . ', ';
        $sql .= 'rgt = ' . $right_id2 . ', ';
        $sql .= 'level = ' . $level2 . ' ';
        $sql .= 'WHERE id = ' . $nodeId1;
        $this->db->query($sql);

        $sql = 'UPDATE ' . $set_table . ' SET ';
        $sql .= 'lft = ' . $left_id1 . ', ';
        $sql .= 'rgt = ' . $right_id1 . ', ';
        $sql .= 'level = ' . $level1 . ' ';
        $sql .= 'WHERE id = ' . $nodeId2;
        $this->db->query($sql);

        return true;
    }

    /**
     * Swapping nodes with it's children. Nodes have to have same parent and same level of nesting.
     * $nodeId1 can be placed "before" or "after" $nodeId2.
     *
     * @param int $nodeId1 first node id
     * @param int $nodeId2 second node id
     * @param string $position 'before' or 'after' (default) $nodeId2
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return bool true if successful, false otherwise.
     * @throws USER_Exception
     */
    public function ChangePositionAll($nodeId1, $nodeId2, $position = 'after', $condition = '', $set_table)
    {
        if ($position != 'after' && $position != 'before') {
            throw new USER_Exception(DBTREE_INCORRECT_POSITION, 0);
        }

        $node_info = $this->GetNode($nodeId1);

        $left_id1 = $node_info["lft"];
        $right_id1 = $node_info["rgt"];
        $level1 = $node_info["level"];

        $node_info = $this->GetNode($nodeId2);

        $left_id2 = $node_info["lft"];
        $right_id2 = $node_info["rgt"];
        $level2 = $node_info["level"];

        if ($level1 <> $level2) {
            throw new USER_Exception(DBTREE_CANT_CHANGE_POSITION, 0);
        }

        $sql = 'UPDATE ' . $set_table . ' SET ';
        if ('before' == $position) {
            if ($left_id1 > $left_id2) {
                $sql .= 'rgt = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN rgt - ' . ($left_id1 - $left_id2) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . $left_id2 . ' AND ' . ($left_id1 - 1) . ' THEN rgt +  ' . ($right_id1 - $left_id1 + 1) . ' ELSE rgt END, ';
                $sql .= 'lft = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN lft - ' . ($left_id1 - $left_id2) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . $left_id2 . ' AND ' . ($left_id1 - 1) . ' THEN lft + ' . ($right_id1 - $left_id1 + 1) . ' ELSE lft END ';
                $sql .= 'WHERE lft BETWEEN ' . $left_id2 . ' AND ' . $right_id1;
            } else {
                $sql .= 'rgt = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN rgt + ' . (($left_id2 - $left_id1) - ($right_id1 - $left_id1 + 1)) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . ($right_id1 + 1) . ' AND ' . ($left_id2 - 1) . ' THEN rgt - ' . (($right_id1 - $left_id1 + 1)) . ' ELSE rgt END, ';
                $sql .= 'lft = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN lft + ' . (($left_id2 - $left_id1) - ($right_id1 - $left_id1 + 1)) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . ($right_id1 + 1) . ' AND ' . ($left_id2 - 1) . ' THEN lft - ' . ($right_id1 - $left_id1 + 1) . ' ELSE lft END ';
                $sql .= 'WHERE lft BETWEEN ' . $left_id1 . ' AND ' . ($left_id2 - 1);
            }
        }

        if ('after' == $position) {
            if ($left_id1 > $left_id2) {
                $sql .= 'rgt = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN rgt - ' . ($left_id1 - $left_id2 - ($right_id2 - $left_id2 + 1)) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . ($right_id2 + 1) . ' AND ' . ($left_id1 - 1) . ' THEN rgt +  ' . ($right_id1 - $left_id1 + 1) . ' ELSE rgt END, ';
                $sql .= 'lft = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN lft - ' . ($left_id1 - $left_id2 - ($right_id2 - $left_id2 + 1)) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . ($right_id2 + 1) . ' AND ' . ($left_id1 - 1) . ' THEN lft + ' . ($right_id1 - $left_id1 + 1) . ' ELSE lft END ';
                $sql .= 'WHERE lft BETWEEN ' . ($right_id2 + 1) . ' AND ' . $right_id1;
            } else {
                $sql .= 'rgt = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN rgt + ' . ($right_id2 - $right_id1) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . ($right_id1 + 1) . ' AND ' . $right_id2 . ' THEN rgt - ' . (($right_id1 - $left_id1 + 1)) . ' ELSE rgt END, ';
                $sql .= 'lft = CASE WHEN lft BETWEEN ' . $left_id1 . ' AND ' . $right_id1 . ' THEN lft + ' . ($right_id2 - $right_id1) . ' ';
                $sql .= 'WHEN lft BETWEEN ' . ($right_id1 + 1) . ' AND ' . $right_id2 . ' THEN lft - ' . ($right_id1 - $left_id1 + 1) . ' ELSE lft END ';
                $sql .= 'WHERE lft BETWEEN ' . $left_id1 . ' AND ' . $right_id2;
            }
        }

        $condition = $this->PrepareCondition($condition);

        $sql .= $condition;
        $this->db->query($sql);

        return true;
    }

    /**
     * Deletes element with number $nodeId from the tree without deleting it's children
     * All it's children will move up one level.
     *
     * @param integer $nodeId Node id
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return bool true if successful, false otherwise.
     */
    public function Delete($set_table, $nodeId, $condition = '')
    {
        $node_info = $this->GetNode($set_table, $nodeId);

        $condition = $this->PrepareCondition($condition);

        $left_id = $node_info["lft"];
        $right_id = $node_info["rgt"];

        $sql = 'DELETE FROM ' . $set_table . ' WHERE id = ' . $nodeId;
        $this->db->query($sql);

        $sql = 'UPDATE ' . $set_table . ' SET ';
        $sql .= 'level = CASE WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN level - 1 ELSE level END, ';
        $sql .= 'rgt = CASE WHEN rgt BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN rgt - 1 ';
        $sql .= 'WHEN rgt > ' . $right_id . ' THEN rgt - 2 ELSE rgt END, ';
        $sql .= 'lft = CASE WHEN lft BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN lft - 1 ';
        $sql .= 'WHEN lft > ' . $right_id . ' THEN lft - 2 ELSE lft END ';
        $sql .= 'WHERE rgt > ' . $left_id;
        $sql .= $condition;

		$result = $this->db->prepare($sql);
		$result->execute();

		$result = $this->db->prepare("UPDATE " . $set_table . " SET parent_id = ".$node_info['parent_id']." WHERE parent_id = :id");
		$result->bindParam(':id', $node_info['id']);

		$result->execute();

        return ;
    }

    /**
     * Deletes element with number $nodeId from the tree and all it children.
     *
     * @param integer $nodeId Node id
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return bool true if successful, false otherwise.
     */
    public function DeleteAll($nodeId, $condition = '', $set_table)
    {
        $node_info = $this->GetNode($nodeId);

        $left_id = $node_info["lft"];
        $right_id = $node_info["rgt"];

        $condition = $this->PrepareCondition($condition);

        $sql = 'DELETE FROM ' . $set_table . ' WHERE lft BETWEEN ' . $left_id . ' AND ' . $right_id;
        $sql .= $condition;
        $this->db->query($sql);

        $delta_id = (($right_id - $left_id) + 1);
        $sql = 'UPDATE ' . $set_table . ' SET ';
        $sql .= 'lft = CASE WHEN lft > ' . $left_id . ' THEN lft - ' . $delta_id . ' ELSE lft END, ';
        $sql .= 'rgt = CASE WHEN rgt > ' . $left_id . ' THEN rgt - ' . $delta_id . ' ELSE rgt END ';
        $sql .= 'WHERE rgt > ' . $right_id;
        $sql .= $condition;
        $this->db->query($sql);

        return true;
    }

    /**
     * Transforms array with conditions to SQL query
     * Array structure:
     * array('and' => array('id = 0', 'id2 >= 3'), 'or' => array('sec = \'www\'', 'sec2 <> \'erere\'')), etc
     * where array key - condition (AND, OR, etc), value - condition string.
     *
     * @param array $condition
     * @param string $prefix
     * @param bool $where - true - yes, false (dafault) - not
     * @return string
     */
    protected function PrepareCondition($condition, $where = false, $prefix = '')
    {
        if (empty ($condition)) {
            return '';
        }

        if (!is_array($condition)) {
            return $condition;
        }

        $sql = ' ';

        if (true === $where) {
            $sql .= 'WHERE ' . $prefix;
        }

        $keys = array_keys($condition);

        for ($counter = count($keys), $i = 0; $i < $counter; $i++) {
            if (false === $where || (true === $where && $i > 0)) {
                $sql .= ' ' . strtoupper($keys[$i]) . ' ' . $prefix;
            }

            $sql .= implode(' ' . strtoupper($keys[$i]) . ' ' . $prefix, $condition[$keys[$i]]);
        }

        return $sql;
    }
}

?>
