<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Onlyapartment extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Model_property');
        $this->load->model('Model_property_onlyapartments');
        $this->load->model('Model_webapp_content');
    }

    
    public function index() {
        $persons = 4;
        $city = 'Barcelona';
        $data_entry = '7-11-2016';
        $data_output = '11-11-2016';
        
        $codigos = $this->Model_property_onlyapartments->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons = 4);
        echo $codigos;

    }
   
}
