<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Interhome extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Standard Libraries of codeigniter are required */


        $this->load->database(); // Crec que no ens fara falta per que ja heu gastem en el model
        $this->load->library("encrypt");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Model_property');
        $this->load->model('Model_property_interhome');
        $this->load->model('Model_webapp_content');
    }

    //cookie
    //http://www.interhome.com/Forward.aspx?navigationid=10&aCode=DE2981.100.3&partnerid=CH1000833


    public function disponibilidades() {
        $persons = 4;
        $city = 'Barcelona';
        $data_entry = '07-11-2016';
        $data_output = '11-11-2016';
        
        $codigos = $this->Model_property_interhome->getPropertiesWithAvailability($data_entry, $data_output, $city, $persons = 4);
        echo $codigos;
    }
    public function index() {
        $data_entry = '01/12/2016';
        $data_output = '05/12/2016';
        $property_id = 'CH9475.100.2';
        $city = "viena";


        //$this->getPropertiesWithAvailability($data_entry, $data_output, $city);
        //$this->getAvailabilityInterhome($data_entry, $data_output, $property_id);
        //$this->Model_property_interhome->getAvailabilityInterhome($data_entry, $data_output, $property_id);
        //return;
        //
        //
        //Conectamos por ftp a Interhome
        $this->Model_property_interhome->ConectarFTPInterhome();
        
//Insertamos fichero de Acomodations EN 1 LUGAR
        
        echo "Insertar ACOMMODATION";
        $this->acomodation();
        
        echo "<br>------- FIN ACOMODATION ----";
        
        //return;
        //Insertamos fichero de Precios
        // $this->dailyprice();
        // return;
        //return;
        //$this->countryregionplace();
        //
        //
        //$this->insidedescription();
        
        //return;
        //FICHERO RESUMEN , CON LOS TEXTOS COMPLETOS EN 2 LUGAR
        
        
        echo "<br>------- PROPERTYSUMMARY ----";
        $this->propertysummary();
        
        echo "<br>------- FIN RESUMEN ----";
        //Disponibilidades , EN 3 LUGAR
        echo "<br>------- VACANCY ----";
        $this->vacancy();
        echo "<br>---FIN VACANCY ----";

        return;
    }

    function vacancy() {

        $this->db->truncate('calendars_interhome');
        //Comprobar disponibilidad
        $xml_file = '/home/holiday/public_html/import/interhome/vacancy.xml';

        echo "ABRIR FICHERO :$xml_file<br>";
        if (file_exists($xml_file)) {
            if (!$xml = simplexml_load_file($xml_file)) {
                echo "error de base";
                trigger_error('Error reading XML file' . $xml_file, E_USER_ERROR);
            }
            //Aquí el código
            $properties = 1;


            // print_r($xml);
            foreach ($xml->vacancy as $vacancy) {
                //print_r($price);
         //       echo "<br>CODIGO:" . $vacancy->code;
         //       echo "<br>FECHA_ENTRADA:" . $vacancy->startday;

         //       echo "<BR>DISPONIBLIDAD:" . $vacancy->availability;
         //       echo "<br> Lon disponibilidad =" . strlen($vacancy->availability);

                $startday = $vacancy->startday;

                $disponibilidad = $vacancy->availability;
                $codigo = $vacancy->code;
                $property_id = $this->GetIdByCode($codigo);

                $data = array(
                    'calendars_property_id' => $property_id,
                    'calendars_availability' => $disponibilidad,
                    'calendars_availability_startday' => $startday,
                    'calendars_code' => $codigo
                );

                

                $this->db->insert('calendars_interhome', $data);
            }
        }
    }

    function dailyprice() {
        $this->db->truncate('pricing_interhome');
        $xml_file = '/home/holiday/public_html/import/interhome/dailyprice_0505_eur.xml';

        echo "ABRIR FICHERO :$xml_file<br>";
        if (file_exists($xml_file)) {
            if (!$xml = simplexml_load_file($xml_file)) {
                echo "error de base";
                trigger_error('Error reading XML file' . $xml_file, E_USER_ERROR);
            }
            /* Estructura de dailyprice
             * 
             * <prices> 
             *  <price> 
             *      <code>CH3920.4.2</code>
             *      <startdate>2010-12-01</startdate>
             *      <enddate>2010-12-23</enddate>
             *      <baseprice>217.00</baseprice>
             *      <midweekprice>0.00</midweekprice>
             *      <weekendprice>0.00</weekendprice>
             *      <fixprice>73.00</fixprice>
             *  </price> 
             * </prices>         
             * 
             */

            $properties = 1;
            foreach ($xml->price as $price) {
                print_r($price);

                $codigo = $price->code;
                $price = $price->rentalprice;
                $price_base = $price->baseprice;

                //Alta del Precio
                $precio_por_noche = $price;

                /*
                 * pricing_property_id`, `pricing_currency`, `pricing_price_type`, `pricing_price
                 * 
                 */
                //damos de alta en pricing_interhome

                $property_id = $this->GetIdByCode($codigo);
                $data = array(
                    'pricing_property_id' => $property_id,
                    'pricing_price' => $precio_por_noche,
                    'pricing_currency' => 'EUR',
                    'pricing_price_type' => 'night'
                );

                echo "<br>A insertar Precio" . print_r($data) . "<br>";

                $this->db->insert('pricing_interhome', $data);

                //Fin del Precio
                $properties++;
                if ($properties > 10)
                    return;
            }
        }
    }

    function acomodation() {
        
        ini_set("memory_limit", "4096M");
        ini_set("max_execution_time", "3600");
        set_time_limit(3600);

        $this->db->truncate('property_interhome');
        $this->db->truncate('text_interhome');
        $this->db->truncate('urls_interhome');
        $this->db->truncate('picture_interhome');

        $xml_file = '/home/holiday/public_html/import/interhome/accommodation.xml';

        echo "ABRIR FICHERO :$xml_file<br>";
        if (file_exists($xml_file)) {
            if (!$xml = simplexml_load_file($xml_file)) {
                echo "error de base";
                trigger_error('Error reading XML file' . $xml_file, E_USER_ERROR);
            }
            //   $this->InitializeTables();
            $properties = 1;
            foreach ($xml->accommodation as $accommodation) {
             //   echo "<br>CODIGO:" . $accommodation->code;
                $codigo = $accommodation->code;
                //  echo "<br>TIPO:" . $accommodation->type;
                $HouseType = $accommodation->type;
                //  echo "<br>NOMBRE:" . $accommodation->name;
                $name = $accommodation->name;
                //   echo "<br>NºPersonas:" . $accommodation->pax;
                $MaxNumberOfPersons = $accommodation->pax;
                //   echo "<br>COUNTRY:" . $accommodation->country;
                $country = $accommodation->country;
                //   echo "<br>REGION:" . $accommodation->region;
                $region = $accommodation->region;
                //   echo "<br>PLACE:" . $accommodation->place;
                $place = $accommodation->place;
                //   echo "<br>ZIP:" . $accommodation->zip;
                //   echo "<br>DETALLES:" . $accommodation->details;
                //   echo "<br>SUPERFICIE:" . $accommodation->sqm;
                $size = $accommodation->sqm;
                //   echo "<br>HAB:" . $accommodation->rooms;
                //   echo "<br>Dormitorios:" . $accommodation->bedrooms;
                $NumberOfBedrooms = $accommodation->bedrooms;
                //  echo "<br>Baños:" . $accommodation->bathrooms;
                $NumberOfBathrooms = $accommodation->bathrooms;
                //  echo "<br>PICTURES<br>";
                //print_r($accommodation->pictures);
                //  echo "<br>" . $accommodation->pictures->picture[0]->url;
                $image = $accommodation->pictures->picture[0]->url;
                //foreach ($accommodation->pictures as $picture){
                //    echo($picture->url);
                // }
                //echo "<br>ATRIBUTOS<br>";
                // print_r($accommodation->attributes);
                //Damos de alta las propiedades

                $data = array(
                    'property_provider' => $codigo,
                    'property_type' => $HouseType,
                    'property_persons' => $MaxNumberOfPersons,
                    'property_bedrooms' => $NumberOfBedrooms,
                    'property_bathrooms' => $NumberOfBathrooms,
                    'property_size' => $size
                );

                $this->db->insert('property_interhome', $data);

                $last_id = $this->db->insert_id();

                $property_id = $last_id;
                //Fin de las propiedades
                //
                //
                //pictures
                $picture_url = $image;
                //echo $valor4->URL . "<br>";
                //damos de alta en picture_belvilla
                $data = array(
                    'picture_property_id' => $property_id,
                    'picture_url' => $picture_url
                );

                $this->db->insert('picture_interhome', $data);
               
                /*
                //Damos de alta los textos

                $Description = $name;
                $ShortDescription = $this->GetLocationByCode($country, $region, $place, $name);
                $data = array(
                    'text_property_id' => $property_id,
                    'text_lang' => 'es',
                    'text_title' => $ShortDescription,
                    'text_description' => $Description
                );

                $this->db->insert('text_interhome', $data);
                 
                 */

                $url = "http://www.interhome.com/Forward.aspx?navigationid=10&aCode=" . $codigo . "&partnerid=ES1005936";


                $data = array(
                    'urls_name' => $url,
                    'urls_lang' => 'en',
                    'urls_property_id' => $last_id
                );

                $this->db->insert('urls_interhome', $data);

                $properties++;
                //echo "Propiedades :".$properties;
                // if ($properties > 10)
                //     return;
            }
        } else
            echo "FICHERO [$xml_file] NO ENCONTRADO";
    }

    function GetLocationByCode($country, $region, $place, $name) {

        echo "GetLocationByCode($country, $region, $place,$name)<br>";


        $sql = "SELECT * 
            FROM country_interhome c, region_interhome r, place_interhome p
            WHERE c.country_interhome_id = r.region_country_interhome_id
            AND p.place_region_interhome_id = r.region_interhome_id
            AND c.country_interhome_code =  ?
            AND r.region_interhome_code = ? 
            AND p.place_interhome_code = ? ";

        $query = $this->db->query($sql, array($country, $region, $place));

        foreach ($query->result() as $row) {
            $text = $row->region_interhome_name . ":" . $name . ", " . $row->place_interhome_name;
            return $text;
        }
    }

    function GetIdByCode($codigo) {
        $sql = "SELECT property_id FROM property_interhome WHERE property_provider = '$codigo' ";
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            return $row->property_id;
        }
    }

    function insidedescription() {
        $xml_file_description = '/home/holiday/public_html/import/interhome/insidedescription_es.xml';
        echo "ABRIR FICHERO COUNTRY :$xml_file_description<br>";
        if (file_exists($xml_file_description)) {
            if (!$xml = simplexml_load_file($xml_file_description)) {
                echo "error de base";
                trigger_error('Error reading XML file' . $xml_file_description, E_USER_ERROR);
            }

            foreach ($xml->description as $description) {
                echo "CODE:" . $description->code;
                $code = $description->code;
                $property_id = $this->GetIdByCode($code);
                echo "<br>TEXT:" . $description->text;

                $Description = $description->text;
                //$ShortDescription = $property->City . ":" . $property->Name;
                $ShortDescription = $Description;
                $data = array(
                    'text_property_id' => $property_id,
                    'text_lang' => 'es',
                    'text_title' => $ShortDescription,
                    'text_description' => $Description
                );

                //$this->db->insert('text_interhome', $data);

                $this->db->where('text_property_id', $property_id);
                $this->db->update('text_interhome', $data);
            }
        }
    }

    function propertysummary() {

        //ACTUALIZA PRECIOS Y DESCRIPCIONES
        //Borramos fichero de precios
        $this->db->truncate('pricing_interhome');
        $this->db->truncate('text_interhome');

        $xml_file_summary = '/home/holiday/public_html/import/interhome/propertysummary_0505_eur_es.xml';
        echo "ABRIR FICHERO COUNTRY :$xml_file_summary<br>";
        if (file_exists($xml_file_summary)) {
            if (!$xml = simplexml_load_file($xml_file_summary)) {
                echo "error de base";
                trigger_error('Error reading XML file' . $xml_file_summary, E_USER_ERROR);
            }
            //Inicializamos las 
            //echo "hola";
            $properties = 1;
            foreach ($xml->accommodation as $property) {
                // print_r($property);
                /*   echo "<br>CODE: " . $property->code;
                  echo "<br>NAME: " . $property->name;
                  echo "<br>DESCRIPTION: " . $property->text;
                  echo "<br>REGION: " . $property->region;
                  echo "<br>PLACE: " . $property->place;

                  echo "<br>URL: " . $property->url;
                  echo "<br>PICTURE1: " . $property->picture1;
                  echo "<br>PRECIO: " . ($property->minrentalprice / 7) . "<br>";
                 */
                $codigo = $property->code;

                $Description = $property->text;
                $ShortDescription = $property->region . "," . $property->place . "." . $property->name;
                $property_id = $this->GetIdByCode($codigo);

                //Actualizamos el texto
                $data = array(
                    'text_property_id' => $property_id,
                    'text_lang' => 'es',
                    'text_title' => $ShortDescription,
                    'text_description' => $Description
                );
                
                $this->db->insert('text_interhome', $data);

             //   $this->db->where('text_property_id', $property_id);
             //   $this->db->update('text_interhome', $data);

                //Actualizamos el precio



                if ($property->minrentalprice > 7)
                    $precio_por_noche = ($property->minrentalprice / 7);
                else
                    $precio_por_noche = 100;

                $data = array(
                    'pricing_property_id' => $property_id,
                    'pricing_price' => $precio_por_noche,
                    'pricing_currency' => 'EUR',
                    'pricing_price_type' => 'night'
                );

                //  echo "<br>A insertar Precio" . print_r($data) . "<br>";

                $this->db->insert('pricing_interhome', $data);

                //echo "PROPIEDAD".$properties;
                //$properties++;
            }
        }
    }

    function countryregionplace() {

        $xml_file_country = '/home/holiday/public_html/import/interhome/countryregionplace_es.xml';
        echo "ABRIR FICHERO COUNTRY :$xml_file_country<br>";
        if (file_exists($xml_file_country)) {
            if (!$xml = simplexml_load_file($xml_file_country)) {
                echo "error de base";
                trigger_error('Error reading XML file' . $xml_file_country, E_USER_ERROR);
            }
            //Inicializamos las tablas
            $this->InitializeTables();
            $properties = 1;
            foreach ($xml->country as $country) {
                //print_r($country);
                echo "<br>Codigo:" . $country->code;
                echo "<br>Name:" . $country->name;

                $data = array(
                    'country_interhome_code' => $country->code,
                    'country_interhome_name' => $country->name
                );

                $this->db->insert('country_interhome', $data);


                $last_id = $this->db->insert_id();

                $country_id = $last_id;

                //echo "REGION NAME" . $country->regions->region->name;
                foreach ($country->regions->children() as $region) {
                    // print_r($region);
                    echo "<br>CODIGO REGION:" . $region->code;
                    echo "<br>NOMBRE REGION:" . $region->name;

                    $data = array(
                        'region_country_interhome_id' => $country_id,
                        'region_interhome_code' => $region->code,
                        'region_interhome_name' => $region->name
                    );

                    $this->db->insert('region_interhome', $data);

                    $last_id = $this->db->insert_id();

                    $region_id = $last_id;

                    //        echo "<br>COUNT".count($region->places->children());


                    if (!empty($country->regions->region->places))
                        foreach ($region->places->children() as $place) {
                            echo "<br>CODIGO PLACE:" . $place->code;
                            echo "<br>NOMBRE PLACE:" . $place->name;
                            $data = array(
                                'place_region_interhome_id' => $region_id,
                                'place_interhome_code' => $place->code,
                                'place_interhome_name' => $place->name
                            );

                            $this->db->insert('place_interhome', $data);
                        }
                }
            }
        }

        return;
    }

    function InitializeTables() {

        ini_set("memory_limit", "4096M");
        ini_set("max_execution_time", "40");
        set_time_limit(40);

        $this->db->truncate('country_interhome');
        $this->db->truncate('region_interhome');
        $this->db->truncate('place_interhome');

        /*  $this->db->truncate('property_interhome');
          $this->db->truncate('urls_interhome');
          $this->db->truncate('picture_interhome');
          $this->db->truncate('pricing_interhome');
          $this->db->truncate('text_interhome');
         */
    }

}
