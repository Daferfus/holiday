<div class="content">
      <div class="container wow fadeInUp delay-03s">
        <div class="row">
          <br><br><br>
          <div class="container">
          
              <form class="form-horizontal" action="<?php echo site_url('register_save'); ?>" method="post">
               <h2>Holiday&nbsp;<img src="<?php echo base_url('assets/ofertas_styles'); ?>/img/mifavicon.png">&nbsp;Apartment</h2><br>
                <div class="form-group">
                  <label class="control-label col-sm-5">Nombre:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Tu nombre" required name="name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="pwd">Ciudad de la reserva:</label>
                  <div class="col-sm-6">          
                    <input type="text" class="form-control" placeholder="Ciudad a reservar" name="ciudad" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="pwd">Dirección de la reserva:</label>
                  <div class="col-sm-6">          
                    <input type="text" class="form-control" placeholder="Direccion de tu reserva" name="direccion" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="pwd">Entrada de la reserva:</label>
                  <div class="col-sm-6">          
                    <input type="date" id="f1" placeholder="Fecha entrada de la reserva" name="fecha_entrada">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="pwd">Salida de la reserva:</label>
                  <div class="col-sm-6">          
                    <input type="date" id="f2" placeholder="Fecha salida de la reserva" name="fecha_salida"> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="email">E-mail contacto:</label>
                  <div class="col-sm-6">
                    <input type="email" class="form-control"  placeholder="E-mail personal" name="email1" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="email">Confirma tu e-mail:</label>
                  <div class="col-sm-6">
                    <input type="email" class="form-control"  placeholder="E-mail personal" name="email2" required>
                    
                    <p style="color: red">
                        <?php
                            if (isset($error_mail)) {
                                echo $error_mail;
                            }
                        ?>
                    </p>
                            
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="email">Teléfono de contacto:</label>
                  <div class="col-sm-6">
                    <input type="tel" class="form-control" placeholder="Teléfono personal" name="phone" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="pwd">Elige tu contraseña:</label>
                  <div class="col-sm-6">          
                    <input type="password" class="form-control" placeholder="Ingrese su contraseña" name="password1" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-5" for="pwd">Repite tu contraseña:</label>
                  <div class="col-sm-6">          
                    <input type="password" class="form-control" placeholder="Repita su contraseña" name="password2" required>
                  </div>
                  <p style="color: red"> 
                      <?php
                            if (isset($error_password)) {
                                echo $error_password;
                            }
                       ?>
                        </p>
                </div>
                <div class = "checkbox-group posicion">
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
                <!--<div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label><input type="checkbox" name="remember"> Recuérdame</label>
                    </div>
                  </div>
                </div>-->
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Enviar</button>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>
    