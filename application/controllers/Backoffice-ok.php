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
        $this->load->model('Model_mail');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');

        date_default_timezone_set('Europe/Madrid');
        $this->load->model('calendario_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
    }

    public function index() {
        //phpinfo();
        $css_files = array();

        $output = "PANEL DE CONTROL";
        //$this->_example_output($output);
        $this->load->view('backoffice/vw_login');
    }

    public function validate_user() {
        $user = $this->input->post("user");
        $pass = $this->input->post("password");
        $datos["user"] = $user;

        if ($this->Model_User->isValidUser($user, $pass)) {
            //$this->post();
            // $this->load->view('example');

            $rol_id = $this->Model_User->GetRolUser($user);
            if ($rol_id == 1) //Propietario
                redirect('backoffice/season');
            else //Administrador
                redirect('backoffice/post');
        } else {
            echo "Error de autentificación, usuario o contraseña incorrecta.";
            $this->index();
        }
    }
    public function insertar_user(){
                
        $nombre= $this->input->post('nombre');
        $apellido= $this->input->post('apellido');
        $nomapellido=$nombre." ".$apellido;
        $pass = $this->input->post('pass');
        $email = $this->input->post('email');
        $telefono = $this->input->post('telefono');
        $pass=$this->encrypt->encode($pass);
           
        //comprobar si existe el email:
        if (!$this->comprueba_email($email)){
            
        $data = array('user_rol_id' => 1,'user_name' => $nomapellido,'user_password' => $pass, 'user_email' => $email, 'user_phone' => $telefono);
        $this->db->insert('gnr_user',$data);
        $id=$this->db->insert_id();
        $this->session->set_userdata('id_user', $id);
        //$this->loadViewRegistro(null, 'register_pay', null);
        $this->load->view('backoffice/register_pay.php');
            echo "Te has registrado correctamente";
        }
        else
            echo "Tu email ya esta registrado!";
    }
    
    public function insertar_tipoPago(){
        $user_id=$this->session->userdata('id_user');
        $reserva= $this->input->post('Pago_Reserva');
        $anual= $this->input->post('Pago_Anual');
        $num=0;
        if($reserva==true){
            $num=0;
        }
        else if($anual==true){
            $num=1;
        }
        $data = array(
               'user_information_user_id'=> $user_id,
               'user_information_payment_type' => $num
               //'name' => $name,
               //'date' => $date
            );
            //$this->db->where('id', $id);
            $this->db->insert('gnr_user_information', $data);
            $this->SendMailToUser($user_id);
        echo"te has registrado correctamente";    
            
    }
    
    public function SendMailToUser($user_id) {
        
        $info_user = $this->Model_User->GetInfoUserById($user_id);
        
        foreach ($info_user as $row){
            $nombre = $row->user_name;
            $mail = $row->user_email;
        }
        
        $from1 = "info@holidayapartment.online";
        $from2 = "info@holidayapartment.online";
        $to = $mail;
        $asunto = "Acabas de registrarte en HolidayApartment";
        $cuerpo = "Hola $nombre, gracias por registrarse en HolidayApartment ";
        $fichero_adjunto = NULL;

       $this->Model_mail->SendMail($from1, $from2, $to, $asunto, $cuerpo, $fichero_adjunto, $empresa = null);
    }










    public function comprueba_email($email){
            //echo "is vlid user[$user]";
        $sql = "SELECT * FROM gnr_user WHERE user_email = ? ";

        $query = $this->db->query($sql, array($email));

        //return true;
        // foreach ($query->result() as $fila)

        if ($query->num_rows() == 1)  //existeix un registre
           return true;
        else
            return false;

    }
    
    public function post() {

        $crud = new grocery_CRUD();
        $crud->set_table('gnr_post');
        $crud->columns('post_title', 'post_slug', 'post_image', 'post_date', 'post_visible', 'post_country_id', 'post_lang_id', 'post_category_id');

        $crud->set_relation('post_lang_id', 'gnr_lang', 'lang_denom');
        $crud->set_relation('post_country_id', 'gnr_country', 'country_name');
        $crud->set_relation('post_category_id', 'gnr_post_category', 'post_category_name');
        $crud->set_field_upload('post_image', 'assets/uploads/files');
        //$crud->unset_texteditor('description','full_text');
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

    public function roles() {
        
        $this->output->enable_profiler(TRUE);
        $crud = new grocery_CRUD();
        $crud->set_table('gnr_user_rol');
        $output = $crud->render();

        $this->_example_output($output);
    }

    public function users() {
        $crud = new grocery_CRUD();
        $crud->set_table('gnr_user');


        //$crud->set_relation('tag_lang_id', 'gnr_lang', 'lang_denom');
        //$crud->set_relation('tag_country_id', 'gnr_country', 'country_name');
        $crud->change_field_type('user_password', 'password');
        $crud->set_relation('user_rol_id', 'gnr_user_rol', 'user_rol_name');

        $crud->callback_edit_field('user_password', array($this, 'set_password_input_to_empty'));
        $crud->callback_add_field('user_password', array($this, 'set_password_input_to_empty'));

        $crud->callback_before_update(array($this, 'encrypt_password_callback'));
        $crud->callback_before_insert(array($this, 'encrypt_password_callback'));

        $output = $crud->render();

        $this->_example_output($output);
    }

//FUNCION PARA ENCRIPTAR LOS PASSWORDS
    function encrypt_password_callback($post_array) {

        //Encrypt password only if is not empty. Else don't change the password to an empty field
        if (!empty($post_array['user_password']) && $post_array['user_password'] != '') {
            $post_array['user_password'] = $this->encrypt->encode($post_array['user_password']);
            return $post_array;
        } else {
            unset($post_array['user_password']);
        }
        return $post_array;
    }

    function set_password_input_to_empty() {
        return "<input type='password' name='user_password' value='' />";
    }

    public function logout() {


        //Ponemos a 0 la propiedad activa del usuario activo , siempre y cuando
        //el usuario tenga rol de propietario
        $user_email = $this->session->user_email;
        $rol_id = $this->Model_User->GetRolUser($user_email);

        if ($rol_id == 1) { //Si rol de propietario
            $user_id = $this->session->user_id; //Usuario activo en la Sesión.
            $data = array(
                'property_active' => 0
            );

            $this->db->where('property_user', $user_id);
            $this->db->update('property_holiday', $data);
        }

        $userData = array(
            'user_id' => "",
            'user_email' => "",
            'user_nom' => "",
            'property_id' => ""
        );


        $this->session->unset_userdata($userData);
        $this->session->sess_destroy();
        //redirect('https://holidayapartment.online');
        //$output = "<h1>PANEL DE CONTROL</h1>";
        //$this->_example_output($output);
        $this->index();
    }
    
    public function register_user(){
        $this->load->view('backoffice/register_user.php');
    }
    public function register_pay(){
        $this->load->view('backoffice/register_pay.php');
    }
    public function _example_output($output = null) {
        $this->load->view('example.php', $output);
    }

    public function loadViewRegistro($output = null, $vista = null, $data = null) {

        $user_id = $this->session->user_id;

        //Si no hay propiedad activa mostramos todas las propiedades del usuario user_id
        $property_id_active = $this->session->property_id;

        if (empty($property_id_active)) //Mostramos todas las propiedades asociadas a dicho usuario
            $datos['properties'] = $this->Model_User->GetPropertiesByUser($user_id);
        else
            $datos['properties'] = $this->Model_User->GetPropertyActive($user_id);


        $this->load->view('backoffice/template/header.php', $datos);
        $this->load->view('backoffice/registro.php', $output);
        $this->load->view('backoffice/template/side.php');
        
        
        if ($vista != NULL)
            $this->load->view('backoffice/' . $vista, $data);
         $this->load->view('backoffice/template/footer.php', $datos);
         
    }

    //Funciones alta inmuebles

    public function datos_propietarios() {

        $user_id = $this->session->user_id;
        
        $crud = new grocery_CRUD();
        $crud->set_theme('twitter-bootstrap');
        //$crud->set_theme('datatables');
        //$crud->set_theme('twitter-bootstrap');
        $property_id_active = $this->session->property_id;
        if (!empty($property_id_active)) //Desactivamos el botón de alta
            $crud->unset_add();
        $crud->set_table('gnr_user_information');
        $crud->where('user_information_user_id', $user_id);

        /* Campos 
         * `user_information_id`, `user_information_user_id`, `user_information_company`, 
         * `user_information_fname`, `user_information_lname`, `user_information_email1`, 
         * `user_information_email2`, `user_information_phone1`, `user_information_phone2`, 
         * `user_information_mailing_address`, `user_information_mailing_city`, `user_information_mailing_state`, 
         * `user_information_mailing_zip`, `user_information_mailing_country_id`, `user_information_billing_address`, 
         * `user_information_billing_city`, `user_information_billing_state`, `user_information_billing_zip`, 
         * `user_information_billing_country_id`
         * 
         * 
         * 
         */

        $crud->columns('user_information_company', 'user_information_fname', 'user_information_lname', 'user_information_mailing_address', 'user_information_billing_address');

        //$crud->fields('user_information_fname','user_information_lname','user_information_email1');

        $crud->display_as('user_information_fname', 'Nombre')
                ->display_as('user_information_lname', 'Apellidos')
                ->display_as('user_information_image', 'Foto')                        
                ->display_as('user_information_email1', 'Email 1')
                ->display_as('user_information_email2', 'email 2')
                ->display_as('user_information_phone1', 'Teléfono de Contacto')
                ->display_as('user_information_phone2', 'Teléfono 2')
                ->display_as('user_information_company', 'Nombre de la Compañía')
                ->display_as('user_information_mailing_address', 'Dirección Postal')
                ->display_as('user_information_mailing_city', 'Población Postal')
                ->display_as('user_information_mailing_state', 'Provincia Postal')
                ->display_as('user_information_mailing_zip', 'Código Postal')
                ->display_as('user_information_mailing_country_id', 'País')
                ->display_as('user_information_billing_cif', 'NIF/CIF de Facturación')
                ->display_as('user_information_billing_address', 'Dirección de Facturación')
                ->display_as('user_information_billing_city', 'Población de Facturación')
                ->display_as('user_information_billing_state', 'Provincia de Facturación')
                ->display_as('user_information_billing_zip', 'Código Postal')
                ->display_as('user_information_billing_country_id', 'País de Facturación');


        $crud->set_relation('user_information_mailing_country_id', 'gnr_country', 'country_name');
        $crud->set_relation('user_information_billing_country_id', 'gnr_country', 'country_name');
        
        
         $folder_images = "assets/uploads/images/" . $property_id_active."/foto";


        if (!file_exists($folder_images)) {
            mkdir($folder_images, 0777, true);
        }


        $crud->set_field_upload('user_information_image', $folder_images);

        //user_information_mailing_country
        $output = $crud->render();

        $this->loadViewRegistro($output);
    }
    
    
    public function amenities(){
        $crud = new Grocery_CRUD();
        $crud->set_table('amenities_holiday');
        $crud->set_subject('Comodidades');
      //  $crud->columns();
        $crud->set_relation('amenities_text_id', 'amenities_text_holiday', 'amenities_text_name');
        $output = $crud->render();

        $this->loadViewRegistro($output);
        
        
    }
    
    public function amenities_type(){
        $crud = new Grocery_CRUD();
        $crud->set_table('amenities_text_holiday');
        $crud->set_subject('Tipos de Comodidades');
        $crud->set_relation('amenities_text_lang', 'gnr_lang', '{lang_iso} {lang_denom}');
        $output = $crud->render();

        $this->loadViewRegistro($output);
        
        
    }

    public function reservas() {
        $crud = new grocery_CRUD();
        $crud->set_theme('twitter-bootstrap');
        //$crud->set_theme('datatables');
        // $crud->set_theme('twitter-bootstrap');
        $crud->set_table('bookings_holiday');
        $crud->set_subject('Reserva');
        
        
        /* Campos 
         * 
         * `bookings_id`, `bookings_property_id`, `bookings_user_id`, `bookings_check_in`, `bookings_check_out`, 
         * `bookings_price`, `booking_firstname`, `booking_lastname`, `bookings_email`, `bookings_persons`, 
         * `bookings_phone`, `bookings_mobile`, `bookings_address`, `bookings_country`, `bookings_city`, 
         * `bookings_zip`, `bookings_state
         * 
         */
        
        $crud->fields('booking_firstname','booking_lastname','bookings_check_in', 'bookings_check_out', 
                'bookings_email', 'bookings_persons', 'bookings_phone', 
                'bookings_mobile', 'bookings_address', 'bookings_country', 'bookings_city','bookings_zip', 
                'bookings_state');
        
        
        
        $crud->display_as('booking_firstname', 'Nombre')
                ->display_as('booking_lastname', 'Apellidos')
                ->display_as('bookings_check_in', 'Entrada')
                ->display_as('bookings_check_out', 'Salida')
                ->display_as('bookings_persons', 'Num Huéspedes')
                ->display_as('bookings_email', 'Email')
                ->display_as('bookings_phone', 'Teléfono')
                ->display_as('bookings_mobile', 'Móvil')
                ->display_as('bookings_address', 'Dirección')
                ->display_as('bookings_city', 'Localidad')
                ->display_as('bookings_state', 'Provincia')
                ->display_as('bookings_zip', 'Código Postal')
                ->display_as('bookings_country', 'País')
                ->display_as('bookings_state', 'Estado')               
                ;

        $property_id_active = $this->session->property_id;
       
       
        $crud->where('bookings_property_id', $property_id_active);

        $crud->set_relation('bookings_country', 'gnr_country', 'country_name');
        
        $output = $crud->render();

        $this->loadViewRegistro($output);
    }

    public function cal($year = null, $month = null) {
        // echo "PROPIEDAD ACTIVA:[".$this->session->property_id."]";
        $this->session->set_userdata('property_id', $this->session->property_id);
        
        if (!$this->session->has_userdata('property_id')) {
            
            echo "ATENCIÓN , NO HAY PROPIEDAD ACTIVA<br>";
            return;
        }

        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }
        $this->calendario_model->insert_calendario($month, $year);

        //si el año y el mes al que queremos acceder es menor que el actual no dejamos
        if ($this->uri->segment(3) . '/' . $this->uri->segment(4) < date('Y') . '/' . date('m')) {
            redirect(base_url('backoffice/cal/' . date('Y') . '/' . date('m')));
        }

        //como vemos a generar_calendario le pasamos el año y el mes 
        //para que sepa que debe mostrar
        //$data = array();
        //for ($i = $month; $i < 12; $i++)
        //  $data[] = array('titulo' => 'Calendario de Reservas', 'calendario' => $this->calendario_model->generar_calendario($year, $month));

        $data = array('titulo' => 'Calendario de Reservas', 'calendario' => $this->calendario_model->generar_calendario($year, $month));
        //print_r($data);
        $output = "";
        $vista = "calendario_view";

        $html = "<h2>Calendario de Reservas</h2>";

        $datos = array(
            'output' => null,
            'css_files' => array(),
            'js_files' => array(),
            'html' => $html
        );

        $this->loadViewRegistro($datos, $vista, $data);
        //$this->load->view('backoffice/calendario_view', $data);
    }

    public function reservar_dia() {
        if ($this->input->is_ajax_request()) {
            $dia = $this->input->post('num');
            $year = $this->input->post('year');
            $month = $this->input->post('month');

            $fecha_completa = $year . '-' . $month . '-' . $dia;

            $dia_escogido = $this->input->post('dia_escogido');
            $mes_escogido = $this->input->post('mes_escogido');

            //echo "FECHA_COMPLETA:".$fecha_completa."<br>";
            $this->calendario_model->update_calendario($fecha_completa);
        }
    }
    
    public function reservar_dia_prueba() {
        
        if(isset($_POST["date"])){
            
            if($_POST["date"]){
                $fecha= explode("-",$_POST["date"]);
                $dia= $fecha[0];
                $year=$fecha[1];
                $month=$fecha[2];
                
                $fecha_completa = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                
                $fecha[0]=$this->input->post('dia_escogido');
                $fecha[1]=$this->input->post('mes_escogido');
                
                $this->calendario_model->update_calendario($fecha_completa);
                
                echo "la fecha elegida es: ".$fecha_completa;
            }
        }
    }

    function ubicacion() {
        

        /*   if (empty($store->store_coordinate_latitude) && (empty($store->store_coordinate_longitude))) {
          $position_map = "https://maps.google.com/?q=" . $store->city_name . ", " . $store->country_name . ", " . $store->store_address . ", " . $store->zip_name . ";t=m&amp;output=embed";
          } else {
          $position_map = "https://maps.google.com/maps?q=" . $store->store_coordinate_latitude . "," . $store->store_coordinate_longitude . '&z=17&output=embed';
          }
         */


        /* $city_name = "gandia";
          $country_name = "Spain";
          $address = "Ciutat de Barcelona , 8";
          $zip_name = "46702";
         */
        /* Calle Marjals nº6
          Playa de Daimus, Comunidad Valenciana 46710
          ES */
        $city_name = "Daimus";
        $country_name = "ES";
        $address = "Calle Marjals , 6";
        $zip_name = "46710";

        //Hemos de llamar a la función que nos retorne los campos de location
        $property_id_active = $this->session->property_id;
        $locations = $this->Model_User->GetLocation($property_id_active);
        //print_r($location);
        if (!empty($locations)) {
            foreach ($locations as $location) {
                $city_name = $location->location_city;
                $country_name = $location->location_country;
                $address = $location->location_address;
                $zip_name = $location->location_zip;
                $longitude = $location->location_longitude;
                $latitude = $location->location_latitude;
            }

            if ($longitude != 0 && $latitude != 0) {
                $position_map = "https://maps.google.com/maps?q=" . $latitude . ", " . $longitude . "&z=17&output=embed";
            } else
                $position_map = "https://maps.google.com/?q=" . $city_name . ", " . $country_name . ", " . $address . ", " . $zip_name . ";t=m&amp;output=embed";
            /* echo '<iframe id="map" src="<?php echo $position_map ?>" style="border:1px solid #dedbd2; padding:-5px;" width="100%" frameborder="0" height="350"></iframe>';
             */
            $html = '<iframe id="map" src="' . $position_map . '" style="border:1px solid #dedbd2; padding:-5px;" width="70%" frameborder="0" height="350"></iframe>';
        } else
            $html = "<h1>Debe de ir a la pestaña de localización</h1>
                <a href='location'>Ir a localización</a> ";


        $datos = array(
            'output' => null,
            'css_files' => array(),
            'js_files' => array(),
            'html' => $html
        );
        $this->loadViewRegistro($datos);
    }

    function active_property($property_id) {
        //Grabamos en la variable de sesión.
        
        $this->session->set_userdata('property_id', $property_id);
        //Grabamos un 1 , en el campo property_active del usuario activo en la sesión
        $user_id = $this->session->user_id; //Usuario activo en la Sesión.
        $data = array(
            'property_active' => 1
        );

        $this->db->where('property_user', $user_id);
        $this->db->update('property_holiday', $data);

        $this->description();
    }

    function location() {
        $crud = new grocery_CRUD();
        $crud->set_theme('twitter-bootstrap');
        $crud->set_table('location_holiday');

        $property_id_active = $this->session->property_id;

        if (!empty($property_id_active)) //Desactivamos el botón de alta
            $crud->unset_add();




        $crud->where('location_property_id', $property_id_active);
        /*
         * `location_id`, `location_property_id`, `location_country`, `location_city`, 
         * `location_district`, `location_address`, `location_latitude`, `location_longitude`
         * 
         */

        $crud->columns('location_property_id', 'location_country', 'location_city', 'location_address', 'location_zip', 'location_latitude', 'location_longitude');
        $crud->fields('location_property_id', 'location_country', 'location_city', 'location_address', 'location_zip', 'location_latitude', 'location_longitude');
        //Ocultamos campo location_property_id , solo sirve para grabar la referencia
        $crud->field_type('location_property_id', 'hidden', $property_id_active);

        $output = $crud->render();

        $this->loadViewRegistro($output);
    }

    function details() {
        $crud = new grocery_CRUD();
        $crud->set_table('property_holiday');

        $property_id_active = $this->session->property_id;
        $crud->where('property_id', $property_id_active);

        //$crud->set_relation('text_lang', 'gnr_lang', '{lang_iso} {lang_denom}');

        $output = $crud->render();

        $this->loadViewRegistro($output);
    }

    function description() {

        $crud = new grocery_CRUD();
        $crud->set_table('text_holiday');
        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('Descripción del Inmueble');

        $property_id_active = $this->session->property_id;

        if (!empty($property_id_active)) //Desactivamos el botón de alta
            $crud->unset_add();

        $property_id_active = $this->session->property_id;
        $crud->where('text_property_id', $property_id_active);

        $crud->set_relation('text_lang', 'gnr_lang', '{lang_iso} {lang_denom}');

        $crud->columns('text_lang', 'text_title', 'text_description', 'text_area_description');
        $crud->fields('text_lang', 'text_property_id', 'text_title', 'text_description', 'text_area_description');

        //Ocultamos campo season_property_id , solo sirve para grabar la referencia
        $crud->field_type('text_property_id', 'hidden', $property_id_active);


        /*
         * CAMPOS TEXT_HOLIDAY
         * SELECT `text_id`, `text_lang`, `text_property_id`, `text_title`, 
         * `text_description`, `text_area_description` 
         * FROM `text_holiday` WHERE 1
         * 
         */

        //$crud->callback_before_insert(array($this, 'description_property_id_callback'));
        //$crud->callback_before_update(array($this, 'description_property_id_callback'));

        $output = $crud->render();

        $this->loadViewRegistro($output);
    }

    function season() {

        $crud = new grocery_CRUD();
        $crud->set_table('season_holiday');
        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('Tarifas por temporadas');

        $property_id_active = $this->session->property_id;

        // if (!empty($property_id_active)) //Desactivamos el botón de alta
        //     $crud->unset_add();

        $crud->where('season_property_id', $property_id_active);


        /* Campos de la tabla season_holiday
         * 
         * `season_id`, `season_property_id`, `season_from`, `season_to`, 
         * `season_minimum_stay`, `season_checkin_days`, `season_checkout_days`, 
         * `season_price`, `season_price_type`, `season_currency`, 
         * `season_extra_adult_increase`, `season_extra_child_increase`, 
         * `season_long_stay_discount`, `season_early_bird_discount`, 
         * `season_last_minute_discount`, `season_work_week_discount`, 
         * `season_short_stay_supplement`, `season_simple_price_modifier`
         *  FROM `season_holiday`
         * 
         * 
         * 
         */




        $crud->columns('season_name', 'season_from', 'season_to', 'season_minimum_stay', 'season_price');
        $crud->fields('season_property_id', 'season_name', 'season_from', 'season_to', 'season_minimum_stay', 'season_price');

        //Ocultamos campo season_property_id , solo sirve para grabar la referencia
        $crud->field_type('season_property_id', 'hidden', $property_id_active);
        /*  $crud->set_relation('post_lang_id', 'gnr_lang', 'lang_denom');
          $crud->set_relation('post_country_id', 'gnr_country', 'country_name');
          $crud->set_relation('post_category_id', 'gnr_post_category', 'post_category_name');
          $crud->set_field_upload('post_image', 'assets/uploads/files');
         */

        //CAMBIAR NOMBRES DE CAMPOS
        $crud->display_as('season_name', 'Nombre')
                ->display_as('season_from', 'Desde Fecha')
                ->display_as('season_to', 'Hasta Fecha')
                ->display_as('season_minimum_stay', 'Mínimo dias de estancia')
                ->display_as('season_price', 'Precio por noche (€)');


        /* $userData = array(
          'user_id' => $fila->user_id,
          'user_email' => $fila->user_email,
          'user_nom' => $fila->user_name
          );
          $this->session->set_userdata($userData);
         */
        // $user_id = $this->session->userdata('user_id');
        // $user_id = $this->session->user_id;
        //$properties = $this->Model_User->GetPropertiesByUser($user_id);
        //print_r($properties);
        // $datos['properties'] = $this->Model_User->GetPropertiesByUser($user_id);
        //$crud->callback_before_insert(array($this, 'season_property_id_callback'));
        //$crud->callback_before_update(array($this, 'season_property_id_callback'));

        $output = $crud->render();


        $this->loadViewRegistro($output);
    }

    function images() {

        $crud = new grocery_CRUD();
       // $crud->set_theme('twitter-bootstrap');
        $crud->set_table('picture_holiday');

        $property_id_active = $this->session->property_id;


        // if (!empty($property_id_active)) //Desactivamos el botón de alta
        //     $crud->unset_add();


        $crud->where('picture_property_id', $property_id_active);


        $crud->set_subject('Imagenes');
        /* Campos de la tabla picture_holiday
         * 
         * `picture_id`, `picture_property_id`, `picture_title`, `picture_url
         * `SELECT * FROM `picture_holiday` WHERE 1
         * 
         * 
         */

        $crud->columns('picture_title', 'picture_url');
        $crud->fields('picture_property_id', 'picture_title', 'picture_url');
        $crud->required_fields('picture_title', 'picture_url');
        //Ocultamos campo picture_property_id , solo sirve para grabar la referencia
        $crud->field_type('picture_property_id', 'hidden', $property_id_active);

        /*  $crud->set_relation('post_lang_id', 'gnr_lang', 'lang_denom');
          $crud->set_relation('post_country_id', 'gnr_country', 'country_name');
          $crud->set_relation('post_category_id', 'gnr_post_category', 'post_category_name');
          $crud->set_field_upload('post_image', 'assets/uploads/files');
         */


        //Creamos carpeta para la inserción de fotos , las fotos cuelgan de una carpeta
        // con el id de la propiedad 
        $folder_images = "assets/uploads/images/" . $property_id_active;


        if (!file_exists($folder_images)) {
            mkdir($folder_images, 0777, true);
        }


        $crud->set_field_upload('picture_url', $folder_images);
        //CAMBIAR NOMBRES DE CAMPOS
        $crud->display_as('picture_title', 'Título de la imagen')
                ->display_as('picture_url', 'Imagen');
        
        
        //Antes de insertar hemos de añadir  https://holidayapartment.online/assets/uploads/images/1/

       // $crud->callback_before_insert(array($this, 'images_property_id_callback'));
       // $crud->callback_before_update(array($this, 'images_property_id_callback'));
        
        
        
        $output = $crud->render();

        $this->loadViewRegistro($output);
    }

    function images_property_id_callback($post_array) {

        $url_base = "https://holidayapartment.online/assets/uploads/images/";
        $post_array['picture_url'] = $url_base.$this->session->property_id."/".$post_array['picture_url'];

        return $post_array;
    }

    function season_property_id_callback($post_array) {

        $post_array['season_property_id'] = $this->session->property_id;

        return $post_array;
    }

    function description_property_id_callback($post_array) {

        $post_array['text_property_id'] = $this->session->property_id;

        return $post_array;
    }

}
