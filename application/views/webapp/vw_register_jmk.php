<!-- <img class="center-image" src="<?php echo base_url('assets/webapp'); ?>/img/special/bg-1.jpg" alt="">
-->
<div class="container">
    <div class="login-fullpage">                                                                            
        <div class="row">
     <!--       <div class="login-logo"><img class="center-image" src="<?php echo base_url('assets/webapp'); ?>/img/special/login.jpg" alt=""></div>
         -->
               <div class="col-xs-12 col-sm-7">
                <div class="f-login-content">
                    <div class="f-login-header">
                        <div class="f-login-title color-dr-blue-2"><h1>Únase a Holidayapartment!</h1></div>
                        <div class="f-login-desc color-grey">Crear cuenta</div>
                        <div class="f-login-desc color-red">
                            <?php
                            if (isset($error_mail)) {
                                echo $error_mail;
                            }
                            ?>

                        </div>
                    </div>
                    <form class="f-login-form" action="<?php echo site_url('register_save'); ?>" method="post">     
                        <div class="input-style-1 b-50 type-2 color-5">
                            <input type="text" placeholder="Tu nombre" required name="name">
                        </div>
                        <div class="input-style-1 b-50 type-2 color-5">
                            <input type="text" placeholder="Ciudad de la reserva" required name="ciudad">
                        </div>

                        <div class="input-style-1 b-50 type-2 color-5">
                            <input type="text" placeholder="Dirección de la reserva" required name="direccion">
                        </div>
                        <div class="input-style-1 b-50 type-2 color-5">
                            <input class="datepicker" type="text" placeholder="Fecha Entrada de la reserva" required name="fecha_entrada">
                        </div>
                        <div class="input-style-1 b-50 type-2 color-5">
                            <input class="datepicker" type="text" placeholder="Fecha Salida de la reserva" required name="fecha_salida">
                        </div>


                        <div class="input-style-1 b-50 type-2 color-5">
                            <input type="email" placeholder="E-mail contacto" required name="email1"> 
                        </div>
                        <div class="input-style-1 b-50 type-2 color-5">
                            <input type="email" placeholder="Confirma tu e-mail" required name="email2"> 


                            <p style="color: red"> 
                                <?php
                                if (isset($error_mail)) {
                                    echo $error_mail;
                                }
                                ?>
                            </p>



                        </div>
                        <div class = "input-style-1 b-50 type-2 color-5">
                            <input type = "tel" placeholder = "Teléfono de contacto" required name = "phone">
                        </div>
                        <div class = "input-style-1 b-50 type-2 color-5">
                            <input type = "password" placeholder = "Elige tu contraseña" required name = "password1">
                        </div>
                        <div class = "input-style-1 b-50 type-2 color-5">
                            <input type = "password" placeholder = "Repite tu contraseña" required name = "password2">
                        </div>
                        <p style="color: red"> 
                            <?php
                            if (isset($error_password)) {
                                echo $error_password;
                            }
                            ?>
                        </p>


                        <div class = "checkbox-group">
                            <div class = "input-entry color-3">
                                <input class = "checkbox-form" id = "text-1" type = "checkbox" name = "checkbox" value = "climat control">
                                <label class = "clearfix" for = "text-1">
                                    <span class = "sp-check"><i class = "fa fa-check"></i></span>
                                    <span class = "checkbox-text">Acepto las condiciones de uso y la política de privacidad</span>
                                </label>
                            </div>
                            <div class = "input-entry color-3">
                                <input class = "checkbox-form" id = "text-2" type = "checkbox" name = "checkbox" value = "climat control">
                                <label class = "clearfix" for = "text-2">
                                    <span class = "sp-check"><i class = "fa fa-check"></i></span>
                                    <span class = "checkbox-text">Recuerdame</span>
                                </label>
                            </div>
                        </div>
                        <input type = "submit" class = "login-btn c-button full b-60 bg-dr-blue-2 hv-dr-blue-2-o" value = "Registrarse">

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--<div class = "full-copy">© 2015 All rights reserved. l</div> -->
</div>                                                                                                                                                                                          

