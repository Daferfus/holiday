<!DOCTYPE html>
<html>
    <head>
        <link href="<?php echo base_url('assets/webapp'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>    
        <title>Nuevo registro</title>
        <style>
            
            #contenedor{
                /*border:1px solid #000000;*/
                width:100%;
            }
            #izquierda{
                /*border:1px solid #000000;*/
                float: left;
                color: blue;
                width: 67%;
                text-align: center;
                padding: 2px;
            }
            #derecha{
                float: left;
                width: 29%;
                padding: 2px;
            }
            #responsive-image{  
                width: 100%;  
                height: auto; 
            }

            #botones-para-compartir{
                text-align:left;
            }
            .likedino:hover, .facebooko:hover, .twittero:hover, .googleo:hover,.instagram:hover, .pinterest:hover, .youtube:hover {-webkit-transform: rotate(360deg);-moz-transform: rotate(360deg);transform: rotate(360deg);transition:all .3s ease-out;-moz-transition: all .5s;-webkit-transition: all .5s;-o-transition: all .5s;}.likedino, .pinterest, .youtube, .facebooko, .twittero, .googleo, .instagram {transition:all .3s ease-out;-moz-transition: all .5s;-webkit-transition: all .5s;-o-transition: all .5s;margin-left:10px; /* espacio entre cada boton */}



            .ig-b- { display: inline-block; }
            .ig-b- img { visibility: hidden; }
            .ig-b-:hover { background-position: 0 -60px; } 
            .ig-b-:active { background-position: 0 -120px; }
            .ig-b-32 { width: 32px; height: 32px; background: url(//badges.instagram.com/static/images/ig-badge-sprite-32.png) no-repeat 0 0; }
            @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
                .ig-b-32 { background-image: url(//badges.instagram.com/static/images/ig-badge-sprite-32@2x.png); background-size: 60px 178px; } }

        </style>
        <script>
        function compruebaClave(){
                var formObj= document.getElementById("MiForm");
                var clave1=document.getElementById("pass").value;
                var clave2=document.getElementById("pass2").value;
                    if(clave1===""||clave2===""){
                        alert("introduzca la contraseña");
                    }
                    else if (clave1 !== clave2){
                       alert("Las contraseñas no coinciden");
                           document.MiForm.nombre.value="";
                       
                    }
                    if(clave1!==""){
                        if(clave1===clave2){
                            formObj.submit();
                        }
                    }
        }
        </script>
    </head>
    <body>
        <div id="contenedor">
            <div id="izquierda">
                <img src="https://holidayapartment.online/assets/webapp/img/imatgeshome/alquiler-vacacional-mallorca.jpg" id="responsive-image">
            </div>
            <div id="derecha">
                <small>¿Necesita ayuda? <a href="mailto:info@holidayapartment.online">Envienos un email</a> o llámenos 900 838 426<br><hr></small>
                <h2 style="text-align:center;"><font color="blue">Crear su anuncio ahora</font></h2><br>
                <form id="MiForm" action="<?php echo site_url('backoffice/insertar_user') ?>" method="post" style="width:100%">
                    <input style="width:100%" type="text" id="nombre" name="nombre" placeholder="Nombre*" required ><br>
                    <input style="width:100%" type="text" id="apellido" name="apellido" placeholder="Apellido*" required><br>
                    <input style="width:100%" type="email" id="email" name="email" placeholder="Correo electrónico*" required><br>
                    <input style="width:100%" type="password" id="pass" name="pass" minlength="6" placeholder="Contraseña*" required><br>
                    <input style="width:100%" type="password" id="pass2" name="pass2" minlength="6" placeholder="Repita la contraseña*" required><br>
                      <select name="region" style="width: 104%" >
                        <option value="spain">España</option>
                      </select><br>
                    <input style="width:100%" type="text" id="telefono" name="telefono" placeholder="Teléfono*" required><br><br>
                    <font size="1">*Campos obligatorios<br><br>
                    Pulsando en continuar, acepta los<a href="https://holidayapartment.online/aviso-legal"> Términos y condiciones y la Política de Protección de Datos</a> de HomeAway.es.<br> 
                    Le enviaremos ofertas especiales y novedades sobre HomeAway. Puede darse de baja en cualquier momento.</font>
                    <input type="submit" value="Continuar" style="width:100%; height: 55px; background: orange" onclick="compruebaClave()">
                </form>                
            </div>
        </div>
    
    <div class="container" >
        <div class="item flights gal-item col-mob-12 col-xs-12 col-sm-12 reds-socials">

            <h4 align="center"> Siguenos en facebook, entrarás en nuestros sorteos y conseguiras alojamiento gratis. </h4>
            <br>
            <div align="center" class="container">
                <table>
                        <tr>
                                <td>
                                        <a href="javascript:void(0);" onclick="window.open(&quot;https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fholidayapartment.online%2F&amp;src=sdkpreparse&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Facebook"><img alt="compartir en facebook" class="facebooko" height="40" src="http://1.bp.blogspot.com/-rwK-4X3iLjc/ViFsOclr9NI/AAAAAAAABwc/ocBw9cxRK2M/s1600/facebook-long.png" title="compartir en facebook" width="40" /></a>

                                        <a href="javascript:void(0);" onclick="window.open(&quot;https://plus.google.com/share?url=https://holidayapartment.online/blog&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Google+"><img alt="compartir en google+" class="googleo" height="40" src="http://1.bp.blogspot.com/-SKqPlZHzLgg/ViFsOt7HbeI/AAAAAAAABw0/bQQhWqgEpWM/s1600/google-long.png" title="compartir en google+" width="40" /></a>

                                        <a href="javascript:void(0);" onclick="window.open(&quot;https://www.instagram.com/holidayapartment.online/?ref=badge&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Instagram"><img alt="Perfil Instagram" class="instagram" height="40" src="http://s2.subirimagenes.com/otros/previo/thump_96731511484650504874585.jpg" title="Instagram" width="40" /></a>

                                        <a href="javascript:void(0);" onclick="window.open(&quot;https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fholidayapartment.online%2Fblog&ref_src=twsrc%5Etfw&text=Alquiler%20vacacional%20-%20Buscador%20de%20alojamientos%20para%20vacaciones&tw_p=tweetbutton&url=https%3A%2F%2Fholidayapartment.online%2Fblog&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Google+"><img alt="compartir en twitter" class="twittero" height="40" src="http://4.bp.blogspot.com/-gqVyoE8cVME/ViFsO009lbI/AAAAAAAABwo/1oK8cUnY36Q/s1600/twitter-long.png" title="compartir en twitter" width="40" /></a>
                                        
                                        <a href="javascript:void(0);" onclick="window.open(&quot;https://es.pinterest.com/holidayapar);" rel="nofollow" title="Compartir en Pinterest"><img alt="compartir en pinterest" class="pinterest" height="40" src="https://holidayapartment.online/assets/webapp/img/reds-socials/logo-pinterest.png" title="compartir en pinterest" width="40" /></a>
                                        
                                        <a href="javascript:void(0);" onclick="window.open(&quot;https://www.youtube.com/c/holidayapartmentonline);" rel="nofollow" title="Youtube"><img alt="compartir en youtube" class="youtube" height="40" src="https://holidayapartment.online/assets/webapp/img/reds-socials/logo-youtube.png" title="ver en youtube" width="40" /></a>
                                </td>
                        </tr>
                </table>
                <br>

            </div>

        </div>

                <footer class="bg-dark type-2">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class=" menu footer-block">


                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/espana.png" width="18px"/> Idiomas</button>

                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Desplegar menú</span>
                                        </button>

                                        <ul class="dropdown-menu" role="menu">
                                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/espana.png" width="18px"/> Español</a></li>
                                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/inglesa.png" width="18px"/> English</a></li>
   
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-sm-6 no-padding">
                                <div class="footer-block">
                                    <div class="f_news clearfix">
                                        <h4> <a href="<?php echo site_url('alquiler-vacacional') ?>" class="enlaces-naranja">Quienes somos</a> </h4>
                                        <h4> <a href="<?php echo site_url('blog') ?>" class="enlaces-naranja">Blog</a> </h4>
                                        <h4> <a href="<?php echo site_url('aviso-legal') ?>" class="enlaces-naranja">Politicas</a> </h4>
                                   <!--     <h4> <a href="<?php echo site_url('register_property') ?>" class="enlaces-naranja">Registra tu propiedad</a> </h4> -->
                                        <h4> <a href="mailto:info@holidayapartment.online" class="enlaces-naranja">Contactanos</a> </h4>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="footer-block">
                                <!--  <h4> <a href="#" class="enlaces-naranja"><img src="<?php echo base_url('assets/webapp'); ?>/img/smartphone.png" width="19px"/> App para movil</a> </h4>  -->
                                    <h4> <a href="https://www.hoteltravel.com/agents/passthrough.asp?affil_id=312286&co=ES&c=M&lng=es" rel="nofollow" target="_blank" class="enlaces-naranja"> <img src="<?php echo base_url('assets/webapp'); ?>/img/hotel-letter-h-sign-inside-a-black-rounded-square.png" width="19px"/> Alojamiento en hoteles</a> </h4>
                                    <h4> <a href="http://www.tripsta.es/?utm_source=zanox_es&utm_medium=affiliate&utm_content=banner_250x250&utm_campaign=flights&partnerCode=4256cc&userID=2244304&zanpid=2170999692379747328" rel="nofollow" class="enlaces-naranja"><img src="<?php echo base_url('assets/webapp'); ?>/img/airplane-flight.png" width="19px"/> Precios vuelos avión</a> </h4>
                                    <h4> <a href="https://www.happycar.es/?utm_source=zanox&utm_medium=affiliate&utm_campaign=ZX_2244304_https://holidayapartment.online&zanpid=2172318365325362176&version=vertical" rel="nofollow" class="enlaces-naranja"><img src="<?php echo base_url('assets/webapp'); ?>/img/volkswagen-car-side-view.png" width="19px"/> Alquiler vehiculos</a> </h4>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="footer-block">

                                    <div class="contact-info">
                                        <!--                        <h6>Información de contacto.</h6>-->
                                        <p style="font-size:15px"><img src="<?php echo base_url('assets/webapp'); ?>/img/location-pin.png" width="19px"/>  46701, España</p>
                                        <p style="font-size:15px"><img src="<?php echo base_url('assets/webapp'); ?>/img/close-envelope.png" width="19px"/>  info@holidayapartment.online</p>					
                                        <p style="font-size:15px"><img src="<?php echo base_url('assets/webapp'); ?>/img/domain.png" width="19px"/>holidayapartment.online</p>				

                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="footer-link bg-black">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="copyright">
                                        <span>&copy; 2016 Todos los derechos reservados. <a href="https://holidayapartment.online/">holidayapartment.online</a></span>
                                    </div>
                                    <!--                    <ul>
                                                            <li><a class="link-aqua" href="#">Politica de Privacidad </a></li>
                                                            <li><a class="link-aqua" href="#">Acerca de</a></li>
                                                            <li><a class="link-aqua" href="#">FAQ</a></li>
                                                            <li><a class="link-aqua" href="#">Blog</a></li>
                                                            <li><a class="link-aqua" href="#"> Forum</a></li>
                                                        </ul>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>

 
    </div>

</body>
</html>	
</html>