<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gloveler extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');

        ini_set("memory_limit", "4096M");
        ini_set("max_execution_time", "3600");
        set_time_limit(3600);
    }

    public function index() {
        // echo "Gloveler";
        $url = "https://test.gloveler.com/api.php/accommodations/1.json";
        $this->leer_url($url);
    }

    public function properties() {

        $url = "https://test.gloveler.com/api.php/accommodation-views/fa6637edd1a09718ce0bcb74b0c3ce78.json";
        $this->testear_url($url);
    }

    function testear_url($url) {


        $ch = curl_init();
        $file_name_properties = "/home/holiday/public_html/import/gloveler_all_properties.json";
        $fp = fopen($file_name_properties, "w");  //lo creamos siempre
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, POST_DATA);
        //curl_setopt_array($ch, $options);

        $headers = array();
//        apiKey: key
//apiPassphrase: pass

        $headers[] = 'apiKey: key';
        $headers[] = 'apiPassphrase: pass';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $this->debug("ANTES DE curl_exec");
        $response = curl_exec($ch);
        $this->debug("DESPUES DE curl_exec");
        //$contents = curl_exec($curl);
        fwrite($fp, $response);
        //echo $response;
        if (curl_error($ch)) {
            die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);
        fclose($fp);
    }

    function leer_url($url) {
        $ch = curl_init();
        $file_name_properties = "/home/holiday/public_html/import/gloveler_properties.json";
        $fp = fopen($file_name_properties, "w");  //lo creamos siempre
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, POST_DATA);
        //curl_setopt_array($ch, $options);

        $headers = array();
//        apiKey: key
//apiPassphrase: pass

        $headers[] = 'apiKey: key';
        $headers[] = 'apiPassphrase: pass';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $this->debug("ANTES DE curl_exec");
        $response = curl_exec($ch);
        $this->debug("DESPUES DE curl_exec");
        //$contents = curl_exec($curl);
        fwrite($fp, $response);
        //echo $response;
        if (curl_error($ch)) {
            die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);
        fclose($fp);


        $fp = fopen($file_name_properties, "r");
        $fila = 0;
        while (!feof($fp)) {
            $fila++;
            $linea = fgets($fp);

            $properties = json_decode($linea);
            //print_r($property);
            //echo $linea."<br>";
            if (json_last_error() == JSON_ERROR_NONE) {
                foreach ($properties as $property) {
                    //print_r($property);
                    echo "<br>LINK:" . $property->link;
                    echo "<br>ID:" . $property->id;
                    echo "<br>NAME:" . $property->name;
                    echo "<br>TYPE:" . $property->category;
                    echo "<br>URL:" . $property->url;
                    echo "<br>PERSONS:" . $property->max_guests;
                    echo "<br>DESCRIPTION:" . $property->description;
                    /* "currency": "EUR",
                      "from_price": 35.29, */
                    echo "<br>CURRENCY:" . $property->currency;
                    echo "<br>FROM_PRICE:" . $property->from_price;
                    echo "<br>CITY:" . $property->address->city;
                    echo "<br>COUNTRY:" . $property->address->country_code;
                    echo "<br>FOTO:" . $property->pictures[0]->picture->url;


                    echo "<hr>";
                }
            }


            echo "<hr>";
        }
        fclose($fp);
    }

    function debug($linea) {
        //return;
        $ar = fopen("/home/holiday/public_html/import/datos.txt", "a") or
                die("Problemas en la creacion");
        fputs($ar, $linea);
        $hoy = date("Y-m-d H:i:s");
        fputs($ar, " HORA:" . $hoy);
        fputs($ar, "\n");
        fputs($ar, "--------------------------------------------------------");
        fputs($ar, "\n");
        fclose($ar);
        // echo "Los datos se cargaron correctamente.";
    }

}
