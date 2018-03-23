
<div class="loading red">
    <div class="loading-center">
        <div class="loading-center-absolute">
            <div class="object object_four"></div>
            <div class="object object_three"></div>
            <div class="object object_two"></div>
            <div class="object object_one"></div>
        </div>
    </div>
</div>

<!-- INNER-BANNER -->
<div class="inner-banner style-6">
    <img class="center-image" src="img/detail/bg_2.jpg" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <ul class="banner-breadcrumb color-white clearfix">
                        <li><a class="link-blue-2" href="#">home</a> /</li>
                        <li><a class="link-blue-2" href="#">tours</a> /</li>
                        <li><span>detail</span></li>
                    </ul>
                    <h2 class="color-white">sea tours in france</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DETAIL WRAPPER -->
<div class="detail-wrapper">
    <div class="container">
        <div class="detail-header">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <?php
                    foreach ($location as $loc)
                        
                        ?>


                    <div class="detail-category color-grey-3"><?php echo " $loc->location_address , $loc->location_city , $loc->location_district "; ?> .</div>
                    <?php
                    foreach ($text as $description)
                        
                        ?>
                    <h2 class="detail-title color-dark-2"><?php echo $description->text_title ?></h2>
                    <div class="detail-rate rate-wrap clearfix">
                        <div class="rate">
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                        </div>
                        <i>485 Rewies</i> 
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="detail-price color-dark-2">precio desde <span class="color-dr-blue"> $200</span> /person</div>
                </div>
            </div>
       	</div>
       	<div class="row padd-90">
            <div class="col-xs-12 col-md-8">
                <div class="detail-content color-1">
                    <div class="detail-top slider-wth-thumbs style-2">
                        <div class="swiper-container thumbnails-preview" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                            <div class="swiper-wrapper">
                                <?php
                                //print_r($images);
                                foreach ($images as $image) {
                                    $val = 0;
                                    $url_base = base_url() . "assets/uploads/images/";
                                    $picture_url = $url_base . $image->picture_property_id . '/' . $image->picture_url;
                                    ?>
                                    <div class="swiper-slide active" data-val="<?php echo $val ?>">
                                        <img class="img-responsive img-full" src="<?php echo $picture_url ?>" alt="">
                                    </div>
                                    <?php
                                    $val++;
                                }
                                ?>




                            </div>
                            <div class="pagination pagination-hidden"></div>
                        </div>
                        <div class="swiper-container thumbnails" data-autoplay="0" 
                             data-loop="0" data-speed="500" data-center="0" 
                             data-slides-per-view="responsive" data-xs-slides="3" 
                             data-sm-slides="5" data-md-slides="5" data-lg-slides="5" 
                             data-add-slides="5">
                            <div class="swiper-wrapper">


                                <?php
                                foreach ($images as $image) {
                                    $val = 0;
                                    $url_base = base_url() . "assets/uploads/images/";
                                    $picture_url = $url_base . $image->picture_property_id . '/' . $image->picture_url;
                                    ?>
                                    <div class="swiper-slide current active" data-val="<?php echo $val ?>">
                                        <img class="img-responsive img-full" src="<?php echo $picture_url ?>" alt="">
                                    </div>

                                    <?php
                                    $val++;
                                }
                                ?>

                            </div>
                            <div class="pagination hidden"></div>
                        </div>
                    </div>

                    <div class="detail-content-block">


                        <h3>Información General</h3>
                        <?php foreach ($text as $description)
                            
                            ?>

                        <p><?php echo $description->text_description ?></p>
                        <!-- <h5>interesting for you</h5>
 
                         <div class="embed-responsive embed-responsive-16by9">
                             <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/64473966?color=dedede&amp;title=0&amp;byline=0&amp;portrait=0" ></iframe>
                         </div>-->
                    </div>

                    <div class="detail-content-block">
                        <?php
                        $latitude = $loc->location_latitude;
                        $longitude = $loc->location_longitude;
                        $city_name = $loc->location_city;
                        $country_name = $loc->location_country;
                        $address = $loc->location_address;
                        $zip_name = $loc->location_zip;

                        if ($loc->location_longitude != 0 && $loc->location_latitude != 0) {


                            $position_map = "https://maps.google.com/maps?q=" . $latitude . ", " . $longitude . "&z=17&output=embed";
                        } else
                            $position_map = "https://maps.google.com/?q=" . $city_name . ", " . $country_name . ", " . $address . ", " . $zip_name . ";t=m&amp;output=embed";
                        /* echo '<iframe id="map" src="<?php echo $position_map ?>" style="border:1px solid #dedbd2; padding:-5px;" width="100%" frameborder="0" height="350"></iframe>';
                         */
                        $html = '<iframe id="map" src="' . $position_map . '" style="border:1px solid #dedbd2; padding:-5px;" width="100%" frameborder="0" height="350"></iframe>';
                        echo $html;
                        ?>
                    </div>
                    <div class="detail-content-block">

                        <h3>Precios por temporada</h3>
                        <table border="1"  >
                            <tr>
                                <th>Temporada</th>
                                <th>Fecha Desde</th>
                                <th>Fecha Hasta</th>
                                <th>Precio</th>
                            </tr>

                            <?php
                            foreach ($seasons as $season) {
                                echo "<tr><td align='left'>" . $season->season_name . "</td><td>" . $season->season_from . "</td><td align='right'>" . $season->season_price . " €</td></tr>";
                            }
                            ?>
                        </table>

                    </div>

                    <!--<div class="detail-content-block">-->
                    <div style="width: auto; height:350px;">

                        <h3>Calendario de disponibilidad y precios</h3>

                        <div id="txtFecha"></div><br>
                        <div style="float: right;">
                            <table>
                                <tr>
                                    <td>Disponible</td>
                                    <td width="20px" id="disponible" height="12px" style="border: 1px solid black ;" bgcolor="white"></td>

                                    <td>No Disponible</td>
                                    <td width="20px"  id="nodisponible" height="12px" style="border: 1px solid black ;" bgcolor="blue"></td>

                                </tr>
                            </table>
                        </div>
                        <hr />

                    </div>

                    <div class="detail-content-block">

                        <h3>Precios por temporada</h3>
                        <table border="1"  >

                            <tr>
                                <th>Temporada</th>
                                <th>Fecha Desde</th>
                                <th>Fecha Hasta</th>
                                <th>Precio</th>
                            </tr>

                            <?php
                            foreach ($seasons as $season) {
                                echo "<tr><td align='left'>" . $season->season_name . "</td><td>" . $season->season_from . "</td><td align='right'>" . $season->season_price . " €</td></tr>";
                            }
                            ?>
                        </table>    

                    </div>



                    <div class="detail-content-block">
                        <h3>Si tienes alguna pregunta</h3>
                        <div class="accordion style-2">
                            <div class="acc-panel">
                                <div class="acc-title"><span class="acc-icon"></span>¿Cómo puedo gestionar mis reservas?</div>
                                <div class="acc-body">
