<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//esto no es obligatorio pero por un tema de seguridad que nos dice si BASEPATH no esta definido no va a cargar
if (!defined('BASEPATH')){exit('No direct script access allowed');}
//aqui es simple preguntamos si no existe la funcion urls_amigables la podemos crear de lo contrario no se crea
if (!function_exists('orderby')) {
    //creamos la funcion y no explico mas sobre que es cada linea por que eso ya es otro tema.
    function orderby($ordenar) {
	//Borramos la variable de sesión
	$CI = & get_instance();
    //$carpeta = $CI->session->userdata('a_activa');	
	$CI->session->unset_userdata('orderby');
	$CI->session->set_userdata('orderby', $ordenar);
	
	//redirect('search');
	
    
    return 0;
    }
}
