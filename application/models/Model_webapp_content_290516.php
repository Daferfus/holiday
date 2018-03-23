<?php

class Model_webapp_content extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		
		 $this->load->database();
		 $this->load->model('Model_blog');
    }
	
	function LoadHeaderBlog($view) {

        //echo "LOADHEADER($carpeta,$view)<br>";
        //En caso de no existir la vista en la base de datos ,ponemos los valores por defecto.
        $content_header['header_title'] = "Alquiler vacacional - Buscador de alojamientos para vacaciones";
        $content_header['header_keywords'] = "Alquiler vacacional - Buscador de alojamientos para vacaciones";
        $content_header['header_description'] = "Alquiler vacacional - Buscador de alojamientos para vacaciones";
        $content_header['header_author'] = "holidayapartment.online";



        $post_slug = $this->uri->segment(2);

        $sql = " SELECT * FROM gnr_post p WHERE p.post_slug = '$post_slug' ";

        //echo $sql;

        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {

            if (!empty($row->post_header_title)) {
                $content_header['header_title'] = $row->post_header_title;
                $content_header['header_keywords'] = $row->post_header_keywords;
                $content_header['header_description'] = $row->post_header_description;
                $content_header['header_author'] = $row->post_header_author;
            }
        }

        return $content_header;
    }

    public function LoadContent($view, $content,$page_name = null) {
        //    echo "CARGANDO VISTA: [$view]";
		
		
			$content_header=$this->LoadHeaderBlog($view);
     
            //print_r($content);
            $this->load->view('webapp/template/vw_header', $content_header, $page_name);
            $this->load->view('webapp/template/vw_nav', $content, $page_name);
            $this->load->view('webapp/' . $view, $content);
			
			

			$lang='es';
			if ($lang == null) 
				$lang='es';
			else
				$lang = $this->uri->segment(1);

            //$content = $this->model_nav->load_view($carpeta, "footer");

          //  $content1 = $this->model_nav->load_language($lang, "footer");

            //  $lang_file = '../language/' . $carpeta . '/footer_lang.php';
            //  echo $lang_file;
            //   $content=$this->load->view($lang_file,'',true);
            //  print_r($content);

            //$this->load->view('webapp/template/vw_footer', $content1, $page_name);
			
			//	$lang = $this->uri->segment(1,0);
			//	$post_slug = $this->uri->segment(2,0);
				
			//	if (empty($post_slug)) {
				//	$this->index();
			//		return;
					
			//	}
		
				
				//$content['posts'] = $this->Model_blog->GetPost($post_slug);
				
			$city = $this->session->userdata('city');
				
			$post_view= "alquiler-vacacional-".$city;	
			
			//echo "POST-VIEW:[$post_view]";
				
			$content['posts'] = $this->Model_blog->GetPost($post_view);
			
			//print_r($content['posts']);
			
			
			$this->load->view('webapp/template/vw_footer', $content, $page_name);
        
    }

   

}

?>