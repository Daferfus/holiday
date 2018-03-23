<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webapp extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */

        $this->load->library('email');
        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        //  $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');
        $this->load->model('Model_blog');
        $this->load->model('Model_User');
        $this->load->model('Model_mail');
        $this->load->helper('orderby');
    }

//    public function index() {
//        $this->load->view('webapp/index.php');
//    }

    public function email() {
        //Esta funció es per a proves
        $from1 = "sorteo@holidayapartment.online";
        $from2 = "sorteo@holidayapartment.online";
        $to = "juanjo.camps@gmail.com";
        $asunto = "ENTRA EN NUESTRO SORTEO";
        $cuerpo = "HOLA , VAS A ENTRAR EN EL SORTEO DE UN VIAJE ";
        $fichero_adjunto = base_url() . "/assets/uploads/files/bases_concurso.pdf";

        $this->Model_mail->SendMail($from1, $from2, $to, $asunto, $cuerpo, $fichero_adjunto, $empresa = null);

        return;
    }

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

    public function search($city = null) {

        //	echo "HOLA SEARCH";
        //pagination
        $this->load->library('pagination');

        $config = array();

        $persons = 0;

        $total_segments = $this->uri->total_segments();

        if ($total_segments == 1) { //Es la primera llamada a search . Leemos los parámetros del formulario
            //Borramos todas las propiedades del temporal
            $this->Model_property->deletePropertiesTemp();
            //Destruimos la session
            $this->session->sess_destroy();

            $city = $this->input->post("city");
            $data_entry = $this->input->post('data_entry');
            $data_output = $this->input->post('data_output');
            $persons = $this->input->post('persons');
            $order = "ASC";

            //Grabamos en variable de sesión . En un array $datos_busqueda
            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons,
                'order_price' => $order
            );

            $this->Model_property->InsertAllProperties_intoTemp($city, $data_entry, $data_output);


            $this->session->set_userdata($datos_busqueda);
        }
        if ($total_segments == 2) {

            //Borramos todas las propiedades del temporal
            $this->Model_property->deletePropertiesTemp();
            //Destruimos la session
            //$this->session->sess_destroy();
            //  $this->session->sess_destroy();
            if ($city == NULL)
                $city = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data_entry = date('d-m-Y');
            $data_output = strtotime('+2 day', strtotime($data_entry));
            $data_output = date('d-m-Y', $data_output);

            // echo "FECHA ENTRADA[$data_entry]<br>";
            // echo "FECHA SALIDA[$data_output]<br>";
            //echo $nuevafecha;
            // $data_entry = date('d-m-Y');
            // $data_output = date('d-m-Y') + 2;
            $persons = 4;
            $order = "ASC";

            $this->Model_property->InsertAllProperties_intoTemp($city, $data_entry, $data_output);
            //Grabamos en variable de sesión . En un array $datos_busqueda
            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons,
                'order_price' => $order
            );

            $this->session->set_userdata($datos_busqueda);
        }
        if ($total_segments == 3) { //Es la llamada a la paginación de resultados . Leemos las variables de sesión
            $city = $this->session->userdata('city');
            $persons = $this->session->userdata('persons');
            $data_entry = $this->session->userdata('data_entry');
            $data_output = $this->session->userdata('data_output');
            $order = $this->session->userdata('order_price');
            $city = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons,
                'order_price' => $order
            );
        }



        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;


        $lang = $this->uri->segment(1, 0);
        $config['per_page'] = 6;
        $config['base_url'] = base_url() . '/search/' . $city;

        $num = $config['per_page'];
        //Fin de pagination

        $total_registros = $this->Model_property->getTotalPropertiesEx($city, $data_entry, $data_output, $persons);
        //echo "TOTAL REGISTRO=$total_registros";
        $config['total_rows'] = $total_registros;
        $datos['total_rows'] = $total_registros;
        $desde_registro = ($desde - 1) * $num;
        //$order="ASC";
        $order = $this->session->userdata('orderby');
        $datos['properties'] = $this->Model_property->getAllPropertiesEx($city, $data_entry, $data_output, $persons, $desde_registro, $num, $order);
        $datos['data_entry'] = $data_entry;
        $datos['data_output'] = $data_output;

        //paginacion
        //$config['attributes'] = array('class' => 'c-button b-40 bg-blue-2 hv-blue-2-o fl');
        $config['uri_segment'] = 3;
        $config['num_links'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'icon-double-angle-left';

        /*
          $config['first_link'] = 'Pri';//primer link
          $config['last_link'] = 'Últ';//último link
          $config['next_link'] = 'Sig';//siguiente link
          $config['prev_link'] = 'Ant';//anterior link
         */
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';


        //$config['next_link'] = 'Siguiente';

        $this->pagination->initialize($config);
        $datos['paginacion'] = $this->pagination->create_links();
        //echo 
        //$this->pagination->create_links();
        //Fin de paginacion
        $this->loadView('vw_search', $datos);
    }

    public function es() {


        $lang = $this->uri->segment(1, 0);
        $post_slug = $this->uri->segment(2, 0);


        if (empty($post_slug)) {
            $this->index();
            return;
        }

       // echo "POST_SLUG:[$post_slug]";

        $content['posts'] = $this->Model_blog->GetPost($post_slug);

        foreach ($content['posts'] as $post)
            $tipo_post = $post->post_category_id;


        //echo "CIUDAD".$city."<br>";

        if ($tipo_post == 3)  //Tipo página web estática
            $this->loadView('vw_cms', $content);
        else {
            //Vamos a obtener la ciudad de busqueda del último elemento
            $poblacion = explode('-', $post_slug);

            $city = $poblacion[count($poblacion) - 1];
            $this->search($city);
        }


        //$this->loadView('vw_cms', $content);
    }

    public function blog($carpeta = null) {


        $carpeta = $this->uri->segment(1);

        //echo "CARPETA:[$carpeta]";

        if ($carpeta == null)
            $carpeta = $this->session->userdata('carpeta_activa');

        if ($carpeta == null)
            $carpeta = "ES_es";


        $this->session->set_userdata('carpeta_activa', $carpeta);



        // $content = $this->model_nav->load_view($carpeta, "blog");
        //pagination
        $this->load->library('pagination');

        $opciones = array();
        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url() . $carpeta . '/blog';
        $num = $opciones['per_page'];
        //Fin de pagination

        $this->load->model('model_blog');
        //   $content['array_nav'] = $this->model_nav->GetNavPrincipal();
        $content['page_name'] = 'blog';

        //echo "DESDE:[$desde] NUM:[$num]";

        $content['posts'] = $this->model_blog->GetPosts($desde, $num, null);

        // echo "POSTS:<br>";
        // print_r($content['posts']);
        // echo "<br>";
        $content['categories_post'] = $this->model_blog->GetCategoriesPost();
        $content['tags'] = $this->model_blog->GetTags();
        // print_r($content['tags']);

        $content['last_posts'] = $this->model_blog->GetLastPosts(5);

        //-------

        $opciones['total_rows'] = $this->model_blog->GetNumPosts();

        $content['total_rows'] = $this->model_blog->GetNumPosts();

        $content['carpeta'] = $carpeta;

        //  echo "CARPETA:".$content['carpeta'];

        $content['upload_dir'] = 'assets/grocery_crud/texteditor/tinymce_4/responsive_filemanager/uploads/';

        //-------

        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 4;
        $config['anchor_class'] = 'icon-double-angle-left';
        $this->pagination->initialize($opciones);
        $content['paginacion'] = $this->pagination->create_links();

        //Fin Paginaci�n

        $view = "/vw_blog1";
        //$this->webapp_output($view, $content, $carpeta);
        $this->loadViewEx($view, $content);
    }

    public function cat_blog($category_slug) {


        $carpeta = $this->uri->segment(1);

        //$carpeta = $this->session->userdata('carpeta_activa');
        // $content = $this->model_nav->load_view($carpeta, "blog");
        //pagination
        $this->load->library('pagination');

        $opciones = array();
        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url() . 'blog';
        $num = $opciones['per_page'];
        //Fin de pagination


        $this->load->model('model_blog');
        // $content['array_nav'] = $this->model_nav->GetNavPrincipal();
        $content['page_name'] = 'blog';
        $content['carpeta'] = $carpeta;
        $content['posts'] = $this->model_blog->GetPostsByCategory($category_slug);
        $content['categories_post'] = $this->model_blog->GetCategoriesPost();
        $content['tags'] = $this->model_blog->GetTags();
        $content['last_posts'] = $this->model_blog->GetLastPosts(5);

        //  print_r($content['posts']);
        //-------

        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 4;
        $config['anchor_class'] = 'icon-double-angle-left';
        $this->pagination->initialize($opciones);
        $content['paginacion'] = $this->pagination->create_links();

        //Fin Paginaci�n

        $view = '/vw_blog1';
        $this->loadViewEx($view, $content);
    }

    public function tag($tag_slug) {


        $carpeta = $this->uri->segment(1);
        $tag_slug = $this->uri->segment(2);
        //$carpeta = $this->session->userdata('carpeta_activa');
      //  $content = $this->model_nav->load_view($carpeta, "blog");

        //pagination
        $this->load->library('pagination');

        $opciones = array();
        $desde = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;


        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url() . 'blog';
        $num = $opciones['per_page'];
        //Fin de pagination


        $this->load->model('model_blog');
        //$content['array_nav'] = $this->model_nav->GetNavPrincipal();
        $content['page_name'] = 'blog';
        $content['posts'] = $this->model_blog->GetPostsByTag($tag_slug);
        $content['categories_post'] = $this->model_blog->GetCategoriesPost();
        $content['tags'] = $this->model_blog->GetTags();
        $content['last_posts'] = $this->model_blog->GetLastPosts(5);

        //  print_r($content['posts']);
        //-------

        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 4;
        $config['anchor_class'] = 'icon-double-angle-left';
        $this->pagination->initialize($opciones);
        $content['paginacion'] = $this->pagination->create_links();

        //Fin Paginaci�n

        $content['carpeta'] = $carpeta;

        $content['upload_dir'] = 'assets/grocery_crud/texteditor/tinymce_4/responsive_filemanager/uploads/';



        $view = '/vw_blog1';
        $this->loadViewEx('vw_post', $content);
    }

    public function post($post_slug) {

        //  echo "LLAMADA A POST[$post_slug]";
        $lang = $this->uri->segment(1, 0);
        $post_slug = $this->uri->segment(2, 0);

        // echo "POST_SLUG[$post_slug]";

        if (empty($post_slug)) {
            $this->index();
            return;
        }


        $content['posts'] = $this->Model_blog->GetPostEx($post_slug);

        //print_r($content['posts']);
        //echo "LANG:[$lang] CMS:[$cms]";
        $this->loadViewEx('vw_post', $content);
    }

    public function prova() {
        echo $this->Model_property->getAvailability("1/5/2016", "2/5/2016", 25);
    }

    public function register_save() {

        $this->Model_User->register_save();
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

    public function loadViewEx($view, $content = null) {
        $this->Model_webapp_content->LoadContentEx($view, $content);
    }

    public function register_property() {
        $this->loadView('vw_register_property');
    }

    public function save_property() {

        $type = $this->input->post("type");
        $persons = $this->input->post("persons");
        echo "HUESPEDES " . $persons . "<br>";
        $bedrooms = $this->input->post("bedrooms");
        $bathrooms = $this->input->post("bathrooms");
        $square_meters = $this->input->post("square_meters");
        $floor = $this->input->post("floor");
        $title = $this->input->post("title");
        $description = $this->input->post("description");

        $datos_property = array(
            'property_provider' => 'holidayapartment',
            'property_type' => $type,
            'property_bedrooms' => $bedrooms,
            'property_bathrooms' => $bathrooms,
            'property_persons' => $persons,
            'property_square_meters' => $square_meters
        );

        //Alta de la propiedad
        $property_id = $this->db->insert('property_holiday', $datos_property);
        //Identificador de propiedad 
        //Damos de alta el titutlo y descripción.
        $datos_property_text = array(
            'text_property_id' => $property_id,
            'text_lang' => 'es',
            'text_title' => $title,
            'text_description' => $description
        );
        //Alta de los textos de la propiedad
        $property_id = $this->db->insert('text_holiday', $datos_property_text);
    }

}
