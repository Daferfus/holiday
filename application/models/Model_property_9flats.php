<?php

class Model_property_9flats extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
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

    /*  private function GetAvailability($codigo,){


      } */

    public function InsertarProperties_9flats($city, $persons, $date_in, $date_out) {
        $session_id = $this->getRealIP();
        
       // echo "DATE_IN:".$date_in;
       // echo "<br>DATE_OUT:".$date_out;
        

     /*   $data_entry_mysql = explode('/', $date_in);
        $data_output_mysql = explode('/', $date_out);

        if (empty($data_entry_mysql[2]) || $data_entry_mysql[2] == "") {
            $data_entry = $date_in;
            $data_output = $date_out;
        } else {
*/            $data_entry_mysql = explode('-', $date_in);
            $data_output_mysql = explode('-', $date_out);
            $data_entry = $data_entry_mysql[2] . '-' . $data_entry_mysql[1] . '-' . $data_entry_mysql[0];
            $data_output = $data_output_mysql[2] . '-' . $data_output_mysql[1] . '-' . $data_output_mysql[0];
  //      }




        //$url_feeds = "https://api.9flats.com/api/v4/places?client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF&search[query]=$city&language=es&currency=EUR";

        //Con filtro de fechas , pero tarda mucho
        $url_feeds = "https://api.9flats.com/api/v4/places?client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF&search[query]=$city&language=es&currency=EUR&search[number_of_beds]=$persons&search[start_date]=$data_entry&search[end_date]=$data_output";
        //echo $url_feeds1;
        //$url_feeds = "https://api.9flats.com/api/v4/places?client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF&search[query]=$city&language=es&currency=EUR&search[number_of_beds]=$persons";
        
        //
        ////https://api.9flats.com/api/v4/places?client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF&search[query]=moscu&language=es¤cy=EUR&search[number_of_beds]=4&search[start_date]=13-10-2016&search[end_date]=23-10-2016
        //echo $url_feeds;
        //https://api.9flats.com/api/v4/places?client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF&search[query]=barcelona&language=es&currency=EUR&search[number_of_beds]=4&search[start_date]=2016-10-26&search[end_date]=2016-10-30
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

        if (!empty($jsonData))
            foreach ($jsonData as $indice => $valor) {
                //   echo "<h1>111" . $indice . "</h1>";
                //  var_dump($valor);
                if ($indice == 'places') {
                    foreach ($valor as $indice2 => $valor2) {

                        foreach ($valor2 as $indice => $valor) {

                            //Comprobar disponibilidad
                            //https://api.9flats.com/api/v4/places/354168-name/availability?start_date=2016-10-10&end_date=2016-10-20&client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF
                            $id = $valor->place_details->id;

                            //$url_disponibilidad = "https://api.9flats.com/api/v4/places/$id-name/availability?start_date=2016-10-10&end_date=2016-10-20&client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF";

                            $text_title = $valor->place_details->name;

                            $text_title = $this->db->escape_str($text_title);

                            $property_bedrooms = $valor->place_details->number_of_bedrooms;


                            $beds = $valor->place_details->number_of_beds;
                            $persons = $beds;

                            $property_bathrooms = $valor->place_details->number_of_bathrooms;

                            $property_type = $valor->place_details->category;

                            $pricing_price = $valor->pricing->price;

                            $pricing_currency = $valor->pricing->currency;



                            foreach ($valor->place_details->featured_photo as $indice => $photo) {
                                if ($indice == 'large') {

                                    $picture_url = $photo;
                                }
                            }


                            foreach ($valor->place_details->links as $indice => $link) {
                                if ($link->rel == 'full') {

                                    $url_name = $link->href;
                                }
                            }
                        }
                        //Aqui hay que insertar
                        $sql = " INSERT INTO property_temp (
                            
                property_provider ,property_persons ,picture_url, location_address, text_title, urls_name, pricing_price ,
                pricing_currency, property_session)
                VALUES ('9flats',$persons,'$picture_url','','$text_title','$url_name',$pricing_price,'$pricing_currency','$session_id') ";

                        //    echo $sql;

                        $query = $this->db->query($sql);
                    }
                }
            }
    }

}
