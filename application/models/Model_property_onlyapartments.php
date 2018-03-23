<?php

class Model_property_onlyapartments extends CI_Model {

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

        //$data_entry = '01/12/2016';
        //$data_output = '05/12/2016';
        //$property_id = 'CH9475.100.2';
        // $city = "viena";

        $sql = " SELECT  pro.property_id Codigo, '$data_entry','$data_output', pro.property_persons ,pro.property_bedrooms,pro.property_bathrooms ,pic.picture_url, lo.location_address, texto.text_title, urls.urls_name, pricing.pricing_price ,pricing.pricing_currency
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
		ORDER BY pricing.pricing_price ";

        //echo $sql;
        $codigos_disponibles = "";
        $query = $this->db->query($sql);
        
        //echo "ONLY-APARTAMENTS FILTRO:".date('H:i:s')."<br>";
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $codigo = $row->Codigo;
                //Vamos a ver que codido tiene
                //$id = GetIdByCode($codigo);
                //Comprobamos disponibilidad de cada código Si es disponible lo almacenamos en una variable
                if ($this->getAvailability($data_entry, $data_output, $codigo)) {
                    $codigos_disponibles.= "" . $codigo . ",";
                }
            }
        }
        // echo "ONLY-APARTAMENTS FILTRO2:".date('H:i:s')."<br>";
        $codigos_disponibles.= "0";
        //  echo $codigos_disponibles;
        return $codigos_disponibles;
    }

    function getAvailability($data_entry, $data_output, $property_id) {
        /*
         * Availability daily Y – available
          N – not available
         * 
         * 
         */

        //  echo "DATA ENTRY:" . $data_entry;
        //  echo "<br>DATA OUTPUT:" . $data_output;
        //  echo "<br>CODIGO:" . $property_id;


        if (($data_entry != null) && ($data_output != null)) {

            $data_entry_mysql = explode("/", $data_entry);
            $data_output_mysql = explode("/", $data_output);

         //   print_r($data_entry_mysql);

           
            if (empty($data_entry_mysql[2]) || $data_entry_mysql[2] == "") {
               
                $data_entry_mysql = explode("-", $data_entry);
                $data_output_mysql = explode("-", $data_output);
                $mes_in = $data_entry_mysql[1];
                $year_in = $data_entry_mysql[2];
                $day_in = $data_entry_mysql[0];

                $mes_out = $data_output_mysql[1];
                $year_out = $data_output_mysql[2];
                $day_out = $data_output_mysql[0];
            } else {
               // echo"<br>------------";
               // print_r($data_entry_mysql);

                $data_entry = $data_entry_mysql[2] . '-' . $data_entry_mysql[1] . '-' . $data_entry_mysql[0];
                $data_output = $data_output_mysql[2] . '-' . $data_output_mysql[1] . '-' . $data_output_mysql[0];
                $mes_in = $data_entry_mysql[1];
                $year_in = $data_entry_mysql[2];
                $day_in = $data_entry_mysql[0];
                // echo "<br>YEAR_IN".$year_in."<br>";
                $mes_out = $data_output_mysql[1];
                $year_out = $data_output_mysql[2];
                $day_out = $data_output_mysql[0];
            }



            //    echo "FORMATO MYSQL FECHA_ENTRADA:[$data_entry]<BR>";
            //    echo "FORMATO MYSQL FECHA_SALIDA:[$data_output]<BR>";
            //Realizamos la consulta 
            
            $sql = " SELECT * FROM calendars WHERE calendars_property_id = $property_id AND 
                     ( calendars_availability_year >= $year_in AND calendars_availability_year <= $year_out ) AND 
                     ( calendars_availability_month >= $mes_in AND calendars_availability_month <= $mes_out ) ";
                     

           
            //echo $sql . "<br>";

            /*    echo "<br>";

              echo "FECHA_ENTRADA:[$data_entry]<BR>";
              echo "FECHA_SALIDA:[$data_output]<BR>";
             */
            $num_dias = $this->GetDaysBetweenFechas($data_entry, $data_output);

            // echo "<br>DIFERENCIA DIAS:[$num_dias]<br>";

            $query = $this->db->query($sql);

            $pos_inicial = $day_in;

            $pos_inicial--;

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $disponibilidad = $row->calendars_availability;
                    // print_r($disponibilidad);

                    /*
                     * availability string Defines the availability 
                     * of all days in the specified month. It will contain a 
                     * string with 31 characters (max), each one representing 
                     * the availability of one day of the month: 0 (not-available), 1 (available) 
                     * 
                     */
                    /*
                     * 
                     * 
                     * 
                     */


                    //    echo "<br>DISPONIBILIDAD:" . $disponibilidad;
                    //    echo "<br>POS_INICIAL [$pos_inicial]<br>";
                    //    echo "longitud Campo" . strlen($disponibilidad) . "<br>";

                    if ($pos_inicial > strlen($disponibilidad)) {

                        return true;
                    }




                    for ($dia = $pos_inicial; $dia < ($pos_inicial + $num_dias) && $dia < strlen($disponibilidad); $dia++) {
                        // echo $disponibilidad[$dia] . "<br>";
                        if ($disponibilidad[$dia] == "0") {
                            //   echo "NO DISPONIBLE<br>";
                            return false;
                        }
                    } 
                    $pos_inicial = 0;
                }
            }
        }
        // echo "DISPONIBLE";
        return true;
    }

    function GetIdByCode($codigo) {
        $sql = "SELECT property_id FROM property WHERE property = '$codigo' ";
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            return $row->property_id;
        }
    }

}

?>