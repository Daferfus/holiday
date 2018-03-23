<?php

class Model_property_wimdu extends CI_Model {

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
                    $codigos_disponibles.= $codigo_id . ",";
                }
            }
        }
        $codigos_disponibles.= "0";
        // echo "<br>CODIGOS DISPONIBLES PROVIDER:".$codigos_disponibles;
        //echo "<br>CODIGOS DISPONIBLES:".$codigos_disponibles;
        return $codigos_disponibles;
    }

    function GetIdByCode($codigo) {
        $sql = "SELECT property_id FROM property_wimdu WHERE property_provider = '$codigo' ";
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