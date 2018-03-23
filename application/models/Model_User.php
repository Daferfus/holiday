<?php

class Model_User extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->model('Model_webapp_content');
    }
    
    public function GetInfoUserById($id){
        
        $sql = "SELECT * FROM gnr_user WHERE user_id = ? ";

        $query = $this->db->query($sql, array($id));
        
         if ($query->num_rows() == 1)
             return $query->result();

        
    }

    public function isValidUser($user, $clave) {


        //echo "is vlid user[$user]";
        $sql = "SELECT * FROM gnr_user WHERE user_email = ? ";

        $query = $this->db->query($sql, array($user));

        //return true;
        // foreach ($query->result() as $fila)

        if ($query->num_rows() == 1) { //existeix un registre
            $fila = $query->row(); // fa un fetch e la fila actual, no es fa foreach xk sols hi ha 1

            $clave_cifrada_bd = $fila->user_password;
            $clave_cifrada_form = $this->encrypt->encode($clave);



            // echo "CLAVE:[$clave] CLAVE_CIFRADA_BD:[$clave_cifrada_bd] CLAVE_CIFRADA_FORM[$clave_cifrada_form]";
            //if ($clave_decodificada == $clave) {
            $clave_descifrada_bd = $this->encrypt->decode($clave_cifrada_bd);


            if ($clave_descifrada_bd == $clave) {
                $userData = array(
                    'user_id' => $fila->user_id,
                    'user_email' => $fila->user_email,
                    'user_nom' => $fila->user_name
                );
                $this->session->set_userdata($userData);
                return true;
            } else {
                return false;
            }
        }
    }

    public function register_owner() {
        $name = $this->input->post('name');
        $email1 = $this->input->post('email1');
        $email2 = $this->input->post('email2');
        $phone = $this->input->post('phone');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');


        $datos_user = array(
            'name' => $name,
            'email' => $email1,
            'phone' => $phone
        );


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

        $num_id = 0;

        if ($count == 0) {
            // $this->loadView('vw_index');


            $clave_cifrada = $this->encrypt->encode($password1);

            $user_rol_id = 1; //Rol de Propietarios

            $num_id = $this->insert_user($name, $email1, $phone, $clave_cifrada, $user_rol_id);

            if ($num_id == -1) {
                $datos_user = array(
                    'error_mail' => 'Existe Usuario registrado con este email',
                    'error_password' => $error_password
                );
                $this->loadViewEx('vw_register', $datos_user);

                return;
            }
            /*
              Encripte la password
             */
        } else {
            $datos_user = array(
                'error_mail' => $error_mail,
                'error_password' => $error_password
            );


            $this->loadView('vw_register', $datos_user);
        }
        $from1 = "info@holidayapartment.online";
        $from2 = "info@holidayapartment.online";
        $to = array($email1, "info@holidayapartment.online");

        $datos_user['num_sorteo'] = $num_id;
        //$to = $email1;
        $asunto = "ENTRA EN NUESTRO SISTEMA DE ANUNCIOS HOLIDAYAPARTMENT";
        $cuerpo = "HOLA $name,Gracias por registrarte en nuestra WEB<br>";
        //$fichero_adjunto = getenv('DOCUMENT_ROOT') . "/assets/uploads/files/bases_concurso.pdf";

        $fichero_adjunto = null;
        $cuerpo = $this->load->view('webapp/es/vw_mail_owner', $datos_user, true);

        $this->Model_mail->SendMail($from1, $from2, $to, $asunto, $cuerpo, $fichero_adjunto, $empresa = null);

        $this->loadViewEx('es/vw_signed_in', $datos_user);
    }

    public function register_save() {

        $name = $this->input->post('name');
        $email1 = $this->input->post('email1');
        $email2 = $this->input->post('email2');
        $phone = $this->input->post('phone');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');


        $datos_user = array(
            'name' => $name,
            'email' => $email1,
            'phone' => $phone
        );



        /*    echo $name;
          echo $email1;
          echo $email2;
          echo $phone;
          echo $password1;
          echo $password2;

         */
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

        $num_id = 0;

        if ($count == 0) {
            // $this->loadView('vw_index');


            $clave_cifrada = $this->encrypt->encode($password1);

            $user_rol_id = 4; //Rol de Administrador

            $num_id = $this->insert_user($name, $email1, $phone, $clave_cifrada, $user_rol_id);

            if ($num_id == -1) {
                $datos_user = array(
                    'error_mail' => 'Existe Usuario registrado con este email',
                    'error_password' => $error_password
                );
                $this->loadViewEx('vw_register', $datos_user);

                return;
            }
            /*
              Encripte la password
             */
        } else {
            $datos_user = array(
                'error_mail' => $error_mail,
                'error_password' => $error_password
            );


            $this->loadView('vw_register', $datos_user);
        }
        $from1 = "sorteo@holidayapartment.online";
        $from2 = "sorteo@holidayapartment.online";
        $to = array($email1, "info@holidayapartment.online");

        $datos_user['num_sorteo'] = $num_id;
        //$to = $email1;
        $asunto = "ENTRA EN NUESTRO SORTEO";
        $cuerpo = "HOLA $name, VAS A ENTRAR EN EL SORTEO DE UN VIAJE.<br>Tu número para el sorteo será: <b>" . $num_id . "</b>";
        $fichero_adjunto = getenv('DOCUMENT_ROOT') . "/assets/uploads/files/bases_concurso.pdf";

        $cuerpo = $this->load->view('webapp/es/vw_mail_sorteo', $datos_user, true);

        $this->Model_mail->SendMail($from1, $from2, $to, $asunto, $cuerpo, $fichero_adjunto, $empresa = null);

        $this->loadViewEx('es/vw_signed_in', $datos_user);
    }

    function encrypt_password_callback($clave) {
        $clave_cifrada = $this->encrypt->encode($clave);

        $post_array["password"] = $clave_cifrada;
        return $post_array;
    }

    public function GetRolUser($user) {
        $sql = "SELECT * FROM gnr_user WHERE user_email= ? ";
        $query = $this->db->query($sql, array($user));
        if ($query->num_rows() == 1) {//Existe ya usuario registrado
            $fila = $query->row(); // fa un fetch e la fila actual, no es fa foreach xk sols hi ha 1

            $rol_id = $fila->user_rol_id;
            return $rol_id;
        }
    }

    public function GetPropertyActive($user_id) {

        $property_id_active = $this->session->property_id;

        if (!empty($property_id_active)) {


            $sql = "SELECT * FROM property_holiday p ,text_holiday t 

              WHERE p.property_id = t.text_property_id AND p.property_user = ? 
              
              AND property_active = ? ";


            $query = $this->db->query($sql, array($user_id, $property_id_active));
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
    }

    public function GetLocation($property_id) {

        $sql = "SELECT * FROM location_holiday WHERE location_property_id = ? ";
        $query = $this->db->query($sql, array($property_id));

        if ($query->num_rows() > 0) {//Existe ya usuario registrado
            
            return $query->result();
            
        } else
            return 0;
    }

    public function GetPropertiesByUser($user_id) {
        // $sql="SELECT * FROM property_holiday WHERE property_user = ? ";
        // $query=$this->db->query($sql, array($user_id));
        //$sql="SELECT * FROM property_holiday WHERE property_user = $user_id ";

        $sql = "SELECT * FROM property_holiday p ,text_holiday t 

              WHERE p.property_id = t.text_property_id AND p.property_user = ? ";


        //echo $sql."<br>";
        $query = $this->db->query($sql, array($user_id));

        if ($query->num_rows() > 0) {//Existe ya usuario registrado
            // $fila = $query->row(); // fa un fetch e la fila actual, no es fa foreach xk sols hi ha 1
            //  print_r($query->result());
            return $query->result();
            // $rol_id = $fila->user_rol_id; 
            // return $rol_id;
        } else
            return 0;
    }

    public function insert_user($name, $email1, $phone, $clave_cifradas, $user_rol_id) {
        //Comprobamos si existe el email.

        $sql = "SELECT * FROM gnr_user WHERE user_email= ? ";
        $query = $this->db->query($sql, array($email1));
        if ($query->num_rows() == 1) //Existe ya usuario registrado
            return -1;





        $sql = "INSERT INTO gnr_user (user_name, user_password, user_email, user_phone,user_rol_id) VALUES (? ,? ,? , ? ,?)";

        $this->db->query($sql, array($name, $clave_cifradas, $email1, $phone, $user_rol_id));
        return $this->db->insert_id();
    }

    public function loadViewEx($view, $content = null) {
        $this->Model_webapp_content->LoadContentEx($view, $content);
    }

}
