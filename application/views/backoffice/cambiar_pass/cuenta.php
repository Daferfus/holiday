<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cuenta</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/cambiar_pass_estilos/css/cambio_pass.css"><!--jmk-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/css/style.css">
    
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/backoffice/img/favicon.png"><!--jmk-->
<!--    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>-->
<!--    <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery-1.8.3.min.js"></script>-->
</head>
<body>

<div class="container container-fluid">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object dp img-circle" src="<?php echo base_url(); ?>assets/cambiar_pass_estilos/img/img1.jpg">
            </a>
            
            <div class="media-body">
                <h4 class="media-heading">Jacobo Monrabal Koninckx <small> Gandía</small></h4>
                <h5>Programador Informático en <a href="https://holidayapartment.online">HolidayApartment.com</a></h5>
                <hr style="margin:8px auto">

                <span class="label label-default">JavaEE</span>
                <span class="label label-default">.Net</span>
                <span class="label label-info">PHP</span>
                <span class="label label-default">JavaScript</span>
            </div>
        </div>

    </div>
</div>
<div class="Panel with panel-info class">
    <div class="row">
        <div class="col-sm-12">
        <center><h2>Cambiar Contraseña.</h2></center>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
        <p class="text-center">
        Utilice el siguiente formulario para cambiar su contraseña.</p><br>
        <form method="post" id="passwordForm">
            <input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="New Password" autocomplete="off">
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 Carácteres mínimo<br>
                    <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 
                    Una letra mayúscula
                </div>
                <div class="col-sm-6">
                    <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 
                    Una letra minúscula<br>
                    <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Un número
                </div>
            </div>
            <br>
            <input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repeat Password" autocomplete="off">
            <div class="row">
                <br>
                <div class="col-sm-12">
                    <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 
                    Las contraseñas coinciden
                </div>
            </div>
            <br>
            <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Cambiar Contraseña">
            <br>
            <img src="<?php echo base_url(); ?>assets/cambiar_pass_estilos/img/alquiler-vacacional-barato.png" class="logo_size">
        </form>
        </div><!--/col-sm-6-->
    </div><!--/row-->
    </div></div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/cambiar_pass_estilos/js/main.js"></script>
</body>
</html>
