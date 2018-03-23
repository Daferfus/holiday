<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Friendlyrentals extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */

        //  $this->load->library("Nusoap_library"); // load nusoap toolkit library in controller
        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Model_property_friendlyrentals');
        // $this->load->model('Model_property');
        // $this->load->model('Model_webapp_content');
    }

    public function disponibilidades() {
        $persons = 4;
        $city = 'Barcelona';
        $data_entry = '13/10/2016';
        $data_output = '14/10/2016';

        $codigos = $this->Model_property_friendlyrentals->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons = 4);
        echo $codigos;
    }

    public function index() {



        //Comprobar disponibilidades y precios
        //    http://rss.friendlyrentals.com/XML_GetPropertyService.aspx?OrigenId=3612&option=2&city=barcelona&guests=2&checkin=01/12/2016&checkout=05/12/2016
        $this->InitializeTables();

        //Vamos leyendo pagina por página del API , en principio hay 197 páginas
        for ($NumPage = 1; $NumPage <= 197; $NumPage++) {
            $url1 = "http://rss.friendlyrentals.com/XMLProperties.aspx?OrigenId=https://holidayapartment.online_2016&PageNum=" . $NumPage;
            echo $url1 . "<br>";

            // return;
            //echo "HOLA";
            //http://rss.friendlyrentals.com/XML_GetPropertyService.aspx?OrigenId=https://holidayapartment.online_2016&option=2&city=barcelona&guests=2&checkin=01/12/2015&checkout=05/12/2015
            //http://rss.friendlyrentals.com/XMLProperties.aspx?OrigenId=https://holidayapartment.online_2016
            //  $url1 = "http://rss.friendlyrentals.com/XMLProperties.aspx?OrigenId=https://holidayapartment.online_2016";
            //$url1 = "http://rss.friendlyrentals.com/XML_GetPropertyService.aspx?OrigenId=3612&option=2&city=barcelona&guests=2&checkin=01/12/2016&checkout=05/12/2016";
            //TEST147789
            //$xml=simplexml_load_file($url1);
            //print_r($xml);
            // $url1 = "http://rss.friendlyrentals.com/XML_GetPropertyService.aspx?OrigenId=TEST147789&option=2&city=barcelona&guests=2&checkin=01/12/2016&checkout=05/12/2016";

            /*
              ini_set("memory_limit", "4096M");
              ini_set("max_execution_time", "40");
              set_time_limit(40);
             */
            $response_xml_data = file_get_contents($url1, false);
            if ($response_xml_data) {
                // echo $response_xml_data;
                $xml = simplexml_load_string($response_xml_data);
                echo "<br>XML::<br>";
                //print_r($xml);
                //print_r($xml->Totals);
                /*
                 *  [Totals] => SimpleXMLElement Object
                  (
                  [TotalProperties] => 1963
                  [TotalPages] => 197
                  [Page] => 1
                  [PrevPage] => http://rss.friendlyrentals.com/XMLProperties.aspx?OrigenId=https://holidayapartment.online_2016&PageNum=1
                  [NextPage] => http://rss.friendlyrentals.com/XMLProperties.aspx?OrigenId=https://holidayapartment.online_2016&PageNum=2
                  )

                 * 
                 * 
                 */
                foreach ($xml->Totals as $totals) {
                    echo "TOTAL" . $totals->TotalProperties . "<br>";
                    echo "TOTAL PAGINAS" . $totals->TotalPages . "<br>";
                    echo "PAGINA" . $totals->Page . "<br>";
                    echo "PROX PAGINA" . $totals->NextPage . "<br>";
                    $url_next = $totals->NextPage;
                    echo "URL_NEXT" . $url_next;
                    //$this->GetInfoProperties($url_next);
                }
                /*    while (!empty($url_next)) {
                  $url_next = $this->GetInfoProperties($url_next);

                  }
                 */
                //          return;
                foreach ($xml->children() as $properties) {
                    //print_r($property);
                    //echo "ID:".$property->PropertyId;



                    foreach ($properties as $property) {
                        echo "<br><h1>ID:" . $property->PropertyId . "</h1>";

                        if (!empty($property->PropertyId)) {

                            $codigo = $property->PropertyId;
                            echo "<br>NAME:" . $property->Name;

                            echo "<br>Address:" . $property->Address;
                            echo "<br>NAME:" . $property->Name;
                            echo "<br>ZIP:" . $property->ZIP;
                            echo "<br>City:" . $property->City;
                            echo "<br>CountryCode:" . $property->CountryCode;
                            echo "<br>MaxPeople:" . $property->MaxPeople;
                            $MaxNumberOfPersons = $property->MaxPeople;
                            echo "<br>Bedrooms:" . $property->Bedrooms;
                            $NumberOfBedrooms = $property->Bedrooms;
                            echo "<br>DoubleBeds:" . $property->DoubleBeds;
                            echo "<br>DoubleSofaBed:" . $property->DoubleSofaBed;
                            echo "<br>Bathrooms:" . $property->Bathrooms;
                            $NumberOfBathrooms = $property->Bathrooms;
                            echo "<br>PriceMinDay:" . $property->PriceMinDay;
                            echo "<br>Currency:" . $property->Currency;
                            echo "<br>Description:" . $property->Description;
                            echo "<br>LinkToProperty:" . $property->LinkToProperty;
                            echo "<br>LinkToProperty:" . $property->LinkToProperty;
                            echo "<br>LinkToProperty:" . $property->LinkToProperty;
                            echo "<br>IMAGENES";
                            // print_r($property->Images);
                            //Damos de alta las propiedades
                            $HouseType = "Apartment";
                            $data = array(
                                'property_provider' => $codigo,
                                'property_type' => $HouseType,
                                'property_persons' => $MaxNumberOfPersons,
                                'property_bedrooms' => $NumberOfBedrooms,
                                'property_bathrooms' => $NumberOfBathrooms
                            );

                            $this->db->insert('property_friendlyrentals', $data);

                            $last_id = $this->db->insert_id();

                            $property_id = $last_id;


                            $Description = $property->Description;
                            $ShortDescription = $property->City . ":" . $property->Name;
                            $data = array(
                                'text_property_id' => $property_id,
                                'text_lang' => 'es',
                                'text_title' => $ShortDescription,
                                'text_description' => $Description
                            );

                            $this->db->insert('text_friendlyrentals', $data);





                            $url = $property->LinkToProperty;

                            $data = array(
                                'urls_name' => $url,
                                'urls_lang' => 'en',
                                'urls_property_id' => $last_id
                            );

                            $this->db->insert('urls_friendlyrentals', $data);



                            $data = array(
                                'pricing_property_id' => $property_id,
                                'pricing_price' => $property->PriceMinDay,
                                'pricing_currency' => $property->Currency,
                                'pricing_price_type' => 'night'
                            );

                            $this->db->insert('pricing_friendlyrentals', $data);

                            foreach ($property->Images as $Image) {
                                foreach ($Image as $image) {
                                    //echo $image . "<br>";

                                    $picture_url = $image;
                                    //echo $valor4->URL . "<br>";
                                    //damos de alta en picture_belvilla
                                    $data = array(
                                        'picture_property_id' => $property_id,
                                        'picture_url' => $picture_url
                                    );

                                    $this->db->insert('picture_friendlyrentals', $data);
                                }
                            }
                        }


                        //LinkToProperty
                    }
                }
            } else {
                echo "fallo";
            }
        } //Fin del FOR
        return;
    }

    function InitializeTables() {

        ini_set("memory_limit", "4096M");
        ini_set("max_execution_time", "40");
        set_time_limit(40);


        $this->db->truncate('property_friendlyrentals');
        $this->db->truncate('urls_friendlyrentals');
        $this->db->truncate('picture_friendlyrentals');
        $this->db->truncate('pricing_friendlyrentals');
        $this->db->truncate('text_friendlyrentals');
    }

    function GetInfoProperties($url) {

        $response_xml_data = file_get_contents($url, false);
        if ($response_xml_data) {
            // echo $response_xml_data;
            $xml = simplexml_load_string($response_xml_data);

            foreach ($xml->Totals as $totals) {
                echo "GetInfoProperties:TOTAL" . $totals->TotalProperties . "<br>";
                echo "GetInfoProperties:TOTAL PAGINAS" . $totals->TotalPages . "<br>";
                echo "GetInfoProperties:PAGINA" . $totals->Page . "<br>";
                echo "GetInfoProperties:PROX PAGINA" . $totals->NextPage . "<br>";
                $url_next = $totals->NextPage;
                echo "GetInfoProperties:URL_NEXT " . $url_next;
            }


            foreach ($xml->children() as $properties) {


                foreach ($properties as $property) {
                    echo "<br><h1>ID:" . $property->PropertyId . "</h1>";
                    echo "<br>NAME:" . $property->Name;
                    echo "<br>Address:" . $property->Address;
                    echo "<br>NAME:" . $property->Name;
                    echo "<br>ZIP:" . $property->ZIP;
                    echo "<br>City:" . $property->City;
                    echo "<br>CountryCode:" . $property->CountryCode;
                    echo "<br>MaxPeople:" . $property->MaxPeople;
                    echo "<br>Bedrooms:" . $property->Bedrooms;
                    echo "<br>DoubleBeds:" . $property->DoubleBeds;
                    echo "<br>DoubleSofaBed:" . $property->DoubleSofaBed;
                    echo "<br>Bathrooms:" . $property->Bathrooms;
                    echo "<br>PriceMinDay:" . $property->PriceMinDay;
                    echo "<br>Currency:" . $property->Currency;
                    echo "<br>Description:" . $property->Description;
                    echo "<br>LinkToProperty:" . $property->LinkToProperty;
                    echo "<br>LinkToProperty:" . $property->LinkToProperty;
                    echo "<br>LinkToProperty:" . $property->LinkToProperty;
                    echo "<br>IMAGENES";
                    // print_r($property->Images);
                    $i = 0;
                    foreach ($property->Images as $Image) {
                        foreach ($Image as $image)
                            echo $image . "<br>";
                    }
                }
            }
        } else {
            echo "fallo";
        }
        return $url_next;
    }

    function GetTotalPages($url) {
        //$url = "http://rss.friendlyrentals.com/XMLAvailability.aspx?OrigenId=https://holidayapartment.online_2016";
        $response_xml_data = file_get_contents($url, false);
        if ($response_xml_data) {
            // echo $response_xml_data;
            $xml = simplexml_load_string($response_xml_data);
            echo "<br>XML::<br>";
            print_r($xml->Totals);
            echo "Total Paginas:" . $xml->Totals->TotalPages . "......";
            return $xml->Totals->TotalPages;
        }
    }

    function Availability() {
        $this->db->truncate('calendars_friendlyrentals');
        //En directo
        //http://rss.friendlyrentals.com/XML_GetPropertyService.aspx?OrigenId=https://holidayapartment.online_2016&option=2&city=barcelona&guests=2&checkin=01/12/2016&checkout=05/12/2016
        $url = "http://rss.friendlyrentals.com/XMLAvailability.aspx?OrigenId=https://holidayapartment.online_2016";
        $TotalPages = $this->GetTotalPages($url);
        echo "TOTAL PAGES..." . $TotalPages . "<br>";

        for ($NumPage = 1; $NumPage <= $TotalPages; $NumPage++) {


            $url = "http://rss.friendlyrentals.com/XMLAvailability.aspx?OrigenId=https://holidayapartment.online_2016&PageNum=" . $NumPage;
            $response_xml_data = file_get_contents($url, false);
            if ($response_xml_data) {
                // echo $response_xml_data;
                $xml = simplexml_load_string($response_xml_data);
                echo "<br>XML::<br>";
                print_r($xml->Totals);
                echo "Total Paginas:" . $xml->Totals->TotalPages . "......";

                foreach ($xml->children() as $properties) {
//                print_r($properties);
                    foreach ($properties as $property) {
                        if (!empty($property->PropertyId)) {
                            echo "<br><h1>ID:" . $property->PropertyId . "</h1>";
                            $property_id = $this->GetIdByCode($property->PropertyId);
                            $codigo = $property->PropertyId;
                            echo "ID:" . $property_id;
                            echo "<br><h1>NAME:" . $property->Name . "</h1>";
                            print_r($property->UnavailableDates);
                            foreach ($property->UnavailableDates as $disponibilidad) {
                                echo "DESDE:" . $disponibilidad->FromDate;
                                echo "HASTA:" . $disponibilidad->ToDate;

                                //Aquí grabamos las disponibilidades en calendar_friendlyrentals
                                $data = array(
                                    'calendars_property_id' => $property_id,
                                    'calendars_unavailablefromdate' => $disponibilidad->FromDate,
                                    'calendars_unavailabletodate' => $disponibilidad->ToDate,
                                    'calendars_code' => $codigo
                                );

                                $this->db->insert('calendars_friendlyrentals', $data);
                            }
                        }//Fin del empty
                    }
                }
            }
        } //Fin del for
    }

    function GetIdByCode($codigo) {
        $sql = "SELECT property_id FROM property_friendlyrentals WHERE property_provider = '$codigo' ";
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            return $row->property_id;
        }
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
