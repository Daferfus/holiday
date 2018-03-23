<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Calendario extends CI_CONTROLLER {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Madrid');
        $this->load->model('calendario_model');
        $this->load->helper(array('url', 'form'));
        $this->load->database('default');
        $this->load->library('form_validation');
    }

    public function cal($year = null, $month = null) {
        
        echo "PROPIEDAD ACTIVA:[".$this->session->property_id."]";

        if (empty($this->session->property_id)) {
            
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
            redirect(base_url('calendario/cal/' . date('Y') . '/' . date('m')));
        }

        //como vemos a generar_calendario le pasamos el año y el mes 
        //para que sepa que debe mostrar

        //$data = array();
        //for ($i = $month; $i < 12; $i++)
          //  $data[] = array('titulo' => 'Calendario de Reservas', 'calendario' => $this->calendario_model->generar_calendario($year, $month));
       
        $data =  array('titulo' => 'Calendario de Reservas','calendario' => $this->calendario_model->generar_calendario($year, $month));
        //print_r($data);
        $this->load->view('backoffice/calendario_view', $data);
    }

    public function reservar_dia(){
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
    //al pulsar en cualquier día laborable o por delante de la fecha actual 
    //insertamos en citas todas las horas de ese día y, si ya existían 
    //mostramos un formulario con un select y las horas disponibles en un popup
    public function coger_hora() {
        //comprobamos que sea una petición ajax
        if ($this->input->is_ajax_request()) {
            $dia = $this->input->post('num');
            $year = $this->input->post('year');
            $month = $this->input->post('month');

            $fecha_completa = $year . '-' . $month . '-' . $dia;

            $dia_escogido = $this->input->post('dia_escogido');
            $mes_escogido = $this->input->post('mes_escogido');

            //insertamos las horas para ese día en la tabla citas
            $this->calendario_model->insert_horas($year, $month, $dia);

            //obtenemos la información de las horas de ese día
            $info_dia = $this->calendario_model->horas_seleccionadas($year, $month, $dia);

            $data = array(
                "year" => $year,
                "dia" => $dia,
                "month" => $month,
                "fecha_completa" => $fecha_completa,
                "dia_escogido" => $dia_escogido,
                "mes_escogido" => $mes_escogido,
                "info_dia" => $info_dia
            );

            //si hay horas disponibles para ese día mostramos 
            //la vista pasando la info en el array data
            if ($info_dia !== false) {
                $this->load->view("backoffice/get_hora_view", $data);
            }
        } else {
            show_404();
        }
    }

    //hacemos el update de la tabla citas cuando 
    //el usuario hace submit al form popup del calendario
    public function nueva_cita() {
        //comprobamos que sea una petición ajax
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('textarea', 'Comentario', 'trim|xss_clean');
            $this->form_validation->set_rules('hora', 'Hora', 'trim|xss_clean');

            $dia_calendario = $this->input->post('dia_update');
            $hora = $this->input->post('hora');
            $comentario_cita = $this->input->post('textarea') == '' ? 'Sin comentarios' : $this->input->post('textarea');
            $estado = 'ocupado';
            $fecha_escogida = $this->input->post('fecha_escogida');

            $nueva_cita = $this->calendario_model->nueva_cita($dia_calendario, $hora, $comentario_cita, $estado);

            if ($nueva_cita) {
                echo $fecha_escogida . ' a las ' . $hora;
            }
        } else {
            show_404();
        }
    }

}

//end controller calendario