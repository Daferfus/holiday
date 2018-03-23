<?php

class Model_property extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
    }
	
	public function getTotalProperties($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 0) {
        
		$sql = "SELECT  pro.*, pic.*, lo.*, texto.*, urls.*, pricing.* 
				FROM property pro, picture pic, location lo, text texto, urls, pricing
				WHERE   
				pro.property_id = pic.picture_property_id and 
				pro.property_id = lo.location_property_id and 
				pro.property_id = texto.text_property_id and pro.property_id = urls.urls_property_id and 
				pro.property_id = pricing.pricing_property_id and 
				lo.location_city = ? and texto.text_lang ='es' and urls.urls_lang='es'
				GROUP BY pro.property_id
 
				";

	//	echo $sql;

        $query = $this->db->query($sql, array($city));

		return $query->num_rows();

    }

    public function getAllProperties($city = 'Gandia', $data_entry = null, $data_output = null, $persons = 0,$desde=0,$num=0) {
//echo "CIUDAD:".$city;
//        SELECT  pro.*, pic.*, lo.*
//FROM property pro, picture pic, location lo
//WHERE pro.property_id = (SELECT location_property_id
//                         FROM location
//                         WHERE location_city = "Gandia");
        /*
          FROM newsLEFT JOIN usersON news.user_id = users.idLEFT JOIN commentsON comments.news_id = news.id */
        /*        $sql = "SELECT  pro.*, pic.*, lo.*, texto.*FROM property pro   LEFT JOIN picture picON pro.property_id = pic.picture_property_id, picture pic, location lo, text textoWHERE   pro.property_id = pic.picture_property_id and pro.property_id= lo.location_property_id and pro.property_id= texto.text_property_id and lo.location_city = ? and texto.text_lang ='es' "; */
        $sql = "SELECT  pro.*, pic.*, lo.*, texto.*, urls.*, pricing.*, beds.* 
FROM property pro, picture pic, location lo, text texto, urls, pricing,beds
WHERE   
pro.property_id = pic.picture_property_id and 
pro.property_id = lo.location_property_id and 
pro.property_id = texto.text_property_id and pro.property_id = urls.urls_property_id and 
pro.property_id = pricing.pricing_property_id and 
pro.property_id = beds.beds_property_id and 
lo.location_city = ? and texto.text_lang ='es' and urls.urls_lang='es'
GROUP BY pro.property_id
LIMIT $desde,$num 
";

	//	echo $sql;

        $query = $this->db->query($sql, array($city));
//        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

//        $tots = $city + $data_entry + $data_output + $persons;
//        $tots = $city + $data_entry;
//        $sql = "SELECT  FROM  WHERE =?"; 
//
////
//        $query = $this->db->query($sql, $city);
//        $fila = $query->row();
//        $sql = "SELECT * FROM property WHERE property_location=?";
//        $query = $this->db->query($sql, $city);
//        $fila = $query->row();
//        return $fila;
//        $sql = "SELECT * FROM property";
//        $query = $this->db->query($sql);
//        $query  
//        return $fila->numIncidencias;




    function getAvailability($data_entry, $data_ouput, $property_id) {

        $check_in = explode("/", $data_entry);
        $day_in = $check_in[0];
        $month_in = $check_in[1];
        $year_in = $check_in[2];


        $check_out = explode("/", $data_ouput);
        $day_out = $check_out[0];
        $month_out = $check_out[1];
        $year_out = $check_out[2];


        if ($month_in = $month_out and $year_in = $year_out) {

            $sql = "SELECT `calendars_availability` 
FROM `calendars` 
WHERE `calendars_property_id` = ? and
`calendars_availability_month` = ? and 
`calendars_availability_year` = ?";



            $query = $this->db->query($sql, array($property_id, $month_in, $year_in));

            if ($query->num_rows() > 0) {

                //$result = $query->result();
                $row = $query->row();
//                echo $row->calendars_availability;

                for ($index = $data_entry; $index < strlen($row->calendars_availability); $index++) {
                    echo 'PRova 1 <br>';
                }
            } else {
                echo "Ha fet la consulta pero no troba resultats";
            }
        } else {
            echo "les dades retornes mes d'un mess";
        }




    }

}
