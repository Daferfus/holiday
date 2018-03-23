<?php

class Model_property extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
    }

    public function getTotalProperties($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4) {

        $this->InsertAllProperties_intoTemp($city);
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

    public function getAllProperties9Flats($city) {
        
        $session_id = $this->session->userdata('session_id');
        $url_feeds = "https://api.9flats.com/api/v4/places?client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF&search[query]=$city&language=es&currency=EUR";


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_feeds);
        //curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, POST_DATA);
        $response = curl_exec($ch);
        //echo $response;
        if (curl_error($ch)) {
            die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);


        //   $response = file_get_contents($url_feeds);
// Attempt to decode response as json
        $jsonData = json_decode($response);
        //      foreach ($jsonData as $properties) {
        // print_r($jsonData);
        //    }


        foreach ($jsonData as $indice => $valor) {
            echo "<h1>111" . $indice . "</h1>";
            //  var_dump($valor);
            if ($indice == 'places') {
                foreach ($valor as $indice2 => $valor2) {
                    echo "<h2>222" . $indice2 . "</h2>";
                    foreach ($valor2 as $indice => $valor) {
                        echo "<h2>333" . $indice . "</h2>";
                        // var_dump($valor);
                        $name = $valor->place_details->name;
                        echo "<br>NOMBRE:" . $valor->place_details->name;
                        $habitaciones = $valor->place_details->number_of_bedrooms;
                        echo "<br>HAB:" . $valor->place_details->number_of_bedrooms;
                        $camas = $valor->place_details->number_of_beds;
                        echo "<br>CAMAS:" . $valor->place_details->number_of_beds;
                        $banyos = $valor->place_details->number_of_bathrooms;
                        echo "<br>BAÑOS:" . $valor->place_details->number_of_bathrooms;
                        echo "<br>TIPO:" . $valor->place_details->category;
                        echo "<br>DESCRIPCION:" . $valor->place_details->description;
                        $precio = $valor->pricing->price;
                        echo "<br>PRECIO " . $valor->pricing->price;
                        $moneda = $valor->pricing->currency;
                        echo "<br>MONEDA " . $valor->pricing->currency;
                        //print_r($valor->place_details->links);


                        foreach ($valor->place_details->featured_photo as $indice => $photo) {
                            if ($indice == 'large') {

                                echo "<br>FOTO URL: " . $photo;
                            }
                        }


                        foreach ($valor->place_details->links as $indice => $link) {
                            if ($link->rel == 'full') {

                                echo "<br>URL:" . $link->href;
                                $picture_url=$link->href;
                            }
                        }
                    }
                     $sql = " INSERT INTO property_temp ( 
                         property_provider ,property_persons ,picture_url, location_address, text_title, urls_name, 
                         pricing_price ,pricing_currency, beds_double_sofa_beds ,  beds_single_sofa_beds , beds_double_beds, 
                         property_session) 
                         VALUES('9flats',$camas,'$photo','$name','$name','$picture_url',$precio,$moneda,0,0,0,'$session_id')
                            ";
                     $query = $this->db->query($sql);
                }
            }
        }
    }

    public function InsertAllProperties_intoTemp($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4, $desde = 0, $num = 0, $order = "ASC") {

        $session_id = $this->session->userdata('session_id');
        //$desde=$desde*($num-1);
        $where_persons = " ";
        if ($persons > 0)
            $where_persons = " and pro.property_persons >= $persons ";

        // $property_session = $this->session->userdata('item');

        $sql = " INSERT INTO property_temp ( property_provider ,property_persons ,property_bedrooms, property_bathrooms, picture_url, location_address, text_title, urls_name, pricing_price ,pricing_currency, property_session) 
                SELECT  'only-apartments', pro.property_persons ,pro.property_bedrooms,pro.property_bathrooms ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price ,pricing.pricing_currency,'$session_id'
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

        $sql = " INSERT INTO property_temp (property_provider ,property_persons ,picture_url, location_address, text_title, urls_name, pricing_price ,pricing_currency, 
                beds_double_sofa_beds ,  beds_single_sofa_beds , beds_double_beds, property_session) 
                SELECT  'wimdu', pro.property_persons ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name,'$session_id'
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
                ORDER BY pricing.pricing_price $order  ";
        $query = $this->db->query($sql);

        //Fin de propiedades de WIMDU
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