<!--                                    <h5>metus Aenean eget massa</h5>-->
                                    <p class="pregunta">Si tienes alguna pregunta sobre como puedes gestionar las reservas, no dude en contactarnos, gracias.</p>
<!--                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <ul>
                                                <li>Shopping history</li>
                                                <li>Hot offers according your settings</li>
                                                <li>Multi-product search</li>
                                                <li>Opportunity to share with friends</li>
                                                <li>User-friendly interface</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <ul>
                                                <li>Shopping history</li>
                                                <li>Hot offers according your settings</li>
                                                <li>Multi-product search</li>
                                                <li>Opportunity to share with friends</li>
                                                <li>User-friendly interface</li>
                                            </ul>									
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <div class="acc-panel">
                              <!--  <div class="acc-title"><span class="acc-icon"></span>¿Cómo puedo listar múltiples habitaciones?</div>-->
<!--                                <div class="acc-body">
                                    <h5>metus Aenean eget massa</h5>
                                    <p>Mauris posuere diam at enim malesuada, ac malesuada erat auctor. Ut porta mattis tellus eu sagittis. Nunc maximus ipsum a mattis dignissim. Suspendisse id pharetra lacus, et hendrerit mi. Praesent at vestibulum tortor. Ut porta mattis tellus eu sagittis. Nunc maximus ipsum a mattis dignissim.</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <ul>
                                                <li>Shopping history</li>
                                                <li>Hot offers according your settings</li>
                                                <li>Multi-product search</li>
                                                <li>Opportunity to share with friends</li>
                                                <li>User-friendly interface</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <ul>
                                                <li>Shopping history</li>
                                                <li>Hot offers according your settings</li>
                                                <li>Multi-product search</li>
                                                <li>Opportunity to share with friends</li>
                                                <li>User-friendly interface</li>
                                            </ul>									
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <div class="acc-panel">
                                <div class="acc-title"><span class="acc-icon"></span>¿Cómo puedo usar mi calendario?</div>
                                <div class="acc-body">
                                    <!--<h5>metus Aenean eget massa</h5>-->
                                    <p class="pregunta">Si no sabe como usar el calendario, contacte con nosotros.</p>
                                    <p class="pregunta">Nuestro servicio técnico se pondrá en contacto con usted a la mayor brevedad posible, gracias.</p>
