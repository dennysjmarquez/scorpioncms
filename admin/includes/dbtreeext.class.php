<?php

class DbTreeExt extends DbTree
{
    /**
     * Database layer object.
     *
     * @var db
     */
    protected $db;
    public $TreeTotal;
	public $IdRoot = [];

    /**
     * Constructor.
     *
     * @param array $fields See description of "DbTree" class properties
     * @param object $db Database layer
     * @param string $lang Current language for messaging
     */
    public function __construct() {

		global $dbh;
        $this->db = $dbh;
        parent:: __construct($this->db);
		
    }

    /**
     * Returns all elements of the tree sorted by "left".
     *
     * @param string|array $fields Fields to be selected
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return array Needed fields
     */
	 
	private function TreeTotal($set_table) {

		$result = $this->db->prepare("SELECT COUNT(*) total FROM " . $set_table);

		$result->execute();
		$result = $result->fetch();
		$result = $result["total"];
		$this->TreeTotal = $result;
		return $result;
	
	} public function get_root_node($set_table){
		
		$result = $this->db->prepare("SELECT * FROM " . $set_table . " WHERE `level` = 0 ");
		$result->execute();
		$result = $result->fetchall();
		
		if($result){
		
			$this->IdRoot[$set_table] = isset($this->IdRoot[$set_table]) ? $this->IdRoot[$set_table] :  $result[0]['id'];	
			
		}

        return $result[0];
		
	} public function get_single_to_id($set_table, $value = null){
		
		if(null === $value) return;

		$result = $this->db->prepare("SELECT * FROM " . $set_table . " WHERE id = :id");
		$result->bindParam(':id', $value, PDO::PARAM_INT);
		$result->execute();
		$result = $result->fetchall();
		
		return $result;
		
		
		
	}
	
    public function Full($set_table, $value = 1, $vlimit = true, $EexcludeDefault = false) {
		
		global $QueryAdmin;

		if ($vlimit === true){
		
			$TreeTotal = $this->TreeTotal($set_table);
			@$totaldepaginas = ceil( $TreeTotal / get_config("posts_per_page") );
			if($value > $totaldepaginas) return false;
			
			$offset = ( ( $value - 1 ) * (int)get_config("posts_per_page") );
			$limit = (int)get_config("posts_per_page");
		
			$result = $this->db->prepare("SELECT * FROM " . $set_table . " ORDER BY lft ASC LIMIT :offset, :limit");
			$result->bindParam(':offset', $offset, PDO::PARAM_INT);
			$result->bindParam(':limit', $limit, PDO::PARAM_INT);
		
		}elseif ($vlimit === false){

			$result = $this->db->prepare("SELECT * FROM " . $set_table . " ORDER BY lft ASC");
			
		}

		$result->execute();
		$result = $result->fetchall();
		$newresult = [];
		
		
		
		foreach($result as $item){
			
			if($EexcludeDefault === false && (int)$item['level'] === 0){
				
				$item['name'] = ('_'.$item['name'] === lang_s('_'.$item['name'],true)) ? $item['name'] : lang_s('_'.$item['name'],true);
				$newresult[] = $item;
			
			}elseif($EexcludeDefault === true && (int)$item['level'] !== 0){

				$newresult[] = $item;
				
			}elseif($EexcludeDefault === false && (int)$item['level'] !== 0 ){
				
				$newresult[] = $item;
				
			}
			
		}
		
		
		
        return $newresult;
    }

    /**
     * Returns all elements of a branch starting from an element with number $nodeId.
     *
     * @param integer $nodeId Node unique id
     * @param string|array $fields Fields to be selected
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return array Needed fields
     */
    function Branch($nodeId, $fields = '*', $condition = '', $set_table)
    {

        $condition = $this->PrepareCondition($condition, false, 'A.');
        $fields = $this->PrepareSelectFields($fields, 'A');

        $sql = 'SELECT A.id, A.lft, A.rgt, A.level, ' . $fields . ', CASE WHEN A.lft + 1 < A.rgt THEN 1 ELSE 0 END AS nflag ';
        $sql .= 'FROM ' . $set_table . ' B, ' . $set_table . ' A ';
        $sql .= 'WHERE B.id = ' . (int)$nodeId . ' AND A.lft >= B.lft AND A.rgt <= B.rgt';
        $sql .= $condition;
        $sql .= ' ORDER BY A.lft';
        $result = $this->db->getInd("id", $sql);

		
		
		
        return $result;
    }

