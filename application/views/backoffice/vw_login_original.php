<!DOCTYPE html>
<html>    
    <head>        
        <meta charset="utf-8">        
        <meta name="apple-mobile-web-app-capable" content="yes" />        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">        
        <meta name="format-detection" content="telephone=no" />        
        <link rel="shortcut icon" href="favicon.ico"/>         
        <link href="<?php echo base_url('assets/webapp'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>        
        <link href="<?php echo base_url('assets/webapp'); ?>/css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>        
        <link href="<?php echo base_url('assets/webapp'); ?>/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">                
        <link href="<?php echo base_url('assets/webapp'); ?>/css/style.css" rel="stylesheet" type="text/css"/>                 
        <title>Let's Travel</title>    
    </head>    
    <script>
        function abreRegistro() {
            window.open(<?php echo site_url('backoffice/register_user') ?>);
        }
    </script>    
    <body data-color="theme-1">        <!-- LOADER -->        
        <div class="loading dr-blue-2">            
            <div class="loading-center">                
                <div class="loading-center-absolute">                    
                    <div class="object object_four"></div>                    
                    <div class="object object_three"></div>                    
                    <div class="object object_two"></div>                    
                    <div class="object object_one"></div>                
                </div>            </div>        </div>        
        <img class="center-image" src="img/special/bg-1.jpg" alt="">        
        <div class="container">            
            <div class="login-fullpage">                                                                                            
                <div class="row">                    
                    <div class="login-logo">
                        <img class="center-image" src="img/special/login.jpg" alt="">
                    </div>                    <div class="col-xs-12 col-sm-7">                        
                        <div class="f-login-content">                            
                            <div class="f-login-header">                                
                                <div class="f-login-title color-dr-blue-2">Bienvenido!</div>                                
                                <div class="f-login-desc color-grey">Por favor, ingrese a su cuenta</div>                            
                            </div>                            
                            <form action="<?php echo site_url('backoffice/validate_user') ?>" method="post" class="f-login-form">                                
                                <div class="input-style-1 b-50 type-2 color-5">                                    
                                    <input name="user" type="text" placeholder="Email" required>                                
                                </div>                                
                                <div class="input-style-1 b-50 type-2 color-5">                                    
                                    <input name="password" type="password" placeholder="Contraseña" required>                                
                                </div>                                
                                <input type="submit" class="login-btn c-button full b-60 bg-dr-blue-2 hv-dr-blue-2-o" value="INGRESE A SU CUENTA"><br><br>                                
                                <p style="color:blue;text-align: center;">Soy nuevo usuario <b><a onclick="window.open('<?php echo site_url('backoffice/register_user') ?>', toolbar = 0, status = 0, width = 618, height = 325)"> Registrarme</a></b></p>                            
                            </form>                                                    
                        </div>				                    
                    </div>                
                </div>            
            </div>            <!--	<div class="full-copy">© 2015 All rights reserved. l</div>-->        
        </div>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/jquery-2.1.4.min.js"></script>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/bootstrap.min.js"></script>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/jquery-ui.min.js"></script>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/idangerous.swiper.min.js"></script>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/jquery.viewportchecker.min.js"></script>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/isotope.pkgd.min.js"></script>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/jquery.mousewheel.min.js"></script>        
        <script src="<?php echo base_url('assets/webapp'); ?>/js/all.js"></script>    
    </body>
</html>	