<!--                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <ul>
                                                <li>Shopping history</li>
                                                <li>Hot offers according your settings</li>
                                                <li>Multi-product search</li>
                                                <li>Opportunity to share with friends</li>
                                                <li>User-friendly interface</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <ul>
                                                <li>Shopping history</li>
                                                <li>Hot offers according your settings</li>
                                                <li>Multi-product search</li>
                                                <li>Opportunity to share with friends</li>
                                                <li>User-friendly interface</li>
                                            </ul>									
                                        </div>
                                    </div>-->
                                </div>
                            </div>                                                                                                                        
                        </div>											
                    </div>										
                </div>       			
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="right-sidebar">
                    <div class="detail-block bg-dr-blue">
                        <h4 class="color-white">detalles</h4>
                        <?php
                        foreach ($owner as $property)
//  print_r($property);
                            
                            ?>
                        <div class="details-desc">
                            <p class="color-grey-9">Tipo:  <span class="color-white"><?php echo $property->property_type ?></span></p>
                            <p class="color-grey-9">price: <span class="color-white">$500 / person</span></p>
                            <p class="color-grey-9">location: <span class="color-white"> 

                                    <?php echo $loc->location_city . ", " . $loc->location_country ?>

                                </span></p>
                            <p class="color-grey-9">date: <span class="color-white">july 19th to july 29th</span></p>
                            <p class="color-grey-9">rate: <span class="fa fa-star color-yellow"></span><span class="fa fa-star color-yellow"></span><span class="fa fa-star color-yellow"></span><span class="fa fa-star color-yellow"></span><span class="fa fa-star color-yellow"></span></p>
                            <p class="color-grey-9">Superficie: <span class="color-white"><?php echo $property->property_square_meters . ' m2' ?></span></p>
                            <p class="color-grey-9">Planta: <span class="color-white"><?php echo $property->property_floor ?></span></p>
                            <p class="color-grey-9">Máximo de personas: <span class="color-white"><?php echo $property->property_persons ?></span></p>
                            <p class="color-grey-9">Habitaciones: <span class="color-white"><?php echo $property->property_bedrooms ?><span class="fa fa-star color-yellow"></span></span></p>
                            <p class="color-grey-9">Baños: <span class="color-white"><?php echo $property->property_bathrooms ?></span></p>
                            <p class="color-grey-9">Cable TV: <span class="color-white">FREE</span></p>
                            <p class="color-grey-9">Telephone: <span class="color-white">YES</span></p>

                            <p class="color-grey-9">Wireless: <span class="color-white">YES</span></p>


                        </div>
                        <div class="details-btn">
                            <a href="#" class="c-button b-40 bg-tr-1 hv-white"><span>view on map</span></a>
                            <a href="#" class="c-button b-40 bg-white hv-transparent"><span>book now</span></a>
                        </div>
                    </div>


                    <div class="popular-tours bg-grey-2">
                        <h4 class="color-dark-2">CONTACTA CON EL PROPIETARIO</h4>

                        <?php
                        foreach ($owner as $property)
                        // print_r($property);
                            $url_base = base_url() . "assets/uploads/images/";


                        $foto_url = $url_base . $property->property_id . "/foto/" . $property->user_information_image;
                        ?>

                        <div class="hotel-small style-2 clearfix">
                            <a class="hotel-img black-hover" href="#">
                                <img class="img-responsive radius-3" src="<?php echo $foto_url ?>" alt="">
                                <div class="tour-layer delay-1"></div>        						
                            </a>
                            <div class="hotel-desc">
                                <h5><span class="color-dark-2"><strong><?php echo $property->user_information_fname ?></strong></span></h5>
                                <h4><?php echo $property->user_information_phone1 ?></h4>
                                <div class="hotel-loc"><?php echo $property->user_information_email1 ?></div>
                                <br>
                                <!--<a href="javascript:showLightbox();" class="btn btn-info btn-lg" style="color: white; ">-->

                                <br>    

                                <!-- -------------------------------------------------------------DESPLEGABLE________________________________________________________________________-->
                                      
                                    <div class="accordion style-2">
                                          <form method="post" action="<?php echo site_url("datos_form") ?>" >  
                                        <div class="acc-panel">
                                            <div class="acc-title acordeon_posicion"><span class="acc-icon"></span>Contactar</div>

                                            <div class="acc-body">
                                                <!--<div class="acc-panel">-->
                                           <!--  <div class="acc-title"><span class="acc-icon"></span>¿Cómo puedo listar múltiples habitaciones?</div>-->
                                              
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">
                                                            Nombre</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            </span>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Introduce tu nombre" required="required" /></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">
                                                            Correo Electrónico</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            </span>
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu correo" required="required" /></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subject">
                                                            Teléfono</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            </span>
                                                            <input type="phone" class="form-control" id="phone" name="tlf" placeholder="Intruduce tu teléfono" required="required" /></div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">
                                                        Mensaje</label>
                                                    <textarea id="message" class="form-control" rows="9" cols="25" name="txt" required="required">Estoy interesado en alquilar esta vivienda, por favor envíeme más información sobre ella o póngase en contacto conmigo, Gracias!</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="sidebar-text-label bg-dr-blue color-white btn pull-right" >Enviar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--                                                    /****************************************/-->
                                        <!--<div class="acc-panel">
                                            <br><br>
                                            <div class="acc-title acordeon_posicion"><span class="acc-icon"></span>Reservar</div>                                      
                                            <div class="acc-body">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="desde">
                                                            Desde:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            </span>
                                                            <input type="date" class="form-control" id="desde" name="desde" placeholder="Introduce fecha Llegada" required="required" /></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hasta">
                                                            Hasta</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            </span>
                                                            <input type="date" class="form-control" id="hasta" name="hasta" placeholder="Introduce fecha Salida" required="required" /></div>
                                                        
                                                    </div>

                                                </div>


                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <a href="<?php echo site_url('reservar'); ?>"><button type="submit" class="sidebar-text-label bg-dr-blue color-white btn pull-right" >Enviar</button>

                                                    </div>

                                                    <!--/*****************************/-->
                                                <!--</div>                                          


                                                </form>
                                                <!-- </div>-->
                                            <!--</div>
                                        </div>-->
                                          </form>
                                        
                                        
                                        <form method="post" action="<?php echo site_url("reservar") ?>">
                                            
                                             <div class="acc-panel">
                                            <br><br>
                                            <div class="acc-title acordeon_posicion"><span class="acc-icon"></span>Reservar</div>                                      
                                            <div class="acc-body">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="desde">
                                                            Desde:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            </span>
                                                            <input type="date" class="form-control" id="desde" name="desde" placeholder="Introduce fecha Llegada" required="required" /></div>
                                                            
                                                             
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hasta">
                                                            Hasta</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            </span>
                                                            <input type="date" class="form-control" id="hasta" name="hasta" placeholder="Introduce fecha Salida" required="required" /></div>
                                                            
                                                           
                                                            
                                                        
                                                    </div>

                                                </div>


                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <a href="<?php echo site_url('reservar'); ?>"><button type="submit" id="enviar" class="sidebar-text-label bg-dr-blue color-white btn pull-right" >Enviar</button>

                                                    </div>

                                                    <!--/*****************************/-->
                                                </div>                                          


                                               
                                                <!-- </div>-->
                                            </div>
                                        </div>
                                        </form>                                      
                                        
                                    </div>
                               
                                
                                
                                    <!-- ________________________________________________________________________________________________________-->


























                                    <!--__________________________________J_M_K______________________________________________________
                                    
                                                    <a href="javascript:hideLightbox();" class="cerrar">x</a>
                                                                <form>
                                                                    <h1 class="h1">
                                                                        Contáctanos <small><br><br><em>Holiday </em><img src="../../../assets/imagenes/mifavicon.png"> Apartment</small>
                                                                    </h1>
                                                                        <br>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="name">
                                                                                    Nombre</label>
                                                                                    <div class="input-group">
                                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                                                                    </span>
                                                                                <input type="text" class="form-control" id="name" placeholder="Introduce tu nombre" required="required" /></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="email">
                                                                                    Correo Electrónico</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                                                                    </span>
                                                                                    <input type="email" class="form-control" id="email" placeholder="Introduce tu correo" required="required" /></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="subject">
                                                                                    Teléfono</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span>
                                                                                    </span>
                                                                                    <input type="phone" class="form-control" id="phone" placeholder="Intruduce tu teléfono" required="required" /></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="name">
                                                                                    Mensaje</label>
                                                                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required">Estoy interesado en alquilar esta vivienda, por favor envieme más información sobre ella o pongase en cotácto conmigo, Gracias!</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <button type="submit" class="btn btn-warning pull-right">Enviar <span class="glyphicon glyphicon-send"></span></button>
                                                                            </div>
                                                                        </div>
                                                                </form>
                                                            </div>
                                    </div>
                                    
                                    
                                    ______________________________________________________________________________________________-->

                            </div>
                        </div>

                    </div>

                    <div class="sidebar-text-label bg-dr-blue color-white">useful information</div>

                    <div class="help-contact bg-grey-2">
                        <h4 class="color-dark-2">Necesitas Ayuda?</h4>
                        <p class="color-grey">¿Necesitas ayuda para hacer la reserva? ¡Envíanos un email! </p>
                        <!-- +34 902636234
