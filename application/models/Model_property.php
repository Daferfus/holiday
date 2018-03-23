<?php

class Model_property extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->model('Model_property_9flats');
        $this->load->model('Model_property_wimdu');
        $this->load->model('Model_property_interhome');
        $this->load->model('Model_property_friendlyrentals');
        $this->load->model('Model_property_onlyapartments');
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


        //Hemos de borrar tambien las que hacen más de 2 dias.
        //SELECT DATEDIFF( NOW( ) , property_fecha ) FROM  `property_temp` 
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

        //ORDER BY pro.pricing_price $order
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

        //Borramos las propiedades buscada por esta IP.
        $this->deletePropertiesTemp();
        $session_id = $this->getRealIP();
        //$session_id = $this->session->userdata('session_id');
        //$desde=$desde*($num-1);
        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons >= $persons ";

        /*
         * 
         * SELECT pro.property_persons, pro.property_bedrooms, pro.property_bathrooms, pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price, pricing.pricing_currency, '$session_id'
          FROM property_holiday pro, picture_holiday pic, location_holiday lo, text_holiday texto, urls_holiday urls, pricing_holiday pricing
          WHERE pro.property_id = pic.picture_property_id
          AND pro.property_id = lo.location_property_id
          AND pro.property_id = texto.text_property_id
          AND pro.property_id = urls.urls_property_id
          AND pro.property_id = pricing.pricing_property_id
          AND texto.text_title LIKE  '%daimus%'
          AND texto.text_lang =  29
          AND urls.urls_lang =  'es'
          GROUP BY pro.property_id
          LIMIT 0 , 30


         * 
         * 
         * 
         */

        // INSERTAR PROPIEDADES HOLIDAY
        
         $where_calendar = " ";
        $sql = " INSERT INTO property_temp ( property_provider ,data_entry,data_output, property_persons ,property_bedrooms, property_bathrooms, picture_url, location_address, text_title, urls_name, pricing_price ,pricing_currency, property_session ,property_code) 
                SELECT  'holiday','$data_entry','$data_output',pro.property_persons, pro.property_bedrooms, pro.property_bathrooms, pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price, pricing.pricing_currency, '$session_id',
                    pic.picture_property_id
FROM property_holiday pro, picture_holiday pic, location_holiday lo, text_holiday texto, urls_holiday urls, pricing_holiday pricing
WHERE pro.property_id = pic.picture_property_id
AND pro.property_id = lo.location_property_id
AND pro.property_id = texto.text_property_id
AND pro.property_id = urls.urls_property_id
AND pro.property_id = pricing.pricing_property_id
AND texto.text_title LIKE  '%$city%'
AND texto.text_lang =  29
AND urls.urls_lang =  'es'
         
		$where_persons $where_calendar
		
		GROUP BY pro.property_id ";
        /* 	ORDER BY pricing.pricing_price $order

          "; */

       // echo $sql;
         $query = $this->db->query($sql);
        // FIN DE INSERTAR PROPIEDADES HOLIDAY
        // $property_session = $this->session->userdata('item');
        //Insertar todas las propiedades de ONLY-APARTMENTS

        $where_calendar = " ";
        //echo "ONLY-APARTAMENTS INICIO:".date('H:i:s')."<br>";

        $codigos = $this->Model_property_onlyapartments->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons);
        $where_calendar = " AND pro.property_id IN ($codigos)";

        //echo "ONLY-APARTAMENTS DESPUES DE FILTRO:".date('H:i:s')."<br>";

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
		$where_persons $where_calendar
		
		GROUP BY pro.property_id ";
        /* 	ORDER BY pricing.pricing_price $order

          "; */

        //echo $sql;

        $query = $this->db->query($sql);
