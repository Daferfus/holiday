<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">

        <?php echo $robots; ?>
        
            
        

        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no" />
        <meta name="msvalidate.01" content="70E018081123AB5CA55DB5E72F9FB841" />

        <link rel="shortcut icon" href="favicon.ico"/> 
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
       

    </head>


