<?php

class Model_property_holiday extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('grocery_CRUD');
        $this->load->library('calendar');
        $this->load->model('Model_calendar');
    }

    public function getCalendar() {


        $prefs = array(
            'show_next_prev' => TRUE,
            'start_day' => 'monday',
            'month_type' => 'long',
            'day_type' => 'short'
        );

        $prefs['template'] = '

        {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
';


        $this->load->library('calendar', $prefs);

        //   echo $this->calendar->generate();
        //$year=2016;
        $cal = $this->cal();
        return $cal;
    }

    private function _buildCalendar($year, $month, $totalMonths = 6) {
        $calData = array();

        //como vemos en genera calendario le pasamos el año y el mes para que sepa que debe mostrar
        for ($i = 1; $i <= $totalMonths; $i++) {
            $data = array('calendario' => $this->Model_calendar->genera_calendario($year, $month));
            $calData[] = $this->load->view('cal', $data, TRUE);
            if ($month == 12) {
                $year++;
                $month = 1;
            } else {
                $month++;
            }
        }
        return $calData;
    }

    public function cal($year = null, $month = null) {
        $this->_defaultYearMonth($year, $month);
        $cal = $this->_buildCalendar($year, $month, 10);
        return $cal;
        //$this->load->view("calShow", array("calendar" => $cal));
    }
/**************************************reservar*****************************************///////////////////////
    public function reservar($fechadesde, $fechahasta) {
        //Aquí capturas los datos recibidos
        $propiedad = $this->session->userdata('property_id');
        $propiedad = 1;
        
        $data = array(
            'fecha' => $this->input->post('desde'),
            'comentario' => "alojamiento reservado",
            'estado' => "ocupado",
            'disponibilidad' => "No disponible",
            'property_id' => $propiedad
        );

        $this->db->insert('calendars_holiday', $data);
        
         $fechainicio = new DateTime($fechadesde);
        $fechafinal= new DateTime($fechahasta);
        $diff = $fechainicio->diff($fechafinal);
// will output 2 days
        echo $diff->days . ' dias <br>';
        
        $dias =0;
//hacer un while k recoja fecha x fecha y dia x dia y le vaya sumando uno a cada dia.
        //ahora guardaremos en la base de datos el dia x dia 

        while ($dias < $diff->days) {

            $nuevafecha = strtotime('+1 day', strtotime($fechadesde));            
            $nuevafecha = date(/*'j-m-Y'*/'Y-m-j', $nuevafecha);
            $fechadesde = $nuevafecha;
            echo "Nueva fecha:".$nuevafecha."<br>";
                       
           $dias++;
           
           $data = array(
            'fecha' => $nuevafecha,
          
            'property_id' => $propiedad
        );

        $this->db->insert('calendars_holiday', $data);

           
        }   
        
      
    }
    
     public function recoger_reserva($fechadesde, $fechahasta) {
           $propiedad = $this->session->userdata('property_id');
        $propiedad = 1;
          
            $sql = "SELECT * FROM  calendars_holiday  WHERE (fecha = ?) ";
        //echo $sql;
        $query = $this->db->query($sql, $propiedad);

        if ($query->num_rows() > 0) {
            return $query->result(); //retorna els datos
        }

             
         }

    private function _defaultYearMonth($year, $month) {
        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }
    }

    public function detailInformation($property_id) {

        $sql = " SELECT   pro.property_persons, pro.property_bedrooms, pro.property_bathrooms, pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price, pricing.pricing_currency,  '$session_id'
FROM property_holiday pro, picture_holiday pic, location_holiday lo, text_holiday texto, urls_holiday urls, pricing_holiday pricing
WHERE pro.property_id = pic.picture_property_id
AND pro.property_id = lo.location_property_id
AND pro.property_id = texto.text_property_id
AND pro.property_id = urls.urls_property_id
AND pro.property_id = pricing.pricing_property_id
AND pro.property_id =1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->result();
    }

    public function getPictures($property_id) {

        $sql = "SELECT * FROM picture_holiday WHERE picture_property_id = ? ";
        $query = $this->db->query($sql, array($property_id));
        if ($query->num_rows() > 0)
            return $query->result();
    }

    public function getText($property_id) {

        $sql = "SELECT * FROM text_holiday WHERE text_property_id = ? ";
        $query = $this->db->query($sql, array($property_id));
        if ($query->num_rows() > 0)
            return $query->result();
    }

    public function getLocation($property_id) {

        $sql = "SELECT * FROM location_holiday WHERE location_property_id = ? ";
        $query = $this->db->query($sql, array($property_id));
        if ($query->num_rows() > 0)
            return $query->result();
    }

    public function getSeason($property_id) {

        $sql = "SELECT * FROM season_holiday WHERE season_property_id = ? ";
        $query = $this->db->query($sql, array($property_id));
        if ($query->num_rows() > 0)
            return $query->result();
    }

    public function getUserInformation($property_id) {

        $sql = " SELECT * 
                FROM  property_holiday p, gnr_user_information u
                WHERE p.property_user = u.user_information_user_id
                AND p.property_id = ? ";

        $query = $this->db->query($sql, array($property_id));
        if ($query->num_rows() > 0)
            return $query->result();
    }

    function season() {

        $crud = new grocery_CRUD();
        $crud->set_table('season_holiday');
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
                ->display_as('season_price', 'Precio por noche');


        $output = $crud->render();

        $this->_example_output($output);
    }

    public function _example_output($output = null) {
        $this->load->view('example.php', $output);
    }

    /*
      $data_entry = '01/12/2016';
      $data_output = '05/12/2016';
      $property_id = 'CH9475.100.2';
      $city="viena";


      //$this->Model_property_interhome->getPropertiesWithAvailability($data_entry, $data_output, $city);

      //$this->Model_property_interhome->getAvailabilityInterhome($data_entry, $data_output, $property_id);



     */

    function GetDaysBetweenFechas($fecha_in, $fecha_out) {

        $segundos = strtotime($fecha_out) - strtotime($fecha_in);
        $diferencia_dias = intval($segundos / 60 / 60 / 24);
        //echo "La cantidad de días entre el ".$fecha." y hoy es <b>".$diferencia_dias."</b>";
        return $diferencia_dias;
    }

    function getPropertiesWithAvailability($data_entry, $data_output, $city, $persons = 4) {

        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons <= $persons ";


        $sql = "  SELECT  pro.property_provider Codigo, '$data_entry','$data_output',pro.property_persons ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name,pricing_price ,pricing_currency
		FROM property_wimdu pro, picture_wimdu pic, location_wimdu lo, text_wimdu texto, urls_wimdu urls,pricing_wimdu pricing
		WHERE   
		pro.property_id = pic.picture_property_id and 
		pro.property_id = lo.location_property_id and 
		pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and
                pro.property_id = pricing.pricing_property_id and 
		
		 
		texto.text_title LIKE '%$city%'  
		and texto.text_lang ='es' 
                $where_persons
                GROUP BY pro.property_id 
                ORDER BY pricing.pricing_price ";


        $codigos_disponibles = "";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $codigo = $row->Codigo;
                //echo "<hr>";
                //echo "CODIGO:".$codigo."<br>";
                //Vamos a ver que codido tiene
                //$id = GetIdByCode($codigo);
                $codigo_id = $this->GetIdByCode($codigo);
                //echo "CODIGO_ID:".$codigo_id."<br>";
                //Comprobamos disponibilidad de cada código Si es disponible lo almacenamos en una variable
                if ($this->getAvailabilityWimdu($data_entry, $data_output, $codigo_id)) {
                    $codigos_disponibles .= $codigo_id . ",";
                }
            }
        }
        $codigos_disponibles .= "0";
        // echo "<br>CODIGOS DISPONIBLES PROVIDER:".$codigos_disponibles;
        //echo "<br>CODIGOS DISPONIBLES:".$codigos_disponibles;
        return $codigos_disponibles;
    }

    function GetIdByCode($codigo) {
        $sql = "SELECT property_id FROM property_holiday WHERE property_provider = '$codigo' ";
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            return $row->property_id;
        }
    }

    function getAvailabilityWimdu($data_entry, $data_output, $property_id) {
        /*
         * Please realize that the values in the "availability" attribute in the "availabilities" 
         * feed begin from the start of the current month and not the current day. 
         * Therefore, the values 1,1,1,1,1,0,0,0,0... in the "availability" attribute in the "availabilities" feed represent the first, second, third, etc. days of May 
         * and a value of "1" means that the property is not available; a "0" means the property is available.
         * 
         * 
         */


        // 1-> No está disponible
        // 0-> Sí está disponible


        if (($data_entry != null) && ($data_output != null)) {

            //    echo "FECHA_ENTRADA:[$data_entry]<BR>";
            //    echo "FECHA_SALIDA:[$data_output]<BR>";

            $data_entry_mysql = explode("/", $data_entry);
            $data_output_mysql = explode("/", $data_output);

            // print_r($data_entry_mysql);

            if (empty($data_entry_mysql[2]) || $data_entry_mysql[2] == "") {
                $data_entry_mysql = explode("-", $data_entry);
                $data_output_mysql = explode("-", $data_output);

                $anyo_input = $data_entry_mysql[0];
                $mes_input = $data_entry_mysql[1];
                $dia_input = $data_entry_mysql[2];

                $anyo_output = $data_output_mysql[0];
                $mes_output = $data_output_mysql[1];
                $dia_output = $data_output_mysql[2];
            } else {

                $data_entry = $data_entry_mysql[2] . '-' . $data_entry_mysql[1] . '-' . $data_entry_mysql[0];
                $data_output = $data_output_mysql[2] . '-' . $data_output_mysql[1] . '-' . $data_output_mysql[0];

                $anyo_input = $data_entry_mysql[2];
                $mes_input = $data_entry_mysql[1];
                $dia_input = $data_entry_mysql[0];

                $anyo_output = $data_output_mysql[2];
                $mes_output = $data_output_mysql[1];
                $dia_output = $data_output_mysql[0];
            }
            //    echo "FORMATO MYSQL FECHA_ENTRADA:[$data_entry]<BR>";
            //    echo "FORMATO MYSQL FECHA_SALIDA:[$data_output]<BR>";
            //Realizamos la consulta 
            $sql = " SELECT * FROM calendars_wimdu WHERE calendars_property_id = $property_id ";

            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $disponibilidad = $row->calendars_availability;
                    // print_r($disponibilidad);
                    //echo "<br>DISPONIBILIDAD:".$disponibilidad;


                    $mes = $row->calendars_availability_month;
                    $anyo = $row->calendars_availability_year;
                    //Recorremos $disponibilidad si hay un 1 no está disponible.
                    $calendario = explode(",", $disponibilidad);  //Array Calendario
                    //    print_r($calendario);


                    $desde_dia = $dia_input * (1 + $mes_input - $mes) - 1;
                    $hasta_dia = $dia_output * (1 + $mes_output - $mes) - 1;

                    //echo "DESDE DIA:" . $desde_dia . "<br>";
                    //echo "HASTA DIA:" . $hasta_dia . "<br>";

                    for ($dia = $desde_dia; $dia < $hasta_dia; $dia++) {
                        //  echo "pos_array" . $dia . "<br>";
                        //   echo "----" . $calendario[$dia] . "<br>";

                        if ($calendario[$dia] == 1) { //No está disponible
                            //echo "NO DISPONIBLE";
                            return false;
                        }
                    }
                }
            } else
                return false;  //No existe registro en la tabla calendars
        }
        //echo "DISPONIBLE";
        return true;
    }

}

?>