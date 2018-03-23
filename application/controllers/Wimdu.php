<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wimdu extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Model_property');
        $this->load->model('Model_webapp_content');
        $this->load->model('Model_property_wimdu');
    }

    public function disponibilidades() {
        $persons = 4;
        $city = 'Barcelona';
        $data_entry = '13/10/2016';
        $data_output = '14/10/2016';

        $codigos = $this->Model_property_wimdu->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons = 4);
        echo $codigos;
    }

    public function index() {
        //   echo "Controlador WINDU<br>";

        $data_entry = "20/09/2016";
        $data_output = "22/09/2016";
        $property_code = "5S1HHSQ3";
        $property_id = 261;

        $this->Model_property->getAvailabilityWimdu($data_entry, $data_output, $property_id);

        return;

        $url_feeds = "https://affiliate.api.wimdu.com/v1/feeds?access_token=f5b603fce8dfe927adc8c8dd0c8960fd838770215a7a9a9ce008ce0ef36ce64f";
        //propiedades .properties
        //$url_feeds="https://wimdu-affiliate.s3-eu-west-1.amazonaws.com/production/PropertyFeed.json?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAJMWG63M4RSDQDH4Q%2F20160620%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20160620T101239Z&X-Amz-Expires=600&X-Amz-Security-Token=FQoDYXdzEBMaDOdcmGwXbNY7Lb0WfiKZA%2BwvP%2B7rJeRdlw2KvXnhDi1Zb8crjs8HMIJq5u7kyACimfQb8iVGgpfT6SdIIhlS74hMXIZXKPOGMU99EWCdAnXPWQNOEnT2xXrOK3cRiF1IXwtYcQ68ABvyn8Jwn59gTu5nRot6qjhL3MLm6xOZwItWmsRiuOj1GerTUgr657s2z4DCqR4FfAY0Dwv2tvPkIXDKeLzzWJB6jQWlgdVljO5SRtQicrDNF1vnByVCRsQNFWJNdoHOrNaDfknhtU60aiaYyykzBw6cF84Qjk3Otj068vgmj9dufgyWY%2BPxovI6k%2FnaaHwu1ji8Vx60Sl6bcuMd5K5xewIDJEkwj7eNXXD6gYO2D%2FjdBmFM9f8bLykQEFe54EsIchoMzPUhp9bj2Ri1cwrvCCHk1IBh1Usy7ujjw7V8XgRJtOJrDUEHMMc5UwnwYAihY%2Bns%2FoGkxtMgGdtEmSD2YTbPmEMNEraPejoQuOLiCuRL9XXX2gy7wlSzKRhUN6hrLt9YNNoIB3L7mCFJSt8ssZfek5f%2BN1xtd687%2B77TG0jkWoIo8%2FueuwU%3D&X-Amz-SignedHeaders=host&X-Amz-Signature=62659ac88d4783351ee497169e7314fec701c779b9384b7e5c0d73edd281255c";
        //$url_feeds = "https://affiliate.api.wimdu.com/v1/feeds?access_token=f5b603fce8dfe927adc8c8dd0c8960fd838770215a7a9a9ce008ce0ef36ce64f";
        //$url_feeds = "https://affiliate.api.wimdu.com/v1/feeds";
        //$url_feeds = "https://affiliate.api.wimdu.com/v1/offer_quotes?ids[]=6IHFH9D7&ids[]=1KUDY8C6&checkin=2016-10-14&checkout=2016-10-27&guest_count=2&access_token=f5b603fce8dfe927adc8c8dd0c8960fd838770215a7a9a9ce008ce0ef36ce64f&guest_country=US&currency=EUR";
        //$response = file_get_contents($url_feeds);
        // $url_feeds ="https://api.9flats.com/api/v4/places?search[lat]=52.502221&search[lng]=13.411259&search[radius]=1&search[per_page]=2&client_id=zRGpFnwfih1f2StodTapHAwslo1mWgk7H0WNnROF";
        // Call the API
        //Añadir para español
        //https://www.wimdu.es/offers/OBBNYGS8?_ga=1.156406195.949306893.1466580749
        ini_set("memory_limit", "1024M");

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
            //     echo "<h1>" . $indice . "</h1>";
            //  var_dump($valor);
            foreach ($valor as $indice2 => $valor2) {
                //       echo "<h2>" . $indice2 . "</h2>";
                if ($indice2 == 'properties')
                    $this->insert_Properties($valor2);
            }
        }


        //var_dump($jsonData);
        // echo $jsonData->json->properties;
        $numero = 0;
        /*      foreach ($jsonData as $property['json']) {
          print_r($property);
          $numero++;
          if ($numero > 1) return;

          }
         */
// Dump array structure for inspection
        //var_dump($jsonData);
    }

    /* --------------------------------------------------------------------- */

    function insert_Properties($url_properties) {

        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            CURLOPT_ENCODING => "", // handle compressed
            CURLOPT_USERAGENT => "test", // name of client
            CURLOPT_AUTOREFERER => true, // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // time-out on connect
            CURLOPT_TIMEOUT => 120, // time-out on response
        );
        echo "Insert_properties($url_properties)<br>";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_properties);
        //curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1200);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, POST_DATA);

        echo "Antes<br>";
        //curl_setopt_array($ch, $options);
        $response = curl_exec($ch);

        echo "Despues curl_exec <br>";
        //echo $response;
        if (curl_error($ch)) {
            die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);

        /* $ctx = stream_context_create(array('http' =>
          array(
          'timeout' => 1200, //1200 Seconds is 20 Minutes
          )
          )); */

        // $response = file_get_contents($url_properties, false);

        echo "CODIGO ANTES json_decode";
        $properties = json_decode($response);

        echo "CODIGO DESPUES DEjson_decode";
        //var_dump($properties);

        return;

        $numero = 0;  //INICIO DE PARRAFO COMENTADO
        foreach ($properties as $indice => $valor) {
            echo "<h1>" . $indice . "</h1>";
            //  var_dump($valor);
            foreach ($valor as $indice2 => $valor2) {
                echo "<h2>" . $indice2 . "</h2>";


                if ($indice2 == "code") {
                    $data = array('property_provider' => $valor2);

                    $str = $this->db->insert_string('property_windu', $data);

                    //echo ($valor2);
                    if ($numero == 0)
                        return;
                }
            }
            return;
        } /* COMENTADO ULTIMO PARRAFO */
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
