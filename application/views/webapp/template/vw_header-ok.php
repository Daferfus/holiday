<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">

        <?php echo $robots; ?>

        

        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no" />
        <meta name="msvalidate.01" content="70E018081123AB5CA55DB5E72F9FB841" />

        <!--calendario-->
        <link href="<?php echo base_url('assets/backoffice'); ?>/css/jquery-ui.css" rel="stylesheet"/>
        <script src="<?php echo base_url('assets/webapp'); ?>/js/jquery-2.1.4.min.js"></script>
        
        <script type="text/javascript">
            /*Calendario de la página principal "vw_index.php"*/
            var diaSeleccionado;
            var srt;
            var dia;
            var min=2;
             $(document).ready(function() {//calendario desde
             $("#data_entry").datepicker({ 
                    dayNamesMin: [ "Dom","Lun","Mar","Mie","Jue","Vie","Sáb" ],
                    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo",
                       "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                       "Noviembre", "Diciembre" ],
                    minDate: 1,
                    firstDay: 1,
                    dateFormat: "dd/mm/yy",
                    onSelect: function (date) {
                        diaSeleccionado=date;
                        str=diaSeleccionado.toString();
                        dia= str.substring(0, 2);
                        min= parseInt(dia);
                        
                        //calendario hasta
                        $("#data_output").datepicker( {
                            dayNamesMin: [ "Dom","Lun","Mar","Mie","Jue","Vie","Sáb" ],
                            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo",
                                "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                                "Noviembre", "Diciembre" ],
                            firstDay: 1,
                            minDate: min-1,
                            dateFormat: "dd/mm/yy",
                        });
                    }
        });
        
             
        });
        </script>
        <script>
      //calendario "vw_detail.php"
            
            var elegido;
            
            $(function () {
                $.datepicker.setDefaults($.datepicker.regional["es"]);
                $("#datepicker").datepicker({
                    firstDay: 1,
                    onSelect: function (date) {
                        elegido=date;
                        $.post("https://holidayapartment.online/backoffice/reservar_dia_prueba",{date:elegido},function(respuesta){
                           alert(respuesta);
                        });
                    }
                });
            });
        </script>  
  
        
        <link rel="shortcut icon" href="favicon.ico"/> 
        <link href="<?php echo base_url('assets/backoffice'); ?>/css/estilos.css" rel="stylesheet" />
        <link href="<?php echo base_url('assets/webapp'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/webapp'); ?>/css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/webapp'); ?>/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">        
        <link href="<?php echo base_url('assets/webapp'); ?>/css/style.css" rel="stylesheet" type="text/css"/>     
     <!-- <title>Alquiler vacacional - Buscador de alojamientos para vacaciones<img alt="alquiler vacacional" src="<?php echo base_url('assets/webapp'); ?>/img/imatgeshome/alquiler-vacacional.jpg"></title>
        -->
        <title><?php echo $header_title ?></title>
        <meta name="description" content="<?php echo $header_description ?>">
        <meta name="keywords" content="<?php echo $header_keywords ?>">
        <?php if (!isset($header_author) || $header_author == '' || empty($header_author)) $header_author = 'HolidayApartment'; ?>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-77808760-1', 'auto');
            ga('send', 'pageview');

        </script>
        <!-- Inserta esta etiqueta en la sección "head" o justo antes de la etiqueta "body" de cierre. -->
        <script src="https://apis.google.com/js/platform.js" async defer>
            {
                lang: 'es'
            }
        </script>
        

        <meta name='B-verify' content='1ac89978aff8e924561c2d5c320199cd0a63ae79' />
        
        <style>
            
                .ui-state-highlight, .ui-widget-content .ui-state-highlight{
                    background-color: none;
                }
                .ui-datepicker .ui-state-active{
                    font-size: 20px;
                }
                
                
        </style>
        
    </head>