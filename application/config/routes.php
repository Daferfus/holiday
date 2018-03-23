<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  
//$route['default_controller'] = 'welcome';
*/
$route['backoffice'] = 'backoffice';
$route['backoffice/(:any)'] = 'backoffice/$1';
$route['backoffice/(:any)/(:any)'] = 'backoffice/$1/$2';

/*$route['products/([a-zA-Z]+)/edit/(\d+)'] = function ($product_type, $id)
{
        return 'catalog/product_edit/' . strtolower($product_type) . '/' . $id;
};*/

//$route['webapp/search/madrid']='alquiler-vacacional-madrid';
//$route['webapp/search/madrid/(:num)']='alquiler-vacacional-madrid/$1';


//$route['alquiler-vacacional']='es/alquiler-vacacional';
//$route['how-to-clean-a-stain-on-the-sofa'] = 'landing/landing_page/how-to-clean-a-stain-on-the-sofa';
//$route['es/alquiler-vacacional-madrid/(:any)']='webapp/search/madrid/$1';

//$route['search/(:any)'] ='alquiler/$1'; 
$route['search3'] = 'alquiler';
$route['search3/(:any)'] = 'webapp/alquiler/$1';
//$route['search/(:any)'] ='webapp/alquiler/$1';

//$route['es/(:any)'] = 'webapp/$1';

$route['9flats'] = 'Nueveflats';
$route['9flats/(:any)'] = 'Nueveflats/$1';


$route['friendlyrentals'] = 'friendlyrentals';
$route['friendlyrentals/(:any)'] = 'friendlyrentals/$1';

$route['datepicker'] = 'datepicker';
$route['datepicker/(:any)'] = 'datepicker/$1';

$route['onlyapartment'] = 'onlyapartment';
$route['onlyapartment/(:any)'] = 'onlyapartment/$1';

$route['holiday'] = 'holiday';
$route['holiday/(:any)'] = 'holiday/$1';

$route['calendario'] = 'calendario';
$route['calendario/(:any)'] = 'calendario/$1';

$route['gloveler'] = 'gloveler';
$route['gloveler/(:any)'] = 'gloveler/$1';

$route['belvilla'] = 'belvilla';
$route['belvilla/(:any)'] = 'belvilla/$1';

$route['interhome'] = 'interhome';
$route['interhome/(:any)'] = 'interhome/$1';

$route['wimdu'] = 'wimdu';
$route['wimdu/(:any)'] = 'wimdu/$1';

$route['calendar'] = 'calendar';
$route['calendar/(:any)'] = 'calendar/$1';

$route['(:any)'] = 'webapp/$1'; //
$route['(:any)/(:any)'] = 'webapp/$1/$2'; //
$route['(:any)/(:any)/(:any)'] = 'webapp/$1/$2/$3'; //

$route['cms/(:any)'] = 'webapp/cms/$1';

//$route['alquiler/(:any)'] = 'webapp/search/$1';



$route['default_controller'] = "webapp";

//Comentar para activar las urls amigables
//$route['(:any)'] = 'webapp/$1';
//Descomentar para activar las urls amigables
//$route['(:any)'] = 'webapp/GetFriendlyUrl/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;



//$route['admin'] = 'Admin_controller';
//$route['admin/(:any)'] = 'Admin_controller/$1';
//
//$route['default_controller'] = 'Front_controller';
//$route['(:any)'] = 'Front_controller/$1';
//$route['(:any)/(:num)'] = 'Front_controller/$1/$2';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;
