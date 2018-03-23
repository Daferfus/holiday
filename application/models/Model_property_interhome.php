<?php

class Model_property_interhome extends CI_Model {

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

    function ConectarFTPInterhome() {

        /*
          === FTP credentials ===
          You can access the Interhome XML product feeds using the following FTP credentials:

          Host: ftp.interhome.com
          User: ihxmlpartner
          Password: XZpJ6LkG

         */


// Rutas al archivo (local y FTP)
//Archivo Propiedades
        $local_file_pro = '/home/holiday/public_html/import/interhome/accommodation.xml.zip'; //Nombre archivo en nuestro PC 
        $local_file_pro_des = '/home/holiday/public_html/import/interhome/accommodation.xml';
        $server_file_pro = 'accommodation.xml.zip'; //Nombre archivo en FTP
//Archivo Resumen propertysummary_0505_eur_es.xml.zip
        $local_file_res = '/home/holiday/public_html/import/interhome/propertysummary_0505_eur_es.xml.zip'; //Nombre archivo en nuestro PC
        $local_file_res_des = '/home/holiday/public_html/import/interhome/propertysummary_0505_eur_es.xml';
        $server_file_res = 'propertysummary_0505_eur_es.xml.zip'; //Nombre archivo en FTP
//Archivos de Disponibilidades
        $local_file_cal = '/home/holiday/public_html/import/interhome/vacancy.xml.zip'; //Nombre archivo en nuestro PC
        $local_file_cal_des = '/home/holiday/public_html/import/interhome/vacancy.xml';
        $server_file_cal = 'vacancy.xml.zip'; //Nombre archivo en FTP
// Establecer la conexión
        $ftp_server = 'ftp.interhome.com';
        $ftp_user_name = 'ihxmlpartner';
        $ftp_user_pass = 'XZpJ6LkG';

        $conn_id = ftp_connect($ftp_server) or die("No se ha podido conectar a $ftp_server");


// Loguearse con usuario y contraseña
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        if ((!$conn_id) || (!$login_result))
            die("FTP Conecxión fallida");


//Descarga el $server_file y lo guarda en $local_file
//Descarga el fichero de disponibilidades
        if (ftp_get($conn_id, $local_file_cal, $server_file_cal, FTP_BINARY)) {
            echo "<br>Se descargado el archivo con éxito el calendario\n";
        } else {
            echo "<br>Ha ocurrido un error en calendario\n";
        }

//Descarga Propiedad
        if (ftp_get($conn_id, $local_file_pro, $server_file_pro, FTP_BINARY)) {
            echo "<br>Se descargado el archivo con éxito las propiedades\n";
        } else {
            echo "<br>Ha ocurrido un error en propiedades\n";
        }

//Descarga Resumen
        if (ftp_get($conn_id, $local_file_res, $server_file_res, FTP_BINARY)) {
            echo "<br>Se descargado el archivo con éxito el fichero resumen\n";
        } else {
            echo "<br>Ha ocurrido un error en propiedades\n";
        }


// Cerrar la conexión
        ftp_close($conn_id);



//DESCOMPRIMIR ZIP

        $zip = new ZipArchive();

        if ($zip->open($local_file_cal) === TRUE) {

            $zip->extractTo('/home/holiday/public_html/import/interhome/');
            $zip->close();
            echo '<br>ok DESCOMPRIMIDO ' . $local_file_cal;
        } else {
            echo '<br>failed' . $local_file_cal;
        }



        $zip = new ZipArchive();
        if ($zip->open($local_file_res) === TRUE) {
            $zip->extractTo('/home/holiday/public_html/import/interhome/');
            $zip->close();
            echo '<br>ok DESCOMPRIMIDO ' . $local_file_res;
        } else {
            echo '<br>failed' . $local_file_res;
        }

        $zip = new ZipArchive();
        if ($zip->open($local_file_pro) === TRUE) {
            $zip->extractTo('/home/holiday/public_html/import/interhome/');
            $zip->close();
            echo '<br>ok DESCOMPRIMIDO ' . $local_file_pro;
        } else {
            echo '<br>failed' . $local_file_pro;
        }

//FIN DE DESCOMPRIMIR ZIP
//Cambiamos los permisos
        chmod($local_file_pro_des, 0777);  // octal; valor de modo correcto
        chmod($local_file_res_des, 0777);  // octal; valor de modo correcto
        chmod($local_file_cal_des, 0777);  // octal; valor de modo correcto
    }

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

