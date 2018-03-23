<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nueveflats extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');
    }

    public function index() {
        //   echo "Controlador WINDU<br>";

        $session_id = session_id();

        $url_feeds = "https://api.9flats.com/api/v4/places?client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF&search[query]=Ibiza&language=es&currency=EUR";


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
                        $text_title = $valor->place_details->name;
                        echo "<br>NOMBRE:" . $valor->place_details->name;
                        $property_bedrooms = $valor->place_details->number_of_bedrooms;

                        echo "<br>HAB:" . $valor->place_details->number_of_bedrooms;
                        $beds = $valor->place_details->number_of_beds;
                        $persons = $beds;
                        echo "<br>CAMAS:" . $valor->place_details->number_of_beds;
                        $property_bathrooms = $valor->place_details->number_of_bathrooms;
                        echo "<br>BAÑOS:" . $valor->place_details->number_of_bathrooms;
                        $property_type = $valor->place_details->category;
                        echo "<br>TIPO:" . $valor->place_details->category;

                        echo "<br>DESCRIPCION:" . $valor->place_details->description;
                        $pricing_price = $valor->pricing->price;
                        echo "<br>PRECIO " . $valor->pricing->price;
                        $pricing_currency = $valor->pricing->currency;
                        echo "<br>MONEDA " . $valor->pricing->currency;
                        //print_r($valor->place_details->links);


                        foreach ($valor->place_details->featured_photo as $indice => $photo) {
                            if ($indice == 'large') {

                                $picture_url = $photo;

                                echo "<br>FOTO URL: " . $photo;
                            }
                        }


                        foreach ($valor->place_details->links as $indice => $link) {
                            if ($link->rel == 'full') {

                                $url_name = $link->href;

                                echo "<br>URL:" . $link->href;
                            }
                        }
                    }
                    //Aqui hay que insertar
                    $sql = " INSERT INTO property_temp (
                            
                property_provider ,property_persons ,picture_url, location_address, text_title, urls_name, pricing_price ,
                pricing_currency, property_session)
                VALUES ('9flats',$persons,'$picture_url','','$text_title',' $url_name',$pricing_price,'$pricing_currency','$session_id') ";

                    echo $sql;

                    $query = $this->db->query($sql);
                }
            }
        }
    }

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

    function CallAPI($method, $url, $data = false) {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

}
