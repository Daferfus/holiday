<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Belvilla extends CI_Controller {

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

        ini_set("memory_limit", "4096M");
        ini_set("max_execution_time", "3600");
        set_time_limit(3600);
        $url = "https://listofhousesv1.jsonrpc-partner.net/cgi/lars/jsonrpc-partner/jsonrpc.htm";
        //$url = "https://dataofhousesv1.jsonrpc-partner.net/cgi/lars/jsonrpc-partner/jsonrpc.htm";
        /* The JSON method name is part of the URL. use only lowercase characters in the URL  
          use only lowercase characters in the URL */
        $post_data = array(
            'jsonrpc' => '2.0',
            'method' => 'ListOfHousesV1', /* Methodname is part of the URL   ListOfHousesV1 , DataOfHousesV1 */
            'params' => array(
                'WebpartnerCode' => 'jmanuel',
                'WebpartnerPassword' => 'Rendimiento3',
            ),
            'id' => 566277274 /* a unique integer to identify the call for synchronisation /* a unique integer to identify the call for synchronisation */
        );

        /*     $post_data = array(
          'jsonrpc' => '2.0',
          'method' => 'DataOfHousesV1',
          'params' => array(
          'WebpartnerCode' => 'jmanuel',
          'WebpartnerPassword' => 'Rendimiento3',
          "HouseCodes" => ["ES-03750-07", "ES-17251-19"],
          "Items" =>
          ["BasicInformationV3",
          "MediaV2",
          //        "LanguagePackNLV4",
          //        "LanguagePackFRV4",
          //        "LanguagePackDEV4",
          //        "LanguagePackENV4",
          //        "LanguagePackITV4",
          "LanguagePackESV4",
          //      "LanguagePackPLV4",
          "MinMaxPriceV1",
          "CostsOnSiteV1",
          "PropertiesV1",
          "LayoutExtendedV2",
          "DistancesV2",
          "AvailabilityPeriodV1"
          ]
          ),
          'id' => 566277274
          );
         */
        //https://es.belvilla.org/product/ES-03750-07?pt=jmanuel
        //URL DE RESERVA https://www.belvilla.es/redirecthouse?housecode=FR-46300-14&ad=20160910&nig=7&pos=4
        /*     $post_data = array(
          "jsonrpc" => "2.0",
          "method" => "BookingAdditionsV1",
          "params" => array(
          "WebpartnerCode" => "jmanuel",
          "WebpartnerPassword" => "Rendimiento3",
          "HouseCode" => "XX-1234-03",
          "ArrivalDate" => "2016-09-16",
          "DepartureDate" => "2016-09-18",
          "NumberOfAdults" => 7,
          "NumberOfChildren" => 1,
          "NumberOfBabies" => 0,
          "NumberOfPets" => 0,
          "CustomerCountry" => "ES"
          ),
          "id" =>       16737
          );

         */

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
        /** For large amounts of data use compression for better performance :
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json','Accept-Encoding: gzip,deflate'));
         * */
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        /* use CURL_SSLVERSION_TLSv1_2 for PHP 5 and higher */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); /* Due to a wildcard certificate */
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_ENCODING, 1); /* If result is gzip then unzip /* If result is gzip then unzip */
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($result = curl_exec($ch)) {
            if ($res = json_decode($result)) {
                //       echo "<h1>DATOS:</h1>";
                // print_r($res);
                //Borramos todas las tablas
                $this->db->truncate('property_belvilla');
                $this->db->truncate('urls_belvilla');
                $this->db->truncate('picture_belvilla');
                $this->db->truncate('pricing_belvilla');
                $this->db->truncate('text_belvilla');
                //Fin de Borrar

                $codigo = "";
                $HouseType = "";
                $MaxNumberOfPersons = 0;
                $NumberOfBedrooms = 0;
                $NumberOfBathrooms = 0;



                foreach ($res as $indice => $properties) {
                    echo "<h2>$indice</h2>";
                    if ($indice == "result") {
                        foreach ($properties as $indice => $property) {
  //                          echo "SUBINDICE[" . $indice . "]<br>";
  //                          echo "CODIGO:" . $property->HouseCode . "<br>";
                            $codigo = $property->HouseCode;
                            /*      if ($indice == "BasicInformationV3") { */
                            foreach ($property as $indice2 => $item) {
//                                echo "INDICE2:" . $indice2 . "<br>";

                                if ($indice2 == "MaxNumberOfPersons")
                                    $MaxNumberOfPersons = $item;
                                if ($indice2 == "NumberOfBedrooms")
                                    $NumberOfBedrooms = $item;
                                if ($indice2 == "NumberOfBathrooms")
                                    $NumberOfBathrooms = $item;
                                if ($indice2 == "HouseType")
                                    $HouseType = $item;




                                if ($indice2 == "BasicInformationV3") {

                                    foreach ($information as $indice3 => $item) {
                                    //    echo "INDICE3:" . $indice3 . "=>" . $item . "<br>";
                                        if ($indice3 == "Name")
                                            $name = $item;
                                        if ($indice3 == "MaxNumberOfPersons")
                                            $MaxNumberOfPersons = $item;
                                        if ($indice3 == "NumberOfBedrooms")
                                            $NumberOfBedrooms = $item;
                                        if ($indice3 == "NumberOfBathrooms")
                                            $NumberOfBathrooms = $item;
                                        if ($indice3 == "HouseType")
                                            $HouseType = $item;
                                    }
                                }
                                if ($indice2 == "LanguagePackESV4") {

                                    foreach ($information as $indice3 => $item) {
                                        //   echo "INDICE3:" . $indice3 . "=>" . $item . "<br>";
                              //          echo "INDICE3:" . $indice3 . "<br>";
                                        if ($indice3 == "City") {
                                            $City = $item;
                                //            echo "<br>CIUDAD:$City";
                                        }
                                        if ($indice3 == "ShortDescription") {
                                            $ShortDescription = $item;
                                  //          echo "<br>DESCRIPCION:$ShortDescription ";
                                        }
                                    }
                                }
                            }
                            //Insertar 
                            //echo "Insertamos en property_belvilla<br>";
                            $data = array(
                                'property_provider' => $codigo,
                                'property_type' => $HouseType,
                                'property_persons' => $MaxNumberOfPersons,
                                'property_bedrooms' => $NumberOfBedrooms,
                                'property_bathrooms' => $NumberOfBathrooms
                            );

                            $this->db->insert('property_belvilla', $data);

                            $last_id = $this->db->insert_id();

                            //echo "Insertamos en urls_belvilla<br>";
                            
                            //https://es.belvilla.org/product/ES-03750-07?pt=jmanuel
                            //$url = "https://es.belvilla.org/product/$codigo?pt=jmanuel";

                            $url = "https://www.belvilla.es/redirecthouse?housecode=$codigo&pt=jmanuel";

                            $data = array(
                                'urls_name' => $url,
                                'urls_lang' => 'en',
                                'urls_property_id' => $last_id
                            );

                            $this->db->insert('urls_belvilla', $data);

                            //Aquí llamamos a las otras con el código de la propiedad .$codigo
                            //Rellenamos la información de cada propiedad
                            echo "CODIGO:[$codigo]";
                            $url = "https://dataofhousesv1.jsonrpc-partner.net/cgi/lars/jsonrpc-partner/jsonrpc.htm";
                            $post_data = array(
                                'jsonrpc' => '2.0',
                                'method' => 'DataOfHousesV1',
                                'params' => array(
                                    'WebpartnerCode' => 'jmanuel',
                                    'WebpartnerPassword' => 'Rendimiento3',
                                    "HouseCodes" => [$codigo],
                                    "Items" =>
                                    ["BasicInformationV3",
                                        "MediaV2",
                                        "LanguagePackESV4",
                                        "MinMaxPriceV1",
                                        "CostsOnSiteV1",
                                        "PropertiesV1",
                                        "LayoutExtendedV2",
                                        "DistancesV2",
                                        "AvailabilityPeriodV1"
                                    ]
                                ),
                                'id' => 566277274
                            );
                            $this->CallAPI($url, $post_data);
                         //   return;
                            //Fin de la llamada 
                        }
                    }
                }
            } else
                echo json_last_error();
        } else
            echo curl_error($ch);
        curl_close($ch);



        return;
    }

    function CallAPI($url, $post_data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
        /** For large amounts of data use compression for better performance :
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json','Accept-Encoding: gzip,deflate'));
         * */
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        /* use CURL_SSLVERSION_TLSv1_2 for PHP 5 and higher */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); /* Due to a wildcard certificate */
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_ENCODING, 1); /* If result is gzip then unzip /* If result is gzip then unzip */
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        if ($result = curl_exec($ch)) {
            if ($res = json_decode($result)) {
                //echo "<h1>DATOS CODIGO:</h1>";
                //print_r($res);

                foreach ($res as $indice => $properties) {
                    //echo $indice . "<br>";
                    if ($indice == "result") {
                        foreach ($properties as $indice => $valor) {
                            //echo $indice . "<br>";
                            foreach ($valor as $indice2 => $information) {
                                //echo "INDICE2:" . $indice2 . "<br>";
                                if ($indice2 == "HouseCode") {
                                    //echo $information . "<br>";
                                    $codigo = $information;
                                    $property_id = $this->GetIdByCode($codigo);
                                }
                                if ($indice2 == "BasicInformationV3") {

                                    foreach ($information as $indice3 => $item) {
                                      //  echo "INDICE3:" . $indice3 . "=>" . $item . "<br>";
                                        if ($indice3 == "Name")
                                            $name = $item;
                                        if ($indice3 == "MaxNumberOfPersons")
                                            $MaxNumberOfPersons = $item;
                                        if ($indice3 == "NumberOfBedrooms")
                                            $NumberOfBedrooms = $item;
                                        if ($indice3 == "NumberOfBathrooms")
                                            $NumberOfBathrooms = $item;
                                        if ($indice3 == "HouseType")
                                            $HouseType = $item;
                                    }
                                    //Actualizamos property_belvilla
                                    $data = array(
                                        //   'property_type' => $HouseType,
                                        'property_persons' => $MaxNumberOfPersons,
                                        'property_bedrooms' => $NumberOfBedrooms,
                                        'property_bathrooms' => $NumberOfBathrooms
                                    );

                                    $this->db->where('property_provider', $codigo);
                                    $this->db->update('property_belvilla', $data);
                                }
                                if ($indice2 == "MediaV2") {
                                    foreach ($information as $indice3 => $item) {
                                        //echo "INDICE3:.$indice3<br>";
                                        foreach ($item as $indice => $valor)
                                        //  echo $indice . "<br>";
                                            if ($indice == "TypeContents") {
                                                foreach ($valor as $clave => $valor2) {
                                                    //echo "$clave<br>";
                                                    foreach ($valor2 as $indice => $valor3) {
                                                //        echo "$indice<br>";
                                                        if ($indice == "Versions") {
                                                            foreach ($valor3 as $indice => $valor4) {
                                                                //echo $valor4->Height;
                                                                if ($valor4->Height == 400 && $valor4->Width == 600) {
                                                                    $picture_url = $valor4->URL;
                                                                    //echo $valor4->URL . "<br>";
                                                                    //damos de alta en picture_belvilla
                                                                    $data = array(
                                                                        'picture_property_id' => $property_id,
                                                                        'picture_url' => $picture_url
                                                                    );

                                                                    $this->db->insert('picture_belvilla', $data);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                    }
                                }
                                if ($indice2 == "LanguagePackESV4") {
                                    echo "LanguagePackESV4<br>";
                                    
                                    //print_r($information);
                                  //  echo "<br>SHORTDESCRIPTION($information->ShortDescription)";
                                    
                                 //   echo "<br>DESCRIPTION($information->Description)";
                                    $Description = $information->Description;
                                    $ShortDescription = $information->City.":".$information->ShortDescription;
                                    $data = array(
                                        'text_property_id' => $property_id,
                                        'text_lang' => 'es',
                                        'text_title' => $ShortDescription,
                                        'text_description' => $Description
                                    );

                                   $this->db->insert('text_belvilla', $data);
                                }
                                if ($indice2 == "MinMaxPriceV1") {
                               //     echo "<h2>MinMaxPriceV1</h2>";
                                    //print_r($information);
                               //     echo $information[0]->MinPrice . "<br>";
                                    //echo "PRECIO=".($information[0]->MinPrice)/7;
                                    $precio_por_noche = ($information[0]->MinPrice) / 7;

                                    /*
                                     * pricing_property_id`, `pricing_currency`, `pricing_price_type`, `pricing_price
                                     * 
                                     */
                                    //damos de alta en picture_belvilla
                                    $data = array(
                                        'pricing_property_id' => $property_id,
                                        'pricing_price' => $precio_por_noche,
                                        'pricing_currency' => 'EUR',
                                        'pricing_price_type' => 'night'
                                    );

                                    $this->db->insert('pricing_belvilla', $data);


                                }
                            }
                        }
                    }
                }
            } else
                echo json_last_error();
        } else
            echo curl_error($ch);
        curl_close($ch);
    }

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

    function GetIdByCode($codigo) {
        $sql = "SELECT property_id FROM property_belvilla WHERE property_provider = '$codigo' ";
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            return $row->property_id;
        }
    }

    function CallAPI2($method, $url, $data = false) {
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
