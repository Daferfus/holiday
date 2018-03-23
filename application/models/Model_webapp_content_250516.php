<?php

class Model_webapp_content extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function LoadContent($view, $content,$page_name = null) {
//            echo "CARGANDO VISTA: [$view]";
     
            //print_r($content);
            $this->load->view('webapp/template/vw_header', $content, $page_name);
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
			$this->load->view('webapp/template/vw_footer', $content, $page_name);
        
    }

   

}

?>