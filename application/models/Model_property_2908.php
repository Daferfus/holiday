<?php

class Model_property extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->model('Model_property_9flats');
    }

    function getRealIP() {

        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    public function deletePropertiesTemp() {
        $session_id = $this->getRealIP();
        $sql = "DELETE FROM property_temp WHERE property_session = ? ";
        $query = $this->db->query($sql, array($session_id));
    }

    public function getTotalPropertiesEx($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4) {

        // $this->InsertAllProperties_intoTemp($city);

        $session_id = $this->getRealIP();
        $sql = "SELECT  pro.property_id
		FROM property_temp pro 
                WHERE property_session = '$session_id' ";

        //	echo $sql;

        $query = $this->db->query($sql);

        return $query->num_rows();
    }

    public function getAllPropertiesEx($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4, $desde = 0, $num = 0, $order = "ASC") {

        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons >= $persons ";
        
        $session_id = $this->getRealIP();

        $sql = "SELECT *
		FROM property_temp pro
                WHERE   
		
		property_session = ?
		
                $where_persons
		GROUP BY pro.property_id 
		ORDER BY pro.pricing_price $order
		
		LIMIT $desde,$num ";

        //echo $sql;

        $query = $this->db->query($sql, array($session_id));
//        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function getTotalProperties($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4) {

        // $this->InsertAllProperties_intoTemp($city);
        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons >= $persons ";

        $sql = "SELECT   pro.property_id
		FROM property pro, picture pic, location lo, text texto, urls, pricing,beds
		WHERE   
		pro.property_id = pic.picture_property_id and 
		pro.property_id = lo.location_property_id and 
		pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and 
		pro.property_id = pricing.pricing_property_id and 
		pro.property_id = beds.beds_property_id and 
		texto.text_title LIKE '$city%'  
		and texto.text_lang ='es' and urls.urls_lang='es'  
		$where_persons
		GROUP BY pro.property_id
				";

        //	echo $sql;

        $query = $this->db->query($sql, array($city));

        return $query->num_rows();
    }

    public function getAllProperties($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4, $desde = 0, $num = 0, $order = "ASC") {

        //$desde=$desde*($num-1);
        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons >= $persons ";

        $sql = "SELECT   pro.property_persons ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price ,pricing.pricing_currency, beds.beds_double_sofa_beds ,  beds.beds_single_sofa_beds , beds.beds_double_beds
		FROM property pro, picture pic, location lo, text texto, urls, pricing,beds
		WHERE   
		pro.property_id = pic.picture_property_id and 
		pro.property_id = lo.location_property_id and 
		pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and 
		pro.property_id = pricing.pricing_property_id and 
		pro.property_id = beds.beds_property_id and 
		texto.text_title LIKE '$city%'  
		and texto.text_lang ='es' and urls.urls_lang='es'
		$where_persons
		
		GROUP BY pro.property_id 
		ORDER BY pricing.pricing_price $order
		
		LIMIT $desde,$num ";

        //echo $sql;

        $query = $this->db->query($sql);
//        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function InsertAllProperties_intoTemp($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4, $desde = 0, $num = 0, $order = "ASC") {
        // echo "FECHA_ENTRADA:[$data_entry]<BR>";
        // echo "FECHA_SALIDA:[$data_output]<BR>";
        //convertimos a FORMATO MYSQL
        /* if ( ($data_entry != null) && ($data_output != null) ) {   

          echo "FECHA_ENTRADA:[$data_entry]<BR>";
          echo "FECHA_SALIDA:[$data_output]<BR>";

          $data_entry_mysql = explode("-", $data_entry);
          $data_output_mysql = explode("-", $data_output);

          $data_entry = $data_entry_mysql[2].'-'.$data_entry_mysql[1].'-'.$data_entry_mysql[0];
          $data_output = $data_output_mysql[2].'-'.$data_output_mysql[1].'-'.$data_output_mysql[0];
          }
         */
        
        //Borramos las propiedades buscada por esta IP.
        $this->deletePropertiesTemp();
        $session_id = $this->getRealIP();
        //$session_id = $this->session->userdata('session_id');
        //$desde=$desde*($num-1);
        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons >= $persons ";

        // $property_session = $this->session->userdata('item');
        //Insertar todas las propiedades de ONLY-APARTMENTS

        $sql = " INSERT INTO property_temp ( property_provider ,data_entry,data_output, property_persons ,property_bedrooms, property_bathrooms, picture_url, location_address, text_title, urls_name, pricing_price ,pricing_currency, property_session) 
                SELECT  'only-apartments','$data_entry','$data_output', pro.property_persons ,pro.property_bedrooms,pro.property_bathrooms ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price ,pricing.pricing_currency,'$session_id'
		FROM property pro, picture pic, location lo, text texto, urls, pricing,beds
		WHERE   
		pro.property_id = pic.picture_property_id and 
		pro.property_id = lo.location_property_id and 
		pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and 
		pro.property_id = pricing.pricing_property_id and 
		pro.property_id = beds.beds_property_id and 
		texto.text_title LIKE '$city%'  
		and texto.text_lang ='es' and urls.urls_lang='es'
		$where_persons
		
		GROUP BY pro.property_id 
		ORDER BY pricing.pricing_price $order
		
		 ";

        //echo $sql;

        $query = $this->db->query($sql);
//        $query = $this->db->query($sql);
        //Insertamos las propiedades de WIMDU

        $sql = " INSERT INTO property_temp (property_provider ,data_entry,data_output,property_persons ,picture_url, location_address, text_title, urls_name, pricing_price ,pricing_currency, 
           
                 property_session) 
                SELECT  'wimdu', '$data_entry','$data_output',pro.property_persons ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name,pricing_price ,pricing_currency, '$session_id'
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
                ORDER BY pricing.pricing_price $order  ";
        $query = $this->db->query($sql);

        //Fin de propiedades de WIMDU
        //Insertamos 9flats

        $this->Model_property_9flats->InsertarProperties_9flats($city);
    }

    public function getAllPropertiesWimdu($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4, $desde = 0, $num = 0, $order = "ASC") {

        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons >= $persons ";


        $sql = " SELECT   pro.property_persons ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name
		FROM property_wimdu pro, picture_wimdu pic, location_wimdu lo, text_wimdu texto, urls_wimdu urls
		WHERE   
		pro.property_id = pic.picture_property_id and 
		pro.property_id = lo.location_property_id and 
		pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and 
		
		 
		texto.text_title LIKE '%$city%'  
		and texto.text_lang ='es' 
                $where_persons
                GROUP BY pro.property_id 
                ORDER BY pricing.pricing_price $order
                LIMIT $desde,$num ";


        $query = $this->db->query($sql);
//        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getAvailability($data_entry, $data_ouput, $property_id) {

        $check_in = explode("/", $data_entry);
        $day_in = $check_in[0];
        $month_in = $check_in[1];
        $year_in = $check_in[2];


        $check_out = explode("/", $data_ouput);
        $day_out = $check_out[0];
        $month_out = $check_out[1];
        $year_out = $check_out[2];

        //S'han de posar les dates en format MYSQL YYYY-MM-DD



        $sql = "SELECT calendars_availability
					FROM calendars 
					WHERE calendars_property_id = ? and
					calendars_availability_month >= ? and calendars_availability_month <= ? 
					and calendars_availability_year >= ? and calendars_availability_year <= ? ";



        $query = $this->db->query($sql, array($property_id, $month_in, $month_out, $year_in, $year_out));

        if ($query->num_rows() > 0)
            foreach ($query->result() as $row) {
                $disponibilidad = $row->calendars_availability;  //0 -> No disponible 1-> Sí disponible
                //Ahora recorremos el array $disponibilidad para ver si no está disponible 
            }
    }

}
