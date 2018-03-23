<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>¡Registrate gratis!</title>
  <link href='<?php echo base_url(); ?>/assest/login/css/font.css' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assest/login/css/normalize.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/login'); ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/login'); ?>/css/olvido_pass.css">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>../../favicon/mifavicon.png">
  <script src='https://www.google.com/recaptcha/api.js'></script>

<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen">-->

<style type="text/css">
    
    
.button_2 {
  border: 0;
  outline: none;
  border-radius: 0;
  padding: 15px 0;
  font-size: 1rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .1em;
  background: #4B9DD8;
  color: #ffffff;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  -webkit-appearance: none;
}
.button_2:hover, .button_2:focus {
  /*background: #179b77;*/
  background: #0E7CCE;
}

.button-block_2 {
    display: block;
    margin: 0 auto;
    width: 25em;
    height: 2em;
    text-align: center;
}

button p {
    margin-top: -4px;
}


.fadebox {/* oscuridad de la ventana */
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: black;
    z-index:1001;
    opacity: 0.7;
    filter: alpha(opacity=80);
}
.overbox { 
    display: none;
    position: absolute;
    top: 38%;
    left: 31%;
    width: 38%;
    height: 50%;
    z-index:1002;
    overflow: auto; /*al minimizar se pondran barras de desplazamiento*/
}
#content {
    background: rgba(20, 45, 67, 2.8);;
    border: solid 3px rgba(20, 45, 67, 0.8);
    padding: 10px;
    color: white;
    text-align: center;
}

.logo_login {
    margin-top: -2em;
    width: 20em;
    margin-left: 5em;
}

@media screen and (max-device-width : 480px) {

    .logo_login {
        display: none;
    }

    .overbox {
        overflow: hidden;
        display: none;
        position: absolute;
        top: 38%;
        left: 1%;
        width: 98%;
        height: 80%;
        z-index:1002;
    }
    div#content #email{
        width: auto;
    }
    
    .button_2 {
        width: 18em;
    }
}
</style>
    
<script type="text/javascript">
    function showLightbox() {
        document.getElementById('over').style.display='block';
        document.getElementById('fade').style.display='block';
    }
    function hideLightbox() {
        document.getElementById('over').style.display='none';
        document.getElementById('fade').style.display='none';
    }
</script>    
    
</head>
<script>
        function abreRegistro() {
            window.open(<?php echo site_url('backoffice/register_user') ?>);
        }
    </script> 
<body>
  <div class="form">
<img src="<?php echo base_url(); ?>../../../assets/login/img/logo.png" class="logo_login">
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Regístrate</a></li>
        <li class="tab"><a href="#login">Iniciar sesión</a></li>
      </ul>
      
      <div class="tab-content" >
        <div id="signup">   
          <h1>¡Regístrate Gratis!</h1>

          <form action="<?php echo site_url('backoffice/register_pay') ?>" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Nombre<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Apellidos<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Correo electronico<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Contraseña<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Telefono<span class="req">*</span>
            </label>
            <input type="tel"required autocomplete="off"/>
          </div>
          
          <!-- CAPTCHA -->
         <div class="field-wrap">
             <div class="g-recaptcha" data-sitekey="6Ldm7iEUAAAAALXluAFQ8K1Z-CUKmZX5JDk4W_wr"></div>
              </div>
        <!-- CAPTCHA -->
         
          <button type="submit" class="button button-block"/>Registrar</button>
          </form>
        </div>
        <div id="login">   
          <h1>¡Bienvenido a HolidayApartment!</h1>
          
          <form action="<?php echo site_url('backoffice/validate_user') ?>" method="post">
            <div class="field-wrap">
            <input type="email"required autocomplete="off" name="user"/>
          </div>
          <div class="field-wrap">
            <input type="password"required autocomplete="off" name="password"/>
          </div>            
        <div class="field-wrap">
              <!--Ventana emergente-->
            <p class="forgot">      
            <p><a href="javascript:showLightbox();">¿Se te ha olvidado la contraseña?</a></p>
            </p>
            <button class="button button-block">Entrar</button>
            </a>
          </form>
          <form action="<?php //echo site_url('backoffice/login') ?>" method="post" >
        </div>
        </div>
        </div>
        <div id="over" class="overbox">
        <div id="content">
               <a href="javascript:hideLightbox();" class="cerrar">x</a>
                <img src="<?php echo base_url(); ?>../../../assets/login/img/logo.png">
                <h3>Restaurar contraseña</h3>
                Escribe el email asociado a tu cuenta para recuperar tu contraseña
                <br><br><br>

                <input type="email" id="email" class="form-control" name="email" required placeholder="e-mail">
                <br>
                <button class="button_2 button-block_2"><p>Enviar</p></button>
        </div>
        </div>
        </form>
<div id="fade" class="fadebox">&nbsp;</div>

</div> 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> <!--SI QUITAS ESTA LINEA NO FUNCIONA EL LOGIN-->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
  
    <script src='<?php echo base_url('assets/login'); ?>/jquery/jquery.min.js'></script>
    <script src="<?php echo base_url('assets/login'); ?>/js/index.js"></script><!--SI QUITAS ESTA LINEA NO FUNCIONA EL LOGIN-->
    <script src="<?php echo base_url('assets/login'); ?>/scss/style.scss"></script>
</body>
</html>
