<?php

class Model_property_friendlyrentals extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
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


        $sql = " SELECT  pro.property_provider Codigo, '$data_entry','$data_output',pro.property_persons ,pic.picture_url, texto.text_title, urls.urls_name,pricing_price ,pricing_currency
		FROM property_friendlyrentals pro, picture_friendlyrentals pic, text_friendlyrentals texto, urls_friendlyrentals urls,pricing_friendlyrentals pricing
		WHERE   
		pro.property_id = pic.picture_property_id and 
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
                //Vamos a ver que codido tiene
                //$id = GetIdByCode($codigo);
                //Comprobamos disponibilidad de cada código Si es disponible lo almacenamos en una variable
                if ($this->getAvailabilityFriendlyrentals($data_entry, $data_output, $codigo)) {
                    $codigos_disponibles.= $codigo . ",";
                }
            }
        }
        $codigos_disponibles.= "0";
        //  echo $codigos_disponibles;
        return $codigos_disponibles;
    }

    function getAvailabilityFriendlyrentals($data_entry, $data_output, $property_id) {
        /*
         * Availability daily Y – available
          N – not available
         * 
         * 
         */

        //echo "DATA ENTRY:" . $data_entry;
        //echo "<br>DATA OUTPUT:" . $data_output;
        //echo "<br>CODIGO:" . $property_id;


        if (($data_entry != null) && ($data_output != null)) {



            $data_entry_mysql = explode("/", $data_entry);
            $data_output_mysql = explode("/", $data_output);

            if (empty($data_entry_mysql[2]) || $data_entry_mysql[2] = "") {
                ;
            } else {

                //print_r($data_entry_mysql);

                $data_entry = $data_entry_mysql[2] . '-' . $data_entry_mysql[1] . '-' . $data_entry_mysql[0];
                $data_output = $data_output_mysql[2] . '-' . $data_output_mysql[1] . '-' . $data_output_mysql[0];
            }
            //    echo "FORMATO MYSQL FECHA_ENTRADA:[$data_entry]<BR>";
            //    echo "FORMATO MYSQL FECHA_SALIDA:[$data_output]<BR>";
            //Realizamos la consulta 
            $sql = " SELECT * FROM calendars_friendlyrentals WHERE calendars_code = '$property_id' ";

            // echo $sql;

            /*    echo "<br>";

              echo "FECHA_ENTRADA:[$data_entry]<BR>";
              echo "FECHA_SALIDA:[$data_output]<BR>";
             */
            $num_dias = $this->GetDaysBetweenFechas($data_entry, $data_output);


            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $unavailability_fromday = $row->calendars_unavailablefromdate;
                    $unavailability_today = $row->calendars_unavailabletodate;

                    for ($dia = 1; $dia < $num_dias; $dia ++) {
                        $nuevafecha = strtotime(" + $dia day ", strtotime($data_entry));
                        $nuevafecha = date('Y-m-j', $nuevafecha);



                        //   echo "($nuevafecha > $unavailability_fromday) && ($nuevafecha < $unavailability_today)";
                        if (( strtotime($nuevafecha) > strtotime($unavailability_fromday) ) && ( strtotime($nuevafecha) < strtotime($unavailability_today))) {
                            // echo "NO DISPONIBLE<br>";
                            return false;
                        }
                        //  echo $data_entry + $dia;
                    }
                }
            }
        }
        //echo "DISPONIBLE";
        return true;
    }

}

?>