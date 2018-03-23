<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webapp extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */

        $this->load->library('email');
        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        //  $this->load->$this->load->modellibrary("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');
        $this->load->model('Model_blog');
        $this->load->model('Model_User');
        $this->load->model('Model_mail');
        $this->load->model('Model_property_holiday');
        $this->load->helper('orderby');
        $this->load->model('calendario_model');
        //borra la caché
        //$this->output->delete_cache();
        //$this->output->cache(1440*7);  //Caché de una semana.ping doomtools
        //$this->output->cache(1440);  //Caché de un día
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

    public function info() {

        phpinfo();
    }

    public function index() {

        $lang = $this->uri->segment(1, 0);
        $cms = $this->uri->segment(2, 0);
        //echo "LANG:[$lang] CMS:[$cms]";
        $this->loadView('vw_index');
    }

    public function alquiler_vacacional() {


        $post_slug = $this->uri->segment(1, 0);

        $content['posts'] = $this->Model_blog->GetPost($post_slug);

        $this->loadViewEx('vw_cms', $content);
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

    public function alquiler_vacacional_madrid($pag = 1) {
        $this->search2('madrid', $pag);
    }

    public function alquiler_vacacional_barcelona($pag = 1) {
        $this->search2('barcelona', $pag);
    }

    public function alquiler_vacacional_ibiza($pag = 1) {
        $this->search2('ibiza', $pag);
    }

    public function alquiler_vacacional_mallorca($pag = 1) {
        $this->search2('mallorca', $pag);
    }

    public function alquiler_vacacional_canarias($pag = 1) {
        $this->search2('canarias', $pag);
    }
    
    public function alquiler_vacacional_tenerife($pag = 1) {
        $this->search2('tenerife', $pag);
    }

    public function alquiler_vacacional_bilbao($pag = 1) {
        $this->search2('bilbao', $pag);
    }
    
    public function alquiler_vacacional_zaragoza($pag = 1) {
        $this->search2('zaragoza', $pag);
    }
    
    public function alquiler_vacacional_salamanca($pag = 1) {
        $this->search2('salamanca', $pag);
    }

    public function alquiler_vacacional_santiago_de_compostela($pag = 1) {
        $this->search2('santiago-de-compostela', $pag);
    }
    
    public function alquiler_vacacional_granada($pag = 1) {
        $this->search2('granada', $pag);
    }
    
    public function alquiler_vacacional_sevilla($pag = 1) {
        $this->search2('sevilla', $pag);
    }
    
    public function alquiler_vacacional_valencia($pag = 1) {
        $this->search2('valencia', $pag);
    }

    public function apartamentos_amsterdam($pag = 1) {
        $this->search2('amsterdam', $pag);
    }

    public function apartamentos_moscu($pag = 1) {
        $this->search2('moscu', $pag);
    }

    public function apartamentos_nueva_york($pag = 1) {
        $this->search2('nueva-york', $pag);
    }

    public function apartamentos_en_paris($pag = 1) {
        $this->search2('paris', $pag);
    }

    public function apartamentos_en_berlin($pag = 1) {
        $this->search2('berlin', $pag);
    }
    
    public function apartamentos_en_cordoba($pag = 1) {
        $this->search2('cordoba', $pag);
    }
    
    public function apartamentos_en_londres($pag = 1) {
        $this->search2('londres', $pag);
    }
    
    public function apartamentos_en_roma($pag = 1) {
        $this->search2('roma', $pag);
    }
    
    public function apartamentos_en_cracovia($pag = 1) {
        $this->search2('cracovia', $pag);
    }
    
    public function apartamentos_en_venecia($pag = 1) {
        $this->search2('venecia', $pag);
    }


    public function apartamentos_munich($pag = 1) {
        $this->search2('munich', $pag);
    }
    
    public function apartamentos_lisboa($pag = 1) {
        $this->search2('lisboa', $pag);
    }
    
    public function apartamentos_buenos_aires($pag = 1) {
        $this->search2('buenos-aires', $pag);
    }
    
    public function apartamentos_estambul($pag = 1) {
        $this->search2('estambul', $pag);
    }
    
    public function apartamentos_bruselas($pag = 1) {
        $this->search2('bruselas', $pag);
    }
    
   
    
    function reservar(){
      
          $this->session->set_userdata('property_id', $this->session->property_id);
         $fechadesde= $this->input->post('desde');
         $fechahasta= $this->input->post('hasta');    
            //$nfecha = $_POST["desde"];
//            $nfecha1 = $_POST["hasta"];
//            echo $fechadesde;
//            echo $fechahasta;

     
        $this->Model_property_holiday->reservar($fechadesde,$fechahasta);

       echo "fecha desde:".$fechadesde."<br>";
      echo "fecha hasta:".$fechahasta."<br>";
        
       
        
        

            $datos = array(
            'output' => null,
             'css_files' => array(),
             'js_files' => array()
            );


            
            



}
    function recoger_fechas_reserva(){
        $this->session->set_userdata('property_id', $this->session->property_id);
        // $fechadesde= $this->input->post('desde');
         //$fechahasta= $this->input->post('hasta');  
         
          $this->Model_property_holiday->recoger_reserva($fechadesde,$fechahasta);

       //echo "fecha desde:".$fechadesde."<br>";
      //echo "fecha hasta:".$fechahasta."<br>";
        
       
        
        

            $datos = array(
            'output' => null,
             'css_files' => array(),
             'js_files' => array()
            );

    }




    public function search2($city, $pag = 1) {
        //  echo "SEARCH2:($city,$pag)<br>";
        $this->load->library('pagination');
        $config = array();
        $persons = 0;

        if ($pag == 1) {
            //Destruimos la session
            $this->session->sess_destroy();
            //Borramos los inmuebles de dicha sesión
            $this->Model_property->deletePropertiesTemp();
            $data_entry = date('d-m-Y');
            $data_output = strtotime('+4 day', strtotime($data_entry));

            $data_output = date('d-m-Y', $data_output);

            $persons = 4;
            $order = "ASC";
            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons,
                'order_price' => $order
            );
            $this->session->set_userdata($datos_busqueda);



            $this->Model_property->InsertAllProperties_intoTemp($city, $data_entry, $data_output);
        }


        /* $city = $this->session->userdata('city');
          $persons = $this->session->userdata('persons');
          $data_entry = $this->session->userdata('data_entry');
          $data_output = $this->session->userdata('data_output');
         */


        $data_entry = date('d-m-Y');
        $data_output = strtotime('+4 day', strtotime($data_entry));

        $data_output = date('d-m-Y', $data_output);

        $persons = 4;
        $order = "ASC";

        $datos_busqueda = array(
            'city' => $city,
            'data_entry' => $data_entry,
            'data_output' => $data_output,
            'persons' => $persons
        );

        $desde = $pag;
        $this->session->set_userdata($datos_busqueda);
        // echo "DATOS :pag[$pag]<br>";
        // print_r($datos_busqueda);
        // echo " FIN DATOS :pag[$pag]<br>";
        $config['per_page'] = 6;


        //  $config['base_url'] = base_url() . '/search2/' . $city;
        //Tomamos el primer argumento de la URL . 

        $url_amigable = $this->uri->segment(1);

        //   $config['base_url'] = base_url() . '/alquiler-vacacional-'.$city;

        $config['base_url'] = base_url() . $url_amigable;

        $num = $config['per_page'];
        //Fin de pagination

        $total_registros = $this->Model_property->getTotalPropertiesEx($city, $data_entry, $data_output, $persons);
        //   echo "<br> CITY=[$city] TOTAL REGISTRO=[$total_registros]";
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
        $config['uri_segment'] = 2;
        $config['num_links'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'icon-double-angle-left';

        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';


        //$config['next_link'] = 'Siguiente';

        $this->pagination->initialize($config);
        $datos['paginacion'] = $this->pagination->create_links();

        //Fin de paginacion
        $this->loadView('vw_search', $datos);
    }
    
    public function alquiler($city = null){
        $this->buscar($city);
    }
    
    public function alquiler_vacacional_holiday($property_id){
        //echo "PROPIEDAD=".$property_id;
        $datos['calendar'] = $this->Model_property_holiday->getCalendar();
        $datos['images'] = $this->Model_property_holiday->GetPictures($property_id);
        $datos['text'] = $this->Model_property_holiday->GetText($property_id);
        $datos['location'] = $this->Model_property_holiday->GetLocation($property_id);
        $datos['seasons'] = $this->Model_property_holiday->GetSeason($property_id);
        $datos['owner'] = $this->Model_property_holiday->getUserInformation($property_id);
        $this->loadView('vw_detail',$datos);
    }
    

    public function buscar($city = null) {
        //$this->WindowLoading();
        //echo "BUSCAR($city)";
        //pagination
        $this->load->library('pagination');

        $config = array();

        $persons = 0;

        //O lo tenemos en variables de sesión o nos viene por formularios
         $total_segments = $this->uri->total_segments();
       /*   echo "TOTAL SEGMENTOS:" . $total_segments;
          echo "<br>SEGMENTO 1:" . $this->uri->segment(1);
          echo "<br>SEGMENTO 2:" . $this->uri->segment(2);
          echo "<br>SEGMENTO 3:" . $this->uri->segment(3);
          echo "<br>TIENE CITY :".$this->session->has_userdata('city');
          echo "<br>TIENE CITY POR FORMULARIO POST:".$this->input->post("city");
         */
        if ($this->session->has_userdata('city') && ($city == $this->session->userdata('city'))) {

            $city = $this->session->userdata('city');
            $persons = $this->session->userdata('persons');
            $data_entry = $this->session->userdata('data_entry');
            $data_output = $this->session->userdata('data_output');

            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons
            );
            /*    echo "VARIABLES DE SESIÓN SEGMENTOS ENTRADA<br>";
              print_r($datos_busqueda);
              echo " FIN VARIABLES DE SESIÓN<br>";
             * 
             */
        }

        //$total_segments = $this->uri->total_segments();

        if ($total_segments == 1) { //Es la primera llamada a search . Leemos los parámetros del formulario
            // echo "Llamando a loading";
            $this->WindowLoading();
            //Borramos todas las propiedades del temporal
            $this->Model_property->deletePropertiesTemp();
            //Destruimos la session
            //$this->session->sess_destroy();

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

            /*  echo "VARIABLES DE SESIÓN SEGMENTOS 1<br>";
              print_r($datos_busqueda);
              echo " FIN VARIABLES DE SESIÓN<br>";
             */
        }
        if ($total_segments == 2) {

            // $this->Model_webapp_content->LoadContentWithoutFooter('vw_loading');
            // $this->WindowLoading();
            //Borramos todas las propiedades del temporal
            $this->Model_property->deletePropertiesTemp();
            //Destruimos la session
            //$this->session->sess_destroy();
            // $this->session->sess_destroy();


            /*  $city = $this->input->post("city");
              $data_entry = $this->input->post('data_entry');
              $data_output = $this->input->post('data_output');
              $persons = $this->input->post('persons');
              $order = "ASC";
             */

            
            
        //    echo "SEGMENTOS 2 : CITY[$city]";

            if ($city == NULL)
                $city = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data_entry = date('d-m-Y');
            $data_output = strtotime('+4 day', strtotime($data_entry));


            $data_output = date('d-m-Y', $data_output);

            $persons = 4;
            $order = "ASC";

            $this->Model_property->InsertAllProperties_intoTemp($city, $data_entry, $data_output);
            //Grabamos en variable de sesión . En un array $datos_busqueda
            //echo "InsertAllProperties_intoTemp";

            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons,
                'order_price' => $order
            );

            $this->session->set_userdata($datos_busqueda);

            /*   echo "VARIABLES DE SESIÓN SEGMENTOS 2<br>";
               print_r($datos_busqueda);
               echo " FIN VARIABLES DE SESIÓN<br>";
*/
            }
        if ($total_segments == 3) { //Es la llamada a la paginación de resultados . Leemos las variables de sesión
            // $this->WindowLoading();
            // echo "TOTAL SEGMENTOS 3";
            $city = $this->uri->segment(2);
            //echo "TOTAL SEGMENTOS 3: CITY:".$city;
            if ($this->session->has_userdata('city')) {
                //$city = $this->session->userdata('city');
                $persons = $this->session->userdata('persons');
                $data_entry = $this->session->userdata('data_entry');
                $data_output = $this->session->userdata('data_output');
                $order = $this->session->userdata('order_price');
            } else {
                //$city = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $city = $this->uri->segment(2);
                $data_entry = date('d-m-Y');
                $data_output = strtotime('+4 day', strtotime($data_entry));

                $data_output = date('d-m-Y', $data_output);

                $persons = 4;
                $order = "ASC";
            }
            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons,
                'order_price' => $order
            );
            $this->session->set_userdata($datos_busqueda);
            /*     echo "VARIABLES DE SESIÓN SEGMENTOS 3<br>";
              print_r($datos_busqueda);
              echo " FIN VARIABLES DE SESIÓN<br>";
             */
        }

        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;


        $lang = $this->uri->segment(1, 0);
        $config['per_page'] = 6;

        $url_amigable = $this->uri->segment(1);
        
        //$config['base_url'] = base_url() . '/search/' . $city;
        
        $config['base_url'] = base_url() . '/'.$url_amigable.'/' . $city;

        $num = $config['per_page'];
        //Fin de pagination

        $total_registros = $this->Model_property->getTotalPropertiesEx($city, $data_entry, $data_output, $persons);
        //echo "<br> CITY=[$city] TOTAL REGISTRO=[$total_registros]";
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
    
    public function aviso_legal(){
        
        $post_slug = $this->uri->segment(1, 0);


        $content['posts'] = $this->Model_blog->GetPost($post_slug);

        foreach ($content['posts'] as $post) {

            //  print_r($post);
            $tipo_post = $post->post_category_id;

            //Dterminamos el tipo de post y en función del post haremos

            $type_post = $post->post_type;

            $poblacion = $post->post_search;

            $view = $post->post_view;

            $metodo = $post->post_controller;
        }
        
         if ($type_post == 'pagina estatica') { //Tipo página web estática
            // echo "ENTRA POR AQUÍ 3";
            //print_r($content);
            $this->loadViewEx('vw_cms', $content);
         }
        
        
    }

    public function es() {

        // $this->WindowLoading();
        $lang = $this->uri->segment(1, 0);
        $post_slug = $this->uri->segment(2, 0);


        if (empty($post_slug)) {
            $this->index();
            return;
        }

        //echo "POST_SLUG:[$post_slug]";

        $content['posts'] = $this->Model_blog->GetPost($post_slug);

        foreach ($content['posts'] as $post) {

            //  print_r($post);
            $tipo_post = $post->post_category_id;

            //Dterminamos el tipo de post y en función del post haremos

            $type_post = $post->post_type;

            $poblacion = $post->post_search;

            $view = $post->post_view;

            $metodo = $post->post_controller;
        }
        //    echo "TIPO[$type_post]";
        //    echo "POBLACION[$poblacion]";

        if ($type_post == "pagina") { //No debemos sacar los posts.
            //  echo "ENTRA POR AQUÍ 4";
            //Vamos a obtener la ciudad de busqueda del último elemento
            //$poblacion = explode('-', $post_slug);
            //$city = $poblacion[count($poblacion) - 1];
            // echo "//Aquí borramos las variables de sesion";
            $this->session->sess_destroy();
            //INICIO DE GRABAR VARIABLE DE SESION
            //Ponemos las nuevas
            $city = $poblacion;
            $data_entry = date('d-m-Y');
            $data_output = strtotime('+4 day', strtotime($data_entry));


            $data_output = date('d-m-Y', $data_output);

            $persons = 4;
            $order = "ASC";

            $datos_busqueda = array(
                'city' => $city,
                'data_entry' => $data_entry,
                'data_output' => $data_output,
                'persons' => $persons,
                'order_price' => $order
            );

            $this->session->set_userdata($datos_busqueda);
            //FIN DE GRABAR VARIABLE DE SESION

            redirect('search/' . $city);
            //$this->search($city);
            return;
        } else if ($type_post == "vista") {
            //   echo "ENTRA POR AQUÍ 5";
            $this->loadView($view);
            return;
        } else if ($type_post == "controlador") {
            $argumento = $lang;
            if (!empty($argumento) && !empty($metodo)) {
                if (method_exists($this, $metodo)) {

                    $argumento = $this->$metodo($argumento);
                    return;
                }


                return;
            }
        }

        if ($type_post == 'pagina estatica') { //Tipo página web estática
            // echo "ENTRA POR AQUÍ 3";
            //print_r($content);
            $this->loadViewEx('vw_cms', $content);
            return;
        } else {

            //      echo "ENTRA POR AQUÍ";
            //      echo "POBLACION:[".$poblacion."]";
            //Vamos a obtener la ciudad de busqueda del último elemento
            //  $poblacion = explode('-', $post_slug);
            //$city = $poblacion[count($poblacion) - 1];
            $this->search($poblacion);
            return;
        }

        // echo "AL FINAL :";
        // print_r($content);
        //  echo "ENTRA POR AQUÍ 2";
        // $this->loadView('vw_cms', $content);
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

        $content['total_rows'] = $opciones['total_rows'];

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

    public function register_owner() {

        $this->Model_User->register_owner();
    }

    public function login() {
        $this->loadView('vw_login');
    }

    public function register() {
        $this->loadView('vw_register');
    }

    public function registra() {
        $this->loadView('vw_register_properties');
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

    public function WindowLoading() {

        //  $this->Model_webapp_content->LoadContentWithoutFooter('vw_loading');
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
    
    public function datos_form() {
    
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $tlf = $this->input->post('tlf');
        $txt = $this->input->post('txt');
        
        
        echo '<hr />';
        echo "Nombre: $name";
        echo '<hr />';
        echo "e-mail: $email";
        echo '<hr />';
        echo "Telefono: $tlf";
        echo '<hr />';
        echo "Texto añadido: $txt";
        echo '<hr />';
        
        $asunto = "Informacion Apartamento";
        $to = 'chuyuko@hotmail.com';
        $from1 = "info@holidayapartment.online";
        $txt = $name.",tel:".$tlf.".".$txt;
        $from2 = "Apartaments Onliine";
        $this->Model_mail->SendMail($from1, $from2, $email, $asunto, $txt, null, null);
        
        
        $this->Model_mail->AddMail($email, "Inofmacion Holiday Apartment", $txt, $tlf);
                
       //public function AddMail ($to, $subject, $body, $telefono){
        
        /*public function SendMail($from1, $from2, $to, $asunto, $cuerpo, $fichero_adjunto, $empresa = null) {*/
        
    }
    
    /*
    function envio_datos_formulario($post_array){
               
        //Enviar correo con los datos del form
        $mail1 = "chuyuko@hotmail.com";
        $to = 'chuyuko@hotmail.com';
        $asunto = $post_array['newsletter_tittle'];
        $cuerpo = $post_array['newsletter_body'];
        
        
         $this->Model_mail->SendMail($mail1, $to, $asunto, $cuerpo);

        if($this->mail1->send()){
            $this->session->set_flashdata('envio', '¡Email enviado correctamente!');
        }else{
            $this->session->set_flashdata('envio', '¡No se a enviado el email!');
        }
        
        return $post_array;
    
    
    */
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
    function envio_datos_formulario($post_array){
               
        //enviar correo con los datos del form
        $mail1 = "chuyuko@hotmail.com";
        $mail2 = "chuyuko@hotmail.com";
        $to = 'chuyuko@hotmail.com';
        $asunto = $post_array['newsletter_tittle'];
        $cuerpo = $post_array['newsletter_body'];;
        $fichero_adjunto = NULL;
        
         $this->Model_mail->SendMail($mail1, $mail2, $to, $asunto, $cuerpo, $fichero_adjunto, $empresa = null);

        return $post_array;
    }*/
}
