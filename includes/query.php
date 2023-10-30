<?php

class Query
{

    private $PostTotal = 0;
    private $have_posts;
    private $bucle = -1;
    private $totalbuche;
    private $result = null;
    private $post;
    private $ActualPaginaPost;
    private $ActualPaginaComment;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function GetTitle($Value = null)
    {

        global $dbh;
        global $Corel;

        if ($Corel->is_front_page()) {

            $vars = "sitename";

            $result = $dbh->prepare("SELECT `value` FROM `config` WHERE `name` = :vars");
            $result->bindValue(':vars', $vars, PDO::PARAM_STR);
            $result = $result->executeQuery()->fetchAssociative();
            return $result["value"];

        }
        if ($Corel->is_404()) {

            return lang_s("page_not_found", true);

        }
        if ($Corel->is_single()) {

            if (array_key_exists("title", $this->result[0])) {

                echo $this->result[0]["title"];

            }

        } else {

            global $lang;
            return $lang->_s("page_not_found");

        }

    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    private function PostTotal()
    {

        global $dbh;

        $var1 = "post";
        $var2 = "publish";
        $result = $dbh->prepare("SELECT COUNT(*) total FROM `post` WHERE `type` = :var1 AND `status` = :var2");

        $result->bindValue(':var1', $var1, PDO::PARAM_STR);
        $result->bindValue(':var2', $var2, PDO::PARAM_STR);
        $result = $result->executeQuery()->fetchAssociative();
        $result = $result["total"];

        return (int)$result;


    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function get_comments_number($value = null)
    {

        global $dbh;

        if (null == $value) {

            $var = $this->post["id"];
            $result = $dbh->prepare("SELECT COUNT(*) total FROM `comment` WHERE `post_id` = :var");
            $result->bindValue(':var', $var, PDO::PARAM_STR);
            $result = $result->executeQuery()->fetchAssociative();
            $result = $result["total"];

            echo $result;

        } else {


            $var = $value;
            $result = $dbh->prepare("SELECT COUNT(*) total FROM `comment` WHERE `post_id` = :var");
            $result->bindValue(':var', $var, PDO::PARAM_STR);
            $result = $result->executeQuery()->fetchAssociative();
            $result = $result["total"];

            echo $result;

        }


    }

    private function closetags($html)
    {

        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</' . $openedtags[$i] . '>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }


    public function the_title()
    {

        if (array_key_exists("title", $this->result[($this->bucle)])) {

            echo $this->result[$this->bucle]["title"];

        }

    }

    public function get_views()
    {

        if (array_key_exists("views", $this->result[$this->bucle])) {

            echo $this->result[$this->bucle]["views"];

        } else {

            echo null;

        }

    }

    public function the_content($value = null)
    {

        if (array_key_exists("content", $this->result[$this->bucle])) {

            if ($value == "short") {

                $content = $this->result[$this->bucle]["content"];

                if (preg_match('/<!--readmore(.*?)?-->/', $content, $matches)) {

                    $content = explode($matches[0], $this->result[$this->bucle]["content"], 2);
                    $content = $content[0];

                    echo $this->closetags('<div>' . $content . '</div>');

                } else {
                    echo $content;
                }

            } elseif (null == $value) {

                $content = $this->result[$this->bucle]["content"];


                $content = str_replace('<!--readmore-->', '', $content);

                $content = preg_replace('/<!--readmore(.*?)?-->/', '&lt;$1', $content);

                echo $content;

            }

        }

    }

    public function get_post_format()
    {

        if (array_key_exists("post_type", $this->result[($this->bucle)])) {

            return $this->result[$this->bucle]["post_type"];

        }

    }

    public function the_permalink()
    {

        if (array_key_exists("name", $this->result[($this->bucle)])) {

            echo get_config("siteurl") . "/" . get_config("suf_post") . "/" . $this->result[$this->bucle]["name"];

        }

    }


    public function have_posts()
    {

        if ($this->result) {

            if ($this->bucle + 1 < $this->totalbuche) {

                $this->bucle++;
                return true;

            } elseif ($this->bucle + 1 == $this->totalbuche && $this->totalbuche > 0) {

                return false;
                $this->bucle - 1;

            }

        }

    }

    public function post()
    {

        return $this->post;

    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function the_post()
    {

        global $dbh;

        $post_id = $this->result[$this->bucle]["id"];

        $result = $dbh->prepare("SELECT `value` FROM `postmeta` WHERE `post_id` = :post_id AND `name` = '_views' ");
        $result->bindValue(':post_id', $post_id, PDO::PARAM_STR);
        $result = $result->executeQuery()->fetchAllAssociative();

        if ($result) {

            $result = $result["value"];
            $this->result[$this->bucle]["views"] = $result;

        } else {

            $this->result[$this->bucle]["views"] = 0;

        }

        $this->post = $this->result[$this->bucle];


    }

    public function Pagination($value = null, $cuantas = null)
    {

        if (null == $cuantas) {
            $cuantas = 5;
        }

        if ($this->PostTotal === 0) return;


        $page = $this->ActualPaginaPost;
        $numPages = (int)ceil($this->PostTotal / get_config("posts_per_page"));
        $neHalf = ceil($cuantas / 2);
        $upperLimit = $numPages - $cuantas;
        $start = $page > $neHalf ? max(min($page - $neHalf, $upperLimit), 0) : 0;
        $end = $page > $neHalf ? min($page + $neHalf - ($cuantas % 2 > 0 ? 1 : 0), $numPages) : min($cuantas, $numPages);

        $p["pages"] = array();

        if ($cuantas > $numPages && $numPages !== 1) {
            $cuantas = $numPages;
        } elseif ($numPages == 1) {
            return;
        }

        $p["current"] = $this->ActualPaginaPost;

        if ($page == $numPages) {
            $p["next"]["active"] = false;
            $p["next"]["link"] = null;
        } else {
            $p["next"]["active"] = true;
            $p["next"]["link"] = get_config("siteurl") . "/page/" . ($page + 1) . "/";
        }

        if ($page > 1) {
            $p["previous"]["active"] = true;
            $p["previous"]["link"] = get_config("siteurl") . "/page/" . ($page - 1) . "/";
        } else {
            $p["previous"]["active"] = false;
            $p["previous"]["link"] = null;
        }

        for ($i = 1; $i <= $cuantas; $i++) {

            if ($page >= $cuantas && $i == 1 && ($start + $i) !== 1 && $cuantas + 1 != $numPages) {

                $p["pages"][count($p["pages"])]["texto"] = "1";
                $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/1/";
                $p["pages"][count($p["pages"])]["texto"] = "...";
                $p["pages"][count($p["pages"]) - 1]["link"] = null;
                $p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
                $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/" . strval($start + $i) . "/";


            } elseif ($page + 1 >= $cuantas && $i == 1 && ($start + $i) !== 1) {

                $p["pages"][count($p["pages"])]["texto"] = "1";
                $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/1/";
                $p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
                $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/" . strval($start + $i) . "/";

            } else {

                if ($i == $cuantas && $end + 1 !== $numPages && $end + 1 < $numPages) {

                    $p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
                    $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/" . strval($start + $i) . "/";
                    $p["pages"][count($p["pages"])]["texto"] = "...";
                    $p["pages"][count($p["pages"]) - 1]["link"] = null;
                    $p["pages"][count($p["pages"])]["texto"] = strval($numPages);
                    $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/" . strval($numPages) . "/";

                } elseif ($i == $cuantas && $end !== $numPages) {

                    $p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
                    $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/" . strval($start + $i) . "/";
                    $p["pages"][count($p["pages"])]["texto"] = strval($numPages);
                    $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/" . strval($numPages) . "/";


                } else {

                    $p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
                    $p["pages"][count($p["pages"]) - 1]["link"] = get_config("siteurl") . "/page/" . strval($start + $i) . "/";


                }

            }

        }

        return $p;

        if (null == $value) {


        } else if ($value == "comment") {


        }

    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function GetPost($value = null, $value2 = null)
    {

        global $dbh;

        if (null == $value && null == $value2) {

            $value = 1;

            $this->PostTotal = $this->PostTotal();
            @$totaldepaginas = ceil($this->PostTotal / get_config("posts_per_page"));

            $offset = (($value - 1) * (int)get_config("posts_per_page"));
            $limit = (int)get_config("posts_per_page");


            $var1 = "post";
            $var2 = "publish";
            $result = $dbh->prepare("SELECT * FROM `post` WHERE `type` = :var1 AND `status` = :var2 ORDER BY `id` ASC LIMIT :offset, :limit");

            $result->bindValue(':var1', $var1, PDO::PARAM_STR);
            $result->bindValue(':var2', $var2, PDO::PARAM_STR);
            $result->bindValue(':offset', $offset, PDO::PARAM_INT);
            $result->bindValue(':limit', $limit, PDO::PARAM_INT);

            $this->result = $result->executeQuery()->fetchAllAssociative();

            $this->totalbuche = (count($this->result));
            $this->ActualPaginaPost = $value;

            if ($this->result) {
                return true;
            } else {
                return false;
            }


        } elseif (null == $value2) {

            if ($value <= 0) return false;

            $this->PostTotal = $this->PostTotal();
            @$totaldepaginas = ceil($this->PostTotal / get_config("posts_per_page"));


            if ($value > $totaldepaginas) {

                return false;

            } else {


                $offset = (($value - 1) * (int)get_config("posts_per_page"));
                $limit = (int)get_config("posts_per_page");
                $var1 = "post";
                $var2 = "publish";
                $result = $dbh->prepare("SELECT * FROM `post` WHERE `type` = :var1 AND `status` = :var2 ORDER BY `id` ASC LIMIT :offset, :limit");

                $result->bindValue(':var1', $var1, PDO::PARAM_STR);
                $result->bindValue(':var2', $var2, PDO::PARAM_STR);
                $result->bindValue(':offset', $offset, PDO::PARAM_INT);
                $result->bindValue(':limit', $limit, PDO::PARAM_INT);

                $this->result = $result->executeQuery()->fetchAssociative();

                $this->totalbuche = count($this->result);
                $this->ActualPaginaPost = $value;
                return true;

            }


        } elseif ($value2 == "single") {

            $var1 = "post";
            $var2 = "publish";
            $var3 = $value;
            $result = $dbh->prepare("SELECT * FROM `post` WHERE `type` = :var1 AND `status` = :var2 AND `name` = :var3");

            $result->bindValue(':var1', $var1, PDO::PARAM_STR);
            $result->bindValue(':var2', $var2, PDO::PARAM_STR);
            $result->bindValue(':var3', $var3, PDO::PARAM_STR);

            $this->result = $result->executeQuery()->fetchAllAssociative();

            $this->totalbuche = (count($this->result));

            if ($this->result) {
                return true;
            } else {
                return false;
            }


        } else {

            return false;

        }

    }


}
