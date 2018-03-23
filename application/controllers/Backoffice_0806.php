<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        //Models
        $this->load->model("Model_User");

        // $this->load->model('model_faqs');
        // $this->load->model('model_mail');
        // $this->load->model('model_pdf');
        $this->load->library("encrypt");
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
    }

    public function index() {
        //phpinfo();
        $css_files = array();

        $output = "PANEL DE CONTROL";
        //$this->_example_output($output);
        $this->load->view('backoffice/view_login');
    }

    public function validate_user() {
        $user = $this->input->post("user");
        $pass = $this->input->post("password");
        $datos["user"] = $user;

        if ($this->Model_User->isValidUser($user, $pass)) {
            $this->post();
        } else {
            echo "Error de autentificación, usuario o contraseña incorrecta.";
            $this->index();
        }
    }

    public function post() {

        $crud = new grocery_CRUD();
        $crud->set_table('gnr_post');
        $crud->columns('post_title', 'post_slug', 'post_image', 'post_date', 'post_visible', 'post_country_id', 'post_lang_id', 'post_category_id');

        $crud->set_relation('post_lang_id', 'gnr_lang', 'lang_denom');
        $crud->set_relation('post_country_id', 'gnr_country', 'country_name');
        $crud->set_relation('post_category_id', 'gnr_post_category', 'post_category_name');
        $crud->set_field_upload('post_image', 'assets/uploads/files');


        //CAMBIAR NOMBRES DE CAMPOS
        $crud->display_as('post_title', 'Titulo')
                ->display_as('post_slug', 'Enlace amigable')
                ->display_as('post_abstract', 'Abstract')
                ->display_as('post_body', 'Cuerpo de la publicación')
                ->display_as('post_date', 'Fecha de publicación')
                ->display_as('post_author', 'Autor')
                ->display_as('post_visible', 'Mostrar publicación')
                ->display_as('post_image', 'Imagen de la publicación')
                ->display_as('post_category_id', 'Categoría')
                ->display_as('post_tag_id', 'Etiquetas')
                ->display_as('post_lang_id', 'Idioma')
                ->display_as('post_country_id', 'País');

        /* 		
          // FUNCIONALIDAD PARA CREAR UN CAMPO MULTISELECT
          //http://stackoverflow.com/questions/19397386/grocery-crud-multiselect-field
          $this->db->select('tag_name');
          $results = $this->db->get('gnr_tag')->result();
          $tags_multiselect = array();
          foreach ($results as $result) {
          $tags_multiselect[$result->tag_name] = $result->tag_name;
          }

          $crud->field_type('post_tag_id', 'multiselect', $tags_multiselect);
         */

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function category() {
        $crud = new grocery_CRUD();
        $crud->set_table('gnr_post_category');
        $crud->display_as('post_category_name', 'Nombre de la categoría')
                ->display_as('post_category_visible', 'Mostrar categoría');
        $crud->set_relation('post_category_lang_id', 'gnr_lang', 'lang_denom');
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function tag() {
        $crud = new grocery_CRUD();
        $crud->set_table('gnr_tag');


        $crud->set_relation('tag_lang_id', 'gnr_lang', 'lang_denom');

        $crud->set_relation('tag_country_id', 'gnr_country', 'country_name');

        $output = $crud->render();

        $this->_example_output($output);
    }
	
	public function users() {
        $crud = new grocery_CRUD();
        $crud->set_table('gnr_user');


        //$crud->set_relation('tag_lang_id', 'gnr_lang', 'lang_denom');

        //$crud->set_relation('tag_country_id', 'gnr_country', 'country_name');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function logout() {
        $userData = array(
            'user_id' => "",
            'user_email' => "",
            'user_nom' => ""
        );
        $this->session->unset_userdata($userData);
        $this->session->sess_destroy();
        redirect('https://holidayapartment.online');
        //$output = "<h1>PANEL DE CONTROL</h1>";
        //$this->_example_output($output);
    }

    public function _example_output($output = null) {
        $this->load->view('example.php', $output);
    }

}
