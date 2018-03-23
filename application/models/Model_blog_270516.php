<?php

/**
 * PHP model_blog
 *
 * LICENSE
 *
 * model_stores is released with dual licensing, using the GPL v3 (license-gpl3.txt) and the MIT license (license-mit.txt).
 * You don't have to do anything special to choose one license or the other and you don't have to notify anyone which license you are using.
 * Please see the corresponding license file for details of these licenses.
 * You are free to use, modify and distribute this software, but all copyright information must remain.
 *
 * @package    	model_stores
 * @copyright  	Copyright (c) 2014 through 2014, JuanJo Camps
 * @license    	https://github.com/scoumbourdis/grocery-crud/blob/master/license-grocery-crud.txt
 * @version    	1.0
 * @author     	Juanjo Camps Ivars <juanjo.campsj@gmail.com>
 */
// ------------------------------------------------------------------------

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_blog extends CI_Model {

    public function __construct() {
        parent::__construct();

        //$this->load->model('model_nav');
        /* Standard Libraries of codeigniter are required */
        $this->load->database();
    }

    function GetLanguageCountry($country_id) {
        
        $lang_id= $this->GetLangCountry($country_id);

        $sql = " SELECT * FROM gnr_lang WHERE lang_id = ? ";
        $query = $this->db->query($sql, array($lang_id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $language_name = $row->lang_denom;
            }
        }
        return $language_name;
    }

    function GetNameCountry($country_id) {
        $lang_id = 29;

        $sql = " SELECT * FROM gnr_country WHERE country_id = ? ";
        $query = $this->db->query($sql, array($country_id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $country_name = $row->country_name;
            }
        }
        return $country_name;
    }

    function GetLangCountry($country_id) {
        $lang_id = 29;

        $sql = " SELECT * FROM gnr_country WHERE country_id = ? ";
        $query = $this->db->query($sql, array($country_id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $lang_id = $row->country_official_lang;
            }
        }
        return $lang_id;
    }

    function GetIsoCountry($country_id) {
        $iso = "es";

        $sql = " SELECT * FROM gnr_country WHERE country_id = ? ";
        //echo $sql;
        $query = $this->db->query($sql, $country_id);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $iso = strtolower($row->country_iso);
            }
        }
        return $iso;
    }

    
    public function GetLastPosts($num_posts) {


        $carpeta = $this->uri->segment(1);

        $sql = "SELECT *,DATE_FORMAT(post_date,'%b') as mes,
            DATE_FORMAT(post_date,'%d') as dia 
            FROM gnr_post
            WHERE post_folder='$carpeta' AND post_visible='Mostrar' 
            ORDER BY post_date DESC LIMIT 0,$num_posts ";


        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //foreach ($query->result() as $row) {
            //	return $row->country_id;
            return $query->result();
        }
    }

    public function GetPosts($desde, $num, $category_id = null) {

        $carpeta = $this->uri->segment(1);
		date_default_timezone_set('Europe/Madrid');
		$date = date('Y-m-d H:i:s');
		
        // echo $carpeta;

        if ($category_id == null)
            $where = " AND post_category_id > 0 AND post_folder='$carpeta' AND post_visible='Mostrar' AND post_date < '$date'";
        else
            $where = " AND post_category_id = $category_id AND post_folder='$carpeta' AND post_visible='Mostrar' AND post_date < '$date'";
        //    $where = " AND post_slug = $category_id ";

        $sql = "SELECT *,DATE_FORMAT(post_date,'%b') as mes,

            DATE_FORMAT(post_date,'%d') as dia
             FROM gnr_post
             WHERE 1 = 1 $where
             ORDER BY post_date DESC
             LIMIT $desde,$num ";

        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //foreach ($query->result() as $row) {
            //	return $row->country_id;
            return $query->result();
        }
    }

    public function GetNumPosts() {

        $carpeta = $this->uri->segment(1);
		date_default_timezone_set('Europe/Madrid');
		$date = date('Y-m-d H:i:s');
		
        $sql = "SELECT count(*) as num
              FROM gnr_post  
              WHERE post_folder='$carpeta' AND post_visible='Mostrar' AND post_date < '$date'";
//      echo $sql;
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->num;
                //      return $query->result();
            }
        }
    }

    public function GetPost($post_slug = null) {

        $carpeta = $this->uri->segment(1);
//      if ($post_id==null)
//        $where = " AND post_id > 0 ";
//      else
        $where = " AND post_folder='$carpeta' AND post_slug = '$post_slug' AND post_visible='Mostrar' ";

        $sql = "SELECT *,DATE_FORMAT(post_date,'%b') as mes,

            DATE_FORMAT(post_date,'%d') as dia
             FROM gnr_post
             WHERE 1 = 1 $where
             ORDER BY post_date";

  //      echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //foreach ($query->result() as $row) {
            //	return $row->country_id;
            return $query->result();
        }
    }

    public function GetPostsByTag($tag_slug = null) {

        $carpeta = $this->uri->segment(1);

        if ($tag_slug == null)
            $where = " AND tag_folder='$carpeta' AND tag_id > 0 ";
        else
            $where = " AND tag_folder='$carpeta' AND tag_slug = '$tag_slug' ";

        $tag_name = $this->GetTagName($tag_slug);

        $where = " AND post_tag_id LIKE '%$tag_name%' ";

        $sql = "SELECT *,DATE_FORMAT(post_date,'%b') as mes,

            DATE_FORMAT(post_date,'%d') as dia
             FROM gnr_post
             WHERE post_folder='$carpeta' AND post_visible='Mostrar' $where
             ORDER BY post_date";

        //  echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //foreach ($query->result() as $row) {
            //	return $row->country_id;
            return $query->result();
        }
    }

    public function GetTagName($tag_slug) {

        $sql = "SELECT *
             FROM gnr_tag

             WHERE tag_id='$tag_slug'

             ORDER BY tag_name";


        //    echo $sql;

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->tag_name;
                //return $query->result();
            }
        }

        return null;
    }

    /*
     * 
     * Tags que tienen al menos un post
     */

    // public function GetTagsInPosts() {

    public function GetTags2() {


        $tags = array();

        $sql = "SELECT *
             FROM gnr_tag

             ORDER BY tag_name";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                //	return $row->country_id;
                $tag_name = $row->tag_name;
                $tag_slug = $row->tag_slug;
                //Comprobamos si el tag existe en algún post.
                $sql2 = "SELECT * FROM gnr_post LIKE post_tag_id LIKE '%$tag_name%' ";

                //echo $sql2;

                $query = $this->db->query($sql2);

                if ($query->num_rows() > 0) {
                    //Añadimos al ARRAY
                    //$tags=array("tag_slug"=>"red","tag_name"=>"green");
                    array_push($tags, $tag_name);

                    /* $tags = array(
                      'tag_slug' => $tag_slug,
                      'tag_name' => $tag_name);
                     */
                }
            }
        }


        return $tags;
        //return $query->result();
    }

    public function GetTags() {

        $carpeta = $this->uri->segment(1);

        $sql = "SELECT *
             FROM gnr_tag
             WHERE tag_folder='$carpeta' AND tag_visible='Mostrar'

             ORDER BY tag_name";

        /*    $sql = "
          SELECT

          IN  SELECT tag_name
          FROM gnr_tag

          ORDER BY tag_name";
         */

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //foreach ($query->result() as $row) {
            //	return $row->country_id;
            return $query->result();
        }
    }

    public function GetCategoriesPost() {

        $carpeta = $this->uri->segment(1);

        /*  $sql = "SELECT *
          FROM gnr_post_category
          WHERE post_category_folder='$carpeta' AND post_category_id IN

          ( SELECT post_category_id FROM gnr_post
          WHERE post_folder='$carpeta'  ) ";
         */

        $sql = "SELECT *
          FROM gnr_post_category
          WHERE post_category_folder='$carpeta'
          ORDER BY post_category_name";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //foreach ($query->result() as $row) {
            //	return $row->country_id;
            return $query->result();
        }
        return null;
    }

    public function GetPostsByCategory($category_slug = null) {

        $category_slug = $this->uri->segment(3);
        $carpeta = $this->uri->segment(1);

        if ($category_slug == null)
            $where = " AND post_category_id > 0 ";
        else
            $where = " AND post_category_slug = '$category_slug' ";

        $where = " AND post_category_slug = '$category_slug' ";

        $sql = "SELECT *,DATE_FORMAT(post_date,'%b') as mes,

            DATE_FORMAT(post_date,'%d') as dia
             FROM gnr_post p,gnr_post_category c 
             WHERE p.post_folder='$carpeta' AND p.post_category_id=c.post_category_id $where
             ORDER BY post_date";

        //SELECT *,DATE_FORMAT(post_date,'%b') as mes, DATE_FORMAT(post_date,'%d') as dia 
        //FROM gnr_post p,gnr_post_category c 
        //WHERE p.post_category_id=c.post_category_id AND post_category_slug = 'tapizados-de-sofa' ORDER BY post_date
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //foreach ($query->result() as $row) {
            //	return $row->country_id;
            return $query->result();
        }
    }

}

?>