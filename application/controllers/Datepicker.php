<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Datepicker extends CI_Controller {

    function __construct() {
        parent::__Construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        //echo "hola";
       
        $data['title'] = 'Uso de Datapicker en CodeIgniter';
        

        $this->load->view('webapp/datepicker_view', $data);
    }

    function verify_date() {

        $date = $this->input->post('datepicker');

        $error = '<p class="error">La fecha: ' . $date . ' es incorrecta</p>';
        $success = '<p class="success">La fecha: ' . $date . ' es correcta</p>';

        $array = explode('/', $date);

        if (3 === sizeof($array)) { // el tamaño del arreglo no puede ser mayor o menor a tres
            $day = $array[0];
            $month = $array[1];
            $year = $array[2];

            if (!checkdate($month, $day, $year)) { // validamos que la fecha sea correcta
                $this->index($error);
            } else {

                $this->index($success);
            } // fin
        } else {

            $this->index($error);
        }
    }

}

// fin de la clase
?>