<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webapp extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');
        $this->load->model('Model_blog');
         $this->load->model('Model_User');
    }

//    public function index() {
//        $this->load->view('webapp/index.php');
//    }

    public function index() {
        $lang = $this->uri->segment(1, 0);
        $cms = $this->uri->segment(2, 0);
        //echo "LANG:[$lang] CMS:[$cms]";
        $this->loadView('vw_index');
    }

    public function quienes_somos() {
        $this->loadView('es/vw_quienes_somos');
    }

    public function sorteo() {
        $this->loadView('es/vw_sorteo');
    }

    public function politica_privacidad() {
        $this->loadView('es/vw_politica_privacidad');
    }

    public function search() {


        //pagination
        $this->load->library('pagination');

        $config = array();

        $city = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        //echo "SEGMENTO Ciudad[" . $city."]";       

        if ($city == 0) {
            $city = $this->input->post("city");
            $data_entry = $this->input->post('data_entry');
            $data_output = $this->input->post('data_output');
            $persons = $this->input->post('persons');
            $this->session->sess_destroy();
            //Guardem les opcions de les busquedes
            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_entry
            );

            $this->session->set_userdata($datos_busqueda);

            $city = $this->session->userdata('city');
        } else {
            $data_entry = '01/01/2016';
            $data_output = '31/12/2020';
            $persons = 0;
        }



        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;




        if ($city == null || empty($city)) {
            $city = $this->uri->segment(2);

            $datos_busqueda = array(
                'city' => $city,
                    //   'data_entry'   => $data_entry,
                    //   'data_output' => $data_entry
            );

            $this->session->set_userdata($datos_busqueda);


            //	echo "Ciudad[" . $city."]";                                        
        }

        $city = $this->session->userdata('city');


        $lang = $this->uri->segment(1, 0);
        $config['per_page'] = 7;
        $config['base_url'] = base_url() . '/search/' . $city;

        $num = $config['per_page'];
        //Fin de pagination
        //echo "Ciudad" . $city;
// Cambiar a $this->input->post()
        //$city="gandia";
        $total_registros = $this->Model_property->getTotalProperties($city, $data_entry, $data_output, $persons);
        //echo "TOTAL REGISTRO=$total_registros";
        $config['total_rows'] = $total_registros;
        $datos['properties'] = $this->Model_property->getAllProperties($city, $data_entry, $data_output, $persons, $desde, $num);

        //paginacion
        //$config['attributes'] = array('class' => 'c-button b-40 bg-blue-2 hv-blue-2-o fl');
        $config['uri_segment'] = 3;
        $config['num_links'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'icon-double-angle-left';
        //$config['next_link'] = 'Siguiente';

        $this->pagination->initialize($config);
        $datos['paginacion'] = $this->pagination->create_links();
        //echo 
        $this->pagination->create_links();

        //Fin de paginacion
        $this->loadView('vw_search', $datos);
    }

    public function es() {
        //echo "cms";
        $lang = $this->uri->segment(1, 0);
        $post_slug = $this->uri->segment(2, 0);

        if (empty($post_slug)) {
            $this->index();
            return;
        }


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

    public function register() {
        $this->loadView('vw_register');
    }

    public function loadView($view, $content = null) {
        $this->Model_webapp_content->LoadContent($view, $content);
    }

    public function register_property() {
        $this->loadView('vw_register_property');
    }

    public function register_save() {

        $name = $this->input->post('name');
        $email1 = $this->input->post('email1');
        $email2 = $this->input->post('email2');
        $phone = $this->input->post('phone');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');



        echo $name;
        echo $email1;
        echo $email2;
        echo $phone;
        echo $password1;
        echo $password2;


        $error_mail = "";
        $error_password = "";


        $count = 0;

        if ($email1 != $email2) {
            $error_mail = "Error: el email no coincide";
            $count = $count + 1;
        }if ($password1 != $password2) {
            $error_password = "Error la contraseña no coincide";
            $count = $count + 1;
        }


        if ($count == 0) {
            $this->loadView('vw_index');


            $clave_cifrada = $this->encrypt->encode($password1);

            $this->Model_User->register_save($name, $email1, $phone, $clave_cifrada);


            /*
              Encripte la password
             */
        } else {
            $datos_registrer = array(
                'error_mail' => $error_mail,
                'error_password' => $error_password
            );












            $this->loadView('vw_register', $datos_registrer);
        }
    }

    function encrypt_password_callback($clave) {
        $clave_cifrada = $this->encrypt->encode($clave);

        $post_array["password"] = $clave_cifrada;
        return $post_array;
    }

}