	public function checkExitsName($set_table, $nodeId, $name){
	
		$nodeId = ((int)$nodeId === -1) ? 0 : (int)$nodeId;
	
		$result = $this->db->prepare("SELECT `name` FROM {$set_table} WHERE parent_id = :nodeId AND name = :name LIMIT 1");
		$result->bindParam(':nodeId', $nodeId, PDO::PARAM_INT);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->execute();
		$result = $result->fetch();
		 
		 
		 
		if($result) {
			return true; 
		}else{
			return false;
		}
	
	
	}
	 
	public function get_parent_id($set_table, $nodeId){
		
		$result = $this->db->prepare("SELECT `parent_id` FROM {$set_table} WHERE id = :nodeId ");
		$result->bindParam(':nodeId', $nodeId, PDO::PARAM_INT);
		$result->execute();
		$result = $result->fetch();
		
		if($result){
			
			$result = $result['parent_id'];
			
		}else{
			
			$result = null;
		}
		
			
		return $result;
		
	}

    /**
     * Returns all parents of element with number $nodeId.
     *
     * @param integer $nodeId Node unique id
     * @param string|array $fields Fields to be selected
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return array Needed fields
     */

	
    function Parents($set_table, $nodeId)
    {
		
		//$result = $this->db->prepare("SELECT A.id, A.lft, A.rgt, A.level, A.*, CASE WHEN A.lft + 1 < A.rgt THEN 1 ELSE 0 END AS nflag FROM {$set_table} B, {$set_table} A WHERE B.id = :nodeId AND B.lft BETWEEN A.lft AND A.rgt ORDER BY A.lft");
		
		if ((int)$nodeId === (int)$this->get_root_node($set_table)['id']){
			
			$result = $this->db->prepare("SELECT * FROM {$set_table} WHERE id = :nodeId ");
			$result->bindParam(':nodeId', $nodeId, PDO::PARAM_INT);

		
		}else{
			
			$result = $this->db->prepare("SELECT A.id, A.lft, A.rgt, A.level, A.*, A.lft + 1 < A.rgt FROM {$set_table} B, {$set_table} A WHERE B.id = :nodeId AND A.lft > 1 AND B.lft BETWEEN A.lft AND A.rgt ORDER BY A.lft");
			$result->bindParam(':nodeId', $nodeId, PDO::PARAM_INT);
			
		}
		
		$result->execute();
		
		$result = $result->fetchall();		
		
		$newresult = [];
		
		foreach($result as $item){
			
			if ((int)$item['level'] === 0){
				
				$item['name'] = ('_'.$item['name'] === lang_s('_'.$item['name'],true)) ? $item['name'] : lang_s('_'.$item['name'],true);

			}
			
			$newresult[] = $item;
			
		}		
		
        return $newresult;
    }

    /**
     * Returns a slightly opened tree from an element with number $nodeId.
     *
     * @param integer $nodeId Node unique id
     * @param string|array $fields Fields to be selected
     * @param string|array $condition array key - condition (AND, OR, etc), value - condition string
     * @return array Needed fields
     * @throws USER_Exception
     */
    function Ajar($nodeId, $fields = '*', $condition = '', $set_table)
    {
        $condition = $this->PrepareCondition($condition, false, 'A.');

        $sql = 'SELECT A.lft, A.rgt, A.level ';
        $sql .= 'FROM ' . $set_table . ' A, ' . $set_table . ' B ';
        $sql .= 'WHERE B.id = ' . $nodeId . ' ';
        $sql .= 'AND B.lft BETWEEN A.lft ';
        $sql .= 'AND A.rgt';
        $sql .= $condition;
        $sql .= ' ORDER BY A.lft';
        $res = $this->db->query($sql);

        if (0 == $this->db->numRows($res)) {
            throw new USER_Exception(DBTREE_NO_ELEMENT, 0);
        }

        $alen = $this->db->numRows($res);
        $i = 0;

        $fields = $this->PrepareSelectFields($fields, 'A');

        $sql = 'SELECT A.id, A.lft, A.rgt, A.level, ' . $fields . ' ';
        $sql .= 'FROM ' . $set_table . ' A ';
        $sql .= 'WHERE (level = 1';
        while ($row = $this->db->fetch($res)) {
            if ((++$i == $alen) && ($row["lft"] + 1) == $row["rgt"]) {
                break;
            }
            $sql .= ' OR (level = ' . ($row["level"] + 1) . ' AND lft > ' . $row["lft"] . ' AND rgt < ' . $row["rgt"] . ')';
        }
        $sql .= ') ' . $condition;
        $sql .= ' ORDER BY lft';

        $result = $this->db->getInd("id", $sql);

        return $result;
    }