(Lun - Vier 10:00 - 18:00 CET)</p>
                    <a class="help-phone color-dark-2 link-dr-blue" href="tel:0200059600"><img src="<?php echo base_url() . 'assets/webapp/' ?>img/detail/phone24-dark.png" alt="">020 00 59 600</a>
                        -->                   <a class="help-mail color-dark-2 link-dr-blue" href="mailto:info@holidayapartment.online"><img src="<?php echo base_url() . 'assets/webapp/' ?>img/detail/letter-dark.png" alt="">info@holidayapartment.online</a>
                    </div>										      				
                </div>       			
            </div>
       	</div>
        <!--       	<div class="may-interested padd-90">
                        <div class="row">
                                <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                                  <div class="hotel-item">
                                         <div class="radius-top">
                                                 <img src="img/home_3/pop_hotel_1.jpg" alt="">
                                                   <div class="price price-s-1">$273</div>
                                         </div>
                                         <div class="title clearfix">
                                             <h4><b>royal Hotel</b></h4>
                                           <div class="rate-wrap">
                                                  <div class="rate">
                                                                        <span class="fa fa-star color-yellow"></span>
                                                                        <span class="fa fa-star color-yellow"></span>
                                                                        <span class="fa fa-star color-yellow"></span>
                                                                        <span class="fa fa-star color-yellow"></span>
                                                                        <span class="fa fa-star color-yellow"></span>
                                                                  </div>
                                                              <i>485 rewies</i> 
                                       </div>  
                                     <span class="f-14 color-dark-2">2 Place de la Sans Défense, Puteaux</span>
                                     <p class="f-14">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                     <a href="#" class="c-button bg-dr-blue hv-dr-blue-o b-50 fl">select</a>
                                     <a href="#" class="c-button color-dr-blue hv-o b-50 fr"><img src="img/loc_icon_small_drak.png" alt="">view on map</a>
                                     </div>
                                  </div>      			
                                </div>
                                <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                                          <div class="hotel-item">
                                                 <div class="radius-top">
                                                         <img src="img/home_3/pop_hotel_2.jpg" alt="">
                                                           <div class="price price-s-1">$273</div>
                                                 </div>
                                                 <div class="title clearfix">
                                                     <h4><b>sheraton Hotel</b></h4>
                                                   <div class="rate-wrap">
                                                          <div class="rate">
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                          </div>
                                                                      <i>485 rewies</i> 
                                               </div>  
                                             <span class="f-14 color-dark-2">2 Place de la Sans Défense, Puteaux</span>
                                             <p class="f-14">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                             <a href="#" class="c-button bg-dr-blue hv-dr-blue-o b-50 fl">select</a>
                                             <a href="#" class="c-button color-dr-blue hv-o b-50 fr"><img src="img/loc_icon_small_drak.png" alt="">view on map</a>
                                             </div>
                                          </div>      			
                                </div>
                                <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                                          <div class="hotel-item">
                                                 <div class="radius-top">
                                                         <img src="img/home_3/pop_hotel_3.jpg" alt="">
                                                           <div class="price price-s-1">$273</div>
                                                 </div>
                                                 <div class="title clearfix">
                                                     <h4><b>royal Hotel</b></h4>
                                                   <div class="rate-wrap">
                                                          <div class="rate">
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                          </div>
                                                                      <i>485 rewies</i> 
                                               </div>  
                                             <span class="f-14 color-dark-2">2 Place de la Sans Défense, Puteaux</span>
                                             <p class="f-14">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                             <a href="#" class="c-button bg-dr-blue hv-dr-blue-o b-50 fl">select</a>
                                             <a href="#" class="c-button color-dr-blue hv-o b-50 fr"><img src="img/loc_icon_small_drak.png" alt="">view on map</a>
                                             </div>
                                          </div>       			
                                </div>
                                <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                                          <div class="hotel-item">
                                                 <div class="radius-top">
                                                         <img src="img/home_3/pop_hotel_4.jpg" alt="">
                                                           <div class="price price-s-1">$273</div>
                                                 </div>
                                                 <div class="title clearfix">
                                                     <h4><b>sheraton Hotel</b></h4>
                                                   <div class="rate-wrap">
                                                          <div class="rate">
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                                <span class="fa fa-star color-yellow"></span>
                                                                          </div>
                                                                      <i>485 rewies</i> 
                                               </div>  
                                             <span class="f-14 color-dark-2">2 Place de la Sans Défense, Puteaux</span>
                                             <p class="f-14">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                             <a href="#" class="c-button bg-dr-blue hv-dr-blue-o b-50 fl">select</a>
                                             <a href="#" class="c-button color-dr-blue hv-o b-50 fr"><img src="img/loc_icon_small_drak.png" alt="">view on map</a>
                                             </div>
                                          </div>     			
                                </div>        		       		       		
                        </div>
                </div>
        -->	</div>
</div>

