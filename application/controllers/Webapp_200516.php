<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webapp extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');
		$this->load->model('Model_blog');
    }

//    public function index() {
//        $this->load->view('webapp/index.php');
//    }

    public function index() {
		$lang = $this->uri->segment(1,0);
		$cms = $this->uri->segment(2,0);
		//echo "LANG:[$lang] CMS:[$cms]";
        $this->loadView('vw_index');
    }

    public function search() {
        $city = $this->input->post("city");
        $data_entry = $this->input->post('data_entry');
        $data_output = $this->input->post('data_output');
        $persons = $this->input->post('persons');
        echo "Ciudad" . $city;
// Cambiar a $this->input->post()
        $datos['properties'] = $this->Model_property->getAllProperties($city, $data_entry, $data_output, $persons);
        $this->loadView('vw_search', $datos);
    }
	
	public function es() {
		//echo "cms";
		$lang = $this->uri->segment(1,0);
		$post_slug = $this->uri->segment(2,0);
		
		/*if ($post_slug==0) {
			
			$this->index();
			return;	
		}*/
		
		$content['posts'] = $this->Model_blog->GetPost($post_slug);
		
		//print_r($content['posts']);
		
		//echo "LANG:[$lang] CMS:[$cms]";
		$this->loadView('vw_cms', $content);
		
	}

    public function prova() {
        echo $this->Model_property->getAvailability("1/5/2016", "2/5/2016", 25);
    }

    public function login() {
        $this->loadView('vw_login');
    }

    public function loadView($view, $content = null) {
        $this->Model_webapp_content->LoadContent($view, $content);
    }

    public function register_property() {
        $this->loadView('vw_register_property');
    }

}