    /**
     * Sort children in a tree for $orderField in alphabetical order.
     *
     * @param integer $id - Parent's ID.
     * @param string $orderField - the name of the field on which sorting will go
     */
    public function SortChildren($id, $orderField, $set_table)
    {
        $node = $this->GetNode($id);
        $data = $this->Branch(
            $id,
            array(
                "id"
            ), array(
                'and' => array(
                    'level = ' . ($node["level"] + 1)
                )
            )
        );

        if (!empty($data)) {
            $sql = 'SELECT id FROM ' . $set_table . ' WHERE id IN(?a) ORDER BY ' . $orderField;
            $sorted_data = $this->db->getAll($sql, array_keys($data));

            $data = array_values($data);

            $last_coincidence = true;
            foreach ($sorted_data as $key => $value) {
                if ($data[$key]["id"] == $value["id"] && $last_coincidence !== false) {
                    continue;
                } else {
                    $last_coincidence = false;

                    if ($key == 0) {
                        $this->ChangePositionAll($value["id"], $data[$key]["id"], 'before');
                    } else {
                        $this->ChangePositionAll($sorted_data[($key)]["id"], $sorted_data[($key - 1)]["id"], 'after');
                    }
                }
            }
        }
    }

    /**
     * Makes UL/LI html from nested sets tree with links (if needed). UL id named as table_name + _tree.
     *
     * @param array $tree - nested sets tree array
     * @param string $nameField - name of field that contains title of URL
     * @param array $linkField - name of field that contains URL (if needed)
     * @param null|string $linkPrefix - URL prefix (if needed)
     * @param string $delimiter - linkField delimiter
     * @return string - UL/LI html code
     */
    public function MakeUlList($tree, $nameField, $linkField = array(), $linkPrefix = null, $delimiter = '', $set_table)
    {
        $current_depth = 0;
        $node_depth = 0;
        $counter = 0;

        $result = '<ul id="' . $set_table . '_tree">';

        foreach ($tree as $node) {
            $node_depth = $node["level"];
            $node_name = $node[$nameField];

            if ($node_depth == $current_depth) {
                if ($counter > 0) $result .= '</li>';
            } elseif ($node_depth > $current_depth) {
                $result .= '<ul>';
                $current_depth = $current_depth + ($node_depth - $current_depth);
            } elseif ($node_depth < $current_depth) {
                $result .= str_repeat('</li></ul>', $current_depth - $node_depth) . '</li>';
                $current_depth = $current_depth - ($current_depth - $node_depth);
            }

            $result .= '<li>';

            if (!empty($linkField)) {
                $link_data = array();
                $linkField = !is_array($linkField) ? array($linkField) : $linkField;
                foreach($linkField as $field) {
                    $link_data[] = $node[$field];
                }

                $link = !is_null($linkPrefix) ? $linkPrefix . implode($delimiter, $link_data) : implode($delimiter, $link_data);

                $result .= '<a href="' . $link . '">' . $node_name . '</a>';
            } else {
                $result .= $node_name;
            }
            ++$counter;
        }

        $result .= str_repeat('</li></ul>', $node_depth) . '</li>';

        $result .= '</ul>';

        return $result;
    }
}

?>