//        $query = $this->db->query($sql);
        //Insertamos las propiedades de WIMDU
        //echo "ONLY-APARTAMENTS FIN:".date('H:i:s')."<br>";
        //echo "WIMDU INICIO".date('H:i:s')."<br>";
        $where_calendar = " ";

        //Comentado ya que fallaba
      //  $codigos = $this->Model_property_wimdu->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons);
      //  $where_calendar = " AND pro.property_provider IN ($codigos)";

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
                $where_persons $where_calendar
                GROUP BY pro.property_id ";
        /*  ORDER BY pricing.pricing_price $order  "; */

        $query = $this->db->query($sql);
        //echo "FIN DE WIMDU:".date('H:i:s')."<br>";
        //Fin de propiedades de WIMDU
        //Insertamos 9flats
        //echo "9 FLATS INICIO:".date('H:i:s')."<br>";

        $this->Model_property_9flats->InsertarProperties_9flats($city, $persons, $data_entry, $data_output);

        //echo "9 FLATS FIN:".date('H:i:s')."<br>";
        //Fin de 9flats
        //
        //echo "BELVILLA".date('H:i:s')."<br>";
        //Insertamos Propiedades de BELVILLA
        $sql = " INSERT INTO property_temp (property_provider ,data_entry,data_output,property_persons ,picture_url, text_title, urls_name, pricing_price ,pricing_currency, 
           
                 property_session) 
                SELECT  'belvilla', '$data_entry','$data_output',pro.property_persons ,pic.picture_url, texto.text_title, urls.urls_name,pricing_price ,pricing_currency, '$session_id'
		FROM property_belvilla pro, picture_belvilla pic, text_belvilla texto, urls_belvilla urls,pricing_belvilla pricing
		WHERE   
		pro.property_id = pic.picture_property_id and 
	        pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and
                pro.property_id = pricing.pricing_property_id and 
		
		 
		texto.text_title LIKE '%$city%'  
		and texto.text_lang ='es' 
                $where_persons
                GROUP BY pro.property_id ";
        /*  ORDER BY pricing.pricing_price $order  "; */
        $query = $this->db->query($sql);

        //echo "BELVILLA FIN ".date('H:i:s')."<br>";
        //Fin de Belvilla
        //FRIENDLYRENTALS
        //echo "FRIENDLYRENTALS INICIO: ".date('H:i:s')."<br>";
        $codigos = $this->Model_property_friendlyrentals->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons);
        $where_calendar = " ";
        $where_calendar = " AND pro.property_provider IN ($codigos)";

        $sql = " INSERT INTO property_temp (property_provider ,data_entry,data_output,property_persons ,picture_url, text_title, urls_name, pricing_price ,pricing_currency, 
           
                 property_session) 
                SELECT  'friendlyrentals', '$data_entry','$data_output',pro.property_persons ,pic.picture_url, texto.text_title, urls.urls_name,pricing_price ,pricing_currency, '$session_id'
		FROM property_friendlyrentals pro, picture_friendlyrentals pic, text_friendlyrentals texto, urls_friendlyrentals urls,pricing_friendlyrentals pricing
		WHERE   
		pro.property_id = pic.picture_property_id and 
	        pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and
                pro.property_id = pricing.pricing_property_id and 
		
		 
		texto.text_title LIKE '%$city%'  
		and texto.text_lang ='es' 
                $where_persons $where_calendar
                GROUP BY pro.property_id ";
        /* ORDER BY pricing.pricing_price $order  ";  */

        //echo $sql;
        $query = $this->db->query($sql);

        //Fin de FRIENDLYRENTALS
        //echo "FRIENDLYRENTALS FIN: ".date('H:i:s')."<br>";
        //Insertamos INTERHOME
        //Obtenemos sólo los inmuebles dentro de esas fechas de disponibilidades
        //echo "INTERHOME INICIO: ".date('H:i:s')."<br>";
        //$codigos = $this->Model_property_interhome->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons);
        $where_calendar = " ";
        //$where_calendar = " AND pro.property_provider IN ($codigos)";


        $sql = " INSERT INTO property_temp (property_provider ,data_entry,data_output,property_persons ,picture_url, text_title, urls_name, pricing_price ,pricing_currency, 
           
                 property_session) 
                SELECT  'interhome', '$data_entry','$data_output',pro.property_persons ,pic.picture_url, texto.text_title, urls.urls_name,pricing_price ,pricing_currency, '$session_id'
		FROM property_interhome pro, picture_interhome pic, text_interhome texto, urls_interhome urls,pricing_interhome pricing
		WHERE   
		pro.property_id = pic.picture_property_id and 
	        pro.property_id = texto.text_property_id and 
		pro.property_id = urls.urls_property_id and
                pro.property_id = pricing.pricing_property_id and 
		
		 
		texto.text_title LIKE '%$city%'  
		and texto.text_lang ='es' 
                $where_persons $where_calendar 
                GROUP BY pro.property_id ";
        /*  ORDER BY pricing.pricing_price $order  "; */

        // echo $sql;
        $query = $this->db->query($sql);

        //
        //
        //Fin de INTERHOME
        //echo "INTERHOME FIN: ".date('H:i:s')."<br>";
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

            $data_entry = $data_entry_mysql[2] . '-' . $data_entry_mysql[1] . '-' . $data_entry_mysql[0];
            $data_output = $data_output_mysql[2] . '-' . $data_output_mysql[1] . '-' . $data_output_mysql[0];

            //    echo "FORMATO MYSQL FECHA_ENTRADA:[$data_entry]<BR>";
            //    echo "FORMATO MYSQL FECHA_SALIDA:[$data_output]<BR>";
            //Realizamos la consulta 
            $sql = " SELECT * FROM calendars_wimdu WHERE calendars_property_id = $property_id ";

            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $disponibilidad = $row->calendars_availability;
                    // print_r($disponibilidad);


                    $mes = $row->calendars_availability_month;
                    $anyo = $row->calendars_availability_year;
                    //Recorremos $disponibilidad si hay un 1 no está disponible.
                    $calendario = explode(",", $disponibilidad);  //Array Calendario
                    print_r($calendario);
                    $anyo_input = $data_entry_mysql[2];
                    $mes_input = $data_entry_mysql[1];
                    $dia_input = $data_entry_mysql[0];

                    $anyo_output = $data_output_mysql[2];
                    $mes_output = $data_output_mysql[1];
                    $dia_output = $data_output_mysql[0];

                    $desde_dia = $dia_input * (1 + $mes_input - $mes) - 1;
                    $hasta_dia = $dia_output * (1 + $mes_output - $mes) - 1;

                    //echo "DESDE DIA:" . $desde_dia . "<br>";
                    //echo "HASTA DIA:" . $hasta_dia . "<br>";

                    for ($dia = $desde_dia; $dia < $hasta_dia; $dia++) {
                        echo "pos_array" . $dia . "<br>";

                        echo "----" . $calendario[$dia] . "<br>";

                        if ($calendario[$dia] == 1) { //No está disponible
                            echo "NO DISPONIBLE";
                            return false;
                        }
                    }
                }
            }
        }
        echo "DISPONIBLE";
        return true;
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
