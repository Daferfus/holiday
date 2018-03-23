<?php

class Model_mail extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('encrypt');
        $this->load->library('session');
    }

    /**
     * Función que se encarga de mandar el email.
     */
    public function SendMail($from1, $from2, $to, $asunto, $cuerpo, $fichero_adjunto, $empresa = null) {
        //limpiamos los adjuntos
        $this->email->clear(TRUE);
        $this->email->from($from1, $from2);
        $this->email->to($to);
        $this->email->subject($asunto);
        //$this->email->message($cuerpo);
        //Aquí poner copia

        if ($empresa == TRUE) {
            // EDU_RETORNAR $this->email->bcc("joseminana@gmail.com");
            //$this->email->bcc("e.nadalfurio@gmail.com");
            // $this->email->bcc("juanjo.camps@gmail.com");

            /* Comentado temporalmente
             *     if ($to != "info@aquaclean.com")

              $this->email->bcc("info@aquaclean.com");
             */

            //if ($to != "jose@ossido.es")
            //$this->email->bcc("info@aquaclean.com");
        }


        $this->email->subject($asunto);

        if ($fichero_adjunto != null)
            $this->email->attach($fichero_adjunto);

        $this->email->message($cuerpo);
        if (!$this->email->send()) {
            echo "Error en el envio del mensaje:" . $this->email->print_debugger();
        }
        $cuerpo = "";
    }

    function webapp_output($view, $content, $carpeta = null) {
        $this->model_webapp_content->LoadContent($view, $content, $carpeta);
    }

    function read_mail($user_id) {
        $sql = "SELECT * ,date_format(mail_date, '%d/%m/%Y %H:%i:%s') as fecha FROM mail_holiday  WHERE (mail_user_id = ?) ORDER BY mail_date DESC ";
        //echo $sql;
        $query = $this->db->query($sql, $user_id);

        if ($query->num_rows() > 0) {
            return $query->result(); //retorna els datos
        }
    }

    function vermas_mail($mail_user_id = 0) {
        $mail_user_id = $this->session->userdata('user_id');

        $sql = "SELECT * FROM mail_holiday  WHERE (mail_user_id = ?)";
        //echo $sql;
        $query = $this->db->query($sql, $mail_user_id);

        if ($query->num_rows() > 0) {
            return $query->result(); //retorna els datos
        }
    }

    function read_mail_user($mail_id = 0) {

        $propietario_id = $this->session->userdata('user_id');  //Propietario
        $sql = "SELECT * FROM mail_holiday  WHERE (mail_user_id = ?) ORDER BY mail_date DESC ";
        //echo $sql;
        $query = $this->db->query($sql, $propietario_id);

        if ($query->num_rows() > 0) {
            return $query->result(); //retorna els datos
        }
    }

    function EditMessageById($mail_id) {


        $sql = "SELECT * FROM mail_holiday  WHERE (mail_id = ?)";
        //echo $sql;
        $query = $this->db->query($sql, $mail_id);

        if ($query->num_rows() > 0) {
            return $query->result(); //retorna els datos
        }
    }

    public function Guardar_datos() {
        //Aquí capturas los datos recibidos
        $propietario_id = $this->session->userdata('user_id');
      //  echo "propietario_id = " . $propietario_id;

        $data = array(
            'mail_user_id' => $propietario_id,
            'mail_to' => $this->input->post('to'),
            'mail_from' => $this->input->post('from'),
            'mail_subject' => $this->input->post('subject'),
            'mail_body' => $this->input->post('Cuerpo'),
        );

        $this->db->insert('mail_holiday', $data);
    }

    /* public function Actualizar_datos($mail_id){
      //Aquí capturas los datos recibidos
      $data = array(


      'mail_to'=>$this->input->post('to'),
      'mail_from'=>$this->input->post('from'),
      'mail_subject'=>$this->input->post('subject'),
      'mail_body'=>$this->input->post('Cuerpo'),


      );
      $this->db->WHERE('mail_id',$mail_id);
      $this->db->update('mail_holiday',$data);
      //redirect('DatosEnviados');

      } */
}

?>