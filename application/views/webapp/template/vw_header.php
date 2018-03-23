<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">

        <?php echo $robots; ?>



        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no" />
        <meta name="msvalidate.01" content="70E018081123AB5CA55DB5E72F9FB841" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>../../../favicon/mifavicon.png">
        <!--calendario-->
        <link href="<?php echo base_url('assets/backoffice'); ?>/css/jquery-ui.css" rel="stylesheet"/>
        <script src="<?php echo base_url('assets/webapp'); ?>/js/jquery-2.1.4.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ofertas_styles'); ?>/css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ofertas_styles'); ?>/css/style.css"><link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/webapp'); ?>/css/style_acordion.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <script type="text/javascript">
            /* Calendario del fichero "vw_detail.php"*/
            var elegido;
            $(document).ready(function () {
            $.datepicker.setDefaults($.datepicker.regional["es"]);
            $('#txtFecha').datepicker({
            firstDay: 1,
                    minDate: '+0D',
                    maxDate: '+1Y',
                    changeMonth: false,
                    changeYear: false,
                    numberOfMonths: 2,
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
                            'Junio', 'Julio', 'Agosto', 'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr',
                            'May', 'Jun', 'Jul', 'Ago',
                            'Sep', 'Oct', 'Nov', 'Dic'],
                    onSelect: function (date) {
                    elegido = date;
                    /*$.post("https://holidayapartment.online/backoffice/reservar_dia_prueba",{date:elegido},function(respuesta){
                     alert(respuesta);
                     });*/
                    }
            });
            });
            //calendario
            /*
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
             });*/
        </script>


        <script type="text/javascript">
            /*Calendario de la página principal "vw_index.php"*/
            var fecha;
            var dia;
            var ndia;
            var mes;
            var nmes;
            var anyo;
            var select;
            $(document).ready(function () {/*calendario desde*/
            $("#data_entry").datepicker({
            dayNamesMin: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"],
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo",
                            "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                            "Noviembre", "Diciembre"],
                    minDate: 1,
                    firstDay: 1,
                    dateFormat: "dd-mm-yy",
                    onSelect: function (date) {/*calendario hasta*/
                    /*falta funcion ajax que refresque el div y actualizar la fecha en caso de
                     * rectificarla*/
                    fecha = date;
                    dia = fecha.substring(0, 2);
                    ndia = parseInt(dia);
                    mes = fecha.substring(3, 5);
                    nmes = parseInt(mes);
                    anyo = fecha.substring(6, 10);
                    nanyo = parseInt(anyo);
                    ndia++;
                    if (mes === "01" || mes === "03" || mes === "05" || mes === "07" || mes === "08" || mes === "10") {
                    if (dia >= 31) {
                    ndia = 1;
                    nmes++;
                    }
                    } else if (mes === "04" || mes === "06" || mes === "09" || mes === "11") {
                    if (dia >= 30) {
                    ndia = 1;
                    nmes++;
                    }
                    }
                    if (mes === "12") {
                    if (dia >= 31) {
                    ndia = 1;
                    nmes = 1;
                    nanyo++;
                    }
                    }
                    if (mes === "02") {
                    if (dia >= 28) {
                    ndia = 1;
                    nmes++;
                    }
                    }
                    select = ndia + "-" + nmes + "-" + nanyo;
                    $("#data_output").datepicker({
                    dayNamesMin: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"],
                            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo",
                                    "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                                    "Noviembre", "Diciembre"],
                            firstDay: 1,
                            minDate: select, /*$("#data_entry").datepicker( "getDate" ),*//*Aquí recojo la fecha de entrada*/
                            dateFormat: "dd-mm-yy",
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
        <!--mio----------------------------->
        <script>
            function noWeekendsOrHolidays(date) {
            var noWeekend = jQuery.datepicker.noWeekends(date);
            return noWeekend[0] ? nationalDays(date) : noWeekend;
            }
            $(function () {
            $("#desde").datepicker({
            onClose: function (selectedDate) {
            $("#hasta").datepicker("option", "minDate", selectedDate);
            }
            });
            $("#hasta").datepicker({
            onClose: function (selectedDate) {
            $("#desde").datepicker("option", "maxDate", selectedDate);
            }
            });
            });
            $(function () {

            $.ajax({
            type: "POST",
                    url: "Model_property_holiday.php",
                    data: dataString,
                    success: function (data) {
                    $('#').empty();
                    $('#result').html(data);
                    }
            });
            }

            });
            });
            $(function () {
            var events = ['15-1-2011', '16-1-2011', '17-1-2011', '18-1-2011'];
            $("#datepicker").datepicker({
            showWeek: true,
                    firstDay: 1,
                    beforeShowDay: function (date) {
                    var current = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                    return jQuery.inArray(current, events) == - 1
                            ? [true, '']
                            : [true, 'css-class-to-highlight', 'tool-tip-text'];
                    }
            });
//        $(".ui-datepicker-calendar td:contains(<?php echo site_url('Webapp/recoger_fechas_reserva()/'); ?> )").addClass('ui-state-hover');                
            $(".ui-datepicker-calendar td:contains('25')").addClass('ui-state-hover');
            });


        </script>


        <meta name='B-verify' content='1ac89978aff8e924561c2d5c320199cd0a63ae79' />

        <style>
            /* estilos datepicker*/
            .ui-state-highlight, .ui-widget-content .ui-state-highlight{

            }
            .ui-datepicker .ui-state-active{
                font-size: 20px;
                background-color: #4EBC30;
            }
            .ui-widget-content{
                border: 0;
            }
            .ui-widget-header{
                border: 0;
                background: none;
            }




        </style>

    </head>