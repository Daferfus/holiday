<?php

class Model_property extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
    }
	
	public function getTotalProperties($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4) {
		
		$where_persons=" ";
		if ($persons > 0) $where_persons=" and pro.property_persons >= $persons ";
        
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

    public function getAllProperties($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 4,$desde=0,$num=0 ,$order="ASC" ) {

		//$desde=$desde*($num-1);
		$where_persons=" ";
		if ($persons > 0) $where_persons=" and pro.property_persons >= $persons ";

			$sql="SELECT   pro.property_persons ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price ,pricing.pricing_currency, beds.beds_double_sofa_beds ,  beds.beds_single_sofa_beds , beds.beds_double_beds
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



            $query = $this->db->query($sql, array($property_id, $month_in,$month_out, $year_in,$year_out));
			
			if ($query->num_rows() > 0)
			foreach ($query->result() as $row)
				{
						$disponibilidad = $row->calendars_availability;  //0 -> No disponible 1-> Sí disponible
						//Ahora recorremos el array $disponibilidad para ver si no está disponible 
						
						
				}
       

    }

}
