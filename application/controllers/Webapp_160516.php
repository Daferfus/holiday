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
    }

    public function index() {
        $this->load->view('webapp/index.php');
    }

    public function search() {

//        $city = isset($_POST['city']) ? $_POST['city'] : NULL;
//        $data_entry = isset($_POST['data_entry']) ? $_POST['data_entry'] : NULL;
//        $data_output = isset($_POST['data_output']) ? $_POST['data_output'] : NULL;
//        $persons = isset($_POST['persons']) ? $_POST['persons'] : NULL;

        $city = $this->input->post("city");
        $data_entry = $this->input->post('data_entry');
        $data_output = $this->input->post('data_output');
        $persons = $this->input->post('persons');
		
	

// Cambiar a $this->input->post()
        $datos['properties'] = $this->Model_property->getAllProperties($city, $data_entry, $data_output, $persons);

       // $this->load->view('webapp/view_search.php', $datos);
	   
	      $this->loadView('vw_search',$datos);

//        $this->load->view('webapp/view_search.php');
//        $datos['city'] = $city;
//        $datos['data_entry'] = $data_entry;
//        $datos['data_output'] = $data_output;
//        $datos['persons'] = $persons;
    }
	public function loadView($view,$content=null) {
		
		
		$this->Model_webapp_content->LoadContent($view, $content);
		
	}

}
