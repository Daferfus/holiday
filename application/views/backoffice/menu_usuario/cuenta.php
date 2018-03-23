<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cuenta</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/backoffice/images/favicon/mifavicon.png" /> <!--FAVICON-->
    
    <style type="text/css">
       
        
            /* @media screen and (max-width: 1023px) {*/
            /*@media screen and (max-width: 600px) {*/
        
      @media only screen and (min-width : 723px) {
 
            body {background-color: #E0F2F7;}
            .media {
                /*box-shadow:0px 0px 4px -2px #000;*/
                margin: 20px 0;
                padding:30px;
            }
            .dp {
                border:10px solid #58AAB2;
                transition: all 0.2s ease-in-out;
            }
            .dp:hover {
                border:2px solid #4B9DD8;
                transform:rotate(360deg);
                -ms-transform:rotate(360deg);  
                -webkit-transform:rotate(360deg);  
                /*-webkit-font-smoothing:antialiased;*/
            }

            input.btn { margin-top: 1em; margin-bottom: 1em;}

            .pull-left {margin-bottom: -1em}

            /*.container {border: 2px solid blue;}*/

            .container{
                background-color: lightblue;
                width: 58%;
                border-radius: 99px;
                margin-top: 1em;
            }
          .style_logo {
               width: 400px;
              height:80px;";
          }
        }
    </style>
    
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container container-fluid">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object dp img-circle" src="<?php echo base_url(); ?>assets/backoffice/style_menu_usuario/img/img1.jpg" style="width: 100px;height:100px;">
            </a>
            
            <div class="media-body">
                <h4 class="media-heading">Juanjo Camps Ivars <small> Gandía</small></h4>
                <h5>Programador Informático en <a href="http://gridle.in">HolidayApartment.com</a></h5>
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
        <center><h1>Cambiar Contraseña.</h1></center>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
        <p class="text-center">
        Utilice el siguiente formulario para cambiar su contraseña. Tu contraseña no puede ser la misma que tu nombre de usuario.</p><br>
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
            <img src="<?php echo base_url(); ?>assets/backoffice/style_menu_usuario/img/alquiler-vacacional-barato.png" class="style_logo">
        </form>
        </div><!--/col-sm-6-->
    </div><!--/row-->
    </div></div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backoffice/style_menu_usuario/js/main.js"></script>
</body>
</html>
