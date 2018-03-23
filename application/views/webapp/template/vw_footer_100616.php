<div class="item flights gal-item col-mob-12 col-xs-12 col-sm-12 reds-socials">

    <h4 align="center"> Siguenos en facebook, entrarás en nuestros sorteos y conseguiras alojamiento gratis. </h4>
    <br>
    <div align="center">
        <table id="tabla-reds">
            <tr>
                <td>
                    <a href="https://www.instagram.com/holidayapartment.online/" target="_blank"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-instagram.JPG" alt="" width="50px" height="52px" class="instagram"> </a>

                </td>


                <td>
                    <a href="https://www.facebook.com/holidayapartme" target="_blank"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-facebook.png" alt="" width="50px" height="50px" class="facebook"> </a>

                </td>
                <td>
                    <a href="https://twitter.com/holidayapartme" target="_blank"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-twitter.png" alt="" width="50px" height="50px" class="twitter"> </a>

                </td>
                <td>
                    <a href="https://plus.google.com/+holidayapartmentonline" target="_blank"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-google+.png" alt="" width="50px" height="50px" class="googleplus"> </a>

                </td>
                <td>
                    <a href="https://es.pinterest.com/holidayapar/"target="_blank"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-pinterest.png" alt="" width="50px" height="50px" class="pinterest"> </a>

                </td>
                <td>
                    <a href="https://www.youtube.com/c/holidayapartmentonline"target="_blank"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-youtube.png" alt="" width="50px" height="50px" class="youtube"></a> 

                </td>
            </tr>
        </table>
<!--        <p>
        <a href="https://www.instagram.com/holidayapartment.online/"/> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-instagram.JPG" alt="" width="50px" height="52px" class="instagram"> </a>
        <a href="https://www.facebook.com/holidayapartme"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-facebook.png" alt="" width="50px" height="50px" class="facebook"> </a>
        <a href="https://twitter.com/holidayapartme"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-twitter.png" alt="" width="50px" height="50px" class="twitter"> </a>
        <a href="https://plus.google.com/+Holidayapartmentonline"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-google+.png" alt="" width="50px" height="50px" class="googleplus"> </a>
        <a href="https://es.pinterest.com/holidayapar/"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-pinterest.png" alt="" width="50px" height="50px" class="pinterest"> </a>
        <a href="https://www.youtube.com/c/Holidayapartmentonline"> <img src="<?php echo base_url('assets/webapp'); ?>/img/reds-socials/logo-youtube.png" alt="" width="50px" height="50px" class="youtube"></a> 
        </p>-->
        <br>

    </div>

</div>

<div >

    <?php
    if (count($posts) > 0)
        foreach ($posts as $post) {
            ?>


            <div class="item flights gal-item col-mob-12 col-xs-12 col-sm-12">

                <h1 align="center" class="color-naranja"> <?php
                    echo "<br>";

                    echo $post->post_title
                    ?> </h1><br><br>

                <p>
                    <?php
                    echo "<br>";
                    echo $post->post_body;
                    ?>

                </p>

            </div>
    <?php } ?>


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
                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/francia.png" width="18px"/> Français</a></li>
                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/italia.png" width="18px"/> Italiano</a></li>
                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/alemania.png" width="18px"/> Deutsch</a></li>
                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/rusia.png" width="18px"/> русский</a></li>
                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/japon.png" width="18px"/> 日本の</a></li>
                            <li> <a href="#"><img src="<?php echo base_url('assets/webapp'); ?>/img/banderes_paisos/china.png" width="18px"/> 奇諾</a></li>

                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-sm-6 no-padding">
                <div class="footer-block">
                    <div class="f_news clearfix">
                        <h4> <a href="<?php echo site_url('es/alquiler-vacacional') ?>" class="enlaces-naranja">Quienes somos</a> </h4>
                        <h4> <a href="#" class="enlaces-naranja">Blog</a> </h4>
                        <h4> <a href="<?php echo site_url('es/aviso-legal') ?>" class="enlaces-naranja">Politicas</a> </h4>
                   <!--     <h4> <a href="<?php echo site_url('register_property') ?>" class="enlaces-naranja">Registra tu propiedad</a> </h4> -->
                        <h4> <a href="mailto:info@holidayapartment.online" class="enlaces-naranja">Contactanos</a> </h4>
                    </div>


                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="footer-block">
                <!--  <h4> <a href="#" class="enlaces-naranja"><img src="<?php echo base_url('assets/webapp'); ?>/img/smartphone.png" width="19px"/> App para movil</a> </h4>  -->
                    <h4> <a href=http://www.booking.com/resorts/index.html?aid=1143346" rel="nofollow" target="_blank" class="enlaces-naranja"> <img src="<?php echo base_url('assets/webapp'); ?>/img/hotel-letter-h-sign-inside-a-black-rounded-square.png" width="19px"/> Alojamiento en hoteles</a> </h4>
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



<script src="<?php echo base_url('assets/webapp'); ?>/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url('assets/webapp'); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/webapp'); ?>/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url('assets/webapp'); ?>/js/idangerous.swiper.min.js"></script>
<script src="<?php echo base_url('assets/webapp'); ?>/js/jquery.viewportchecker.min.js"></script>
<script src="<?php echo base_url('assets/webapp'); ?>/js/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url('assets/webapp'); ?>/js/jquery.mousewheel.min.js"></script>
<script src="<?php echo base_url('assets/webapp'); ?>/js/all.js"></script>
<script>
// Traducción al español
$(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});
	$("#data_output").datepicker().datepicker("setDate", new Date()+ getDate()+2);

</script>
</body>
</html>	