        $sql = " SELECT  pro.property_provider Codigo,pro.property_persons ,pic.picture_url, texto.text_title, urls.urls_name,pricing_price ,pricing_currency
		FROM property_interhome pro, picture_interhome pic, text_interhome texto, urls_interhome urls,pricing_interhome pricing
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

        //echo $sql;
        $codigos_disponibles = "";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $codigo = $row->Codigo;
                //Vamos a ver que codido tiene
                //$id = GetIdByCode($codigo);
                //Comprobamos disponibilidad de cada código Si es disponible lo almacenamos en una variable
                if ($this->getAvailabilityInterhome($data_entry, $data_output, $codigo)) {
                    $codigos_disponibles.= "'" . $codigo . "',";
                }
            }
        }
        $codigos_disponibles.= "'ATXXXXX'";
        //  echo $codigos_disponibles;
        return $codigos_disponibles;
    }

    function getAvailabilityInterhome($data_entry, $data_output, $property_id) {
        /*
         * Availability daily Y – available
          N – not available
         * 
         * 
         */

          // echo "DATA ENTRY:" . $data_entry;
          // echo "<br>DATA OUTPUT:" . $data_output;
          // echo "<br>CODIGO:" . $property_id;


        if (($data_entry != null) && ($data_output != null)) {



            $data_entry_mysql = explode("-", $data_entry);
            $data_output_mysql = explode("-", $data_output);

            //print_r($data_entry_mysql);

            $data_entry = $data_entry_mysql[2] . '-' . $data_entry_mysql[1] . '-' . $data_entry_mysql[0];
            $data_output = $data_output_mysql[2] . '-' . $data_output_mysql[1] . '-' . $data_output_mysql[0];

            //    echo "FORMATO MYSQL FECHA_ENTRADA:[$data_entry]<BR>";
            //    echo "FORMATO MYSQL FECHA_SALIDA:[$data_output]<BR>";
            //Realizamos la consulta 
            $sql = " SELECT * FROM calendars_interhome WHERE calendars_code = '$property_id' ";

            //echo $sql;

        /*    echo "<br>";

            echo "FECHA_ENTRADA:[$data_entry]<BR>";
            echo "FECHA_SALIDA:[$data_output]<BR>";
*/
            $num_dias = $this->GetDaysBetweenFechas($data_entry, $data_output);

  //          echo "<br>DIFERENCIA DIAS:[$num_dias]<br>";

            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $disponibilidad = $row->calendars_availability;
                   // print_r($disponibilidad);




                    $startday = $row->calendars_availability_startday;


                 //   echo "<br>FECHA_START [$startday] <br>DISPONIBILIDAD:" . $disponibilidad;



                    $pos_inicial = $this->GetDaysBetweenFechas($startday, $data_entry);

                  /*  echo "<br>POS_INICIAL [$pos_inicial]<br>";
                    echo "longitud Campo" . strlen($disponibilidad) . "<br>";
*/
                    if ($pos_inicial > strlen($disponibilidad)) {

                        return true;
                    }




                    for ($dia = $pos_inicial; $dia < ($pos_inicial + $num_dias); $dia++) {
                      //  echo $disponibilidad[$dia] . "<br>";
                        if ($disponibilidad[$dia] == "N") {
                           // echo "NO DISPONIBLE<br>";
                            return false;
                        }
                    }
                }
            }
        }
        //echo "DISPONIBLE";
        return true;
    }

}

?>