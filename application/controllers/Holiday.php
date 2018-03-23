<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        //$this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        //$this->load->library("encrypt");
        //$this->load->helper('url');
        //$this->load->library('session');
        $this->load->model('Model_property_holiday');
        //$this->load->model('Model_webapp_content');
    }

    public function index() {
         echo "Controlador HOLIDAY<br>";
         $codigos = $this->Model_property_holiday->season();
       }

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

   

}
