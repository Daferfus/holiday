
<body data-color="theme-1">


    <div class="list-wrapper bg-grey-2">
        <div class="container-fluid">
            <div class="row">
                <div class="flex-container"> 
                    
                                    <article class="main col-sm-12 col-md-12">

                <div class="col-xs-12  " id="Paginacion">
                    <div class="list-header clearfix">
                        <!--        <div class="drop-wrap drop-wrap-s-4 color-4 list-sort">
                                    <div class="drop">
                                        <b>Ordenar por precio</b>
                                        <a href="#" class="drop-list"><i class="fa fa-angle-down"></i></a>
                                        <span>
                                            <a href="<?php orderby('ASC');
echo site_url('search');
?>">DE MENOR A MAYOR PRECIO</a>
                                            <a href="<?php orderby('DESC');
                        echo site_url('search');
?>">DE MAYOR A MENOR PRECIO</a>
                                        </span>
                                    </div>
                                </div>  -->
                        <!-- ORDENADOR2
                        <div class="drop-wrap drop-wrap-s-4 color-4 list-sort">
                            <div class="drop">
                                <b>Ordenar</b>
                                <a href="#" class="drop-list"><i class="fa fa-angle-down"></i></a>
                                <span>
                                    <a href="#">ASC</a>
                                    <a href="#">DESC</a>
                                </span>
                            </div>
                        </div> FIN DE ORDENADOR -->
                        <div class="list-view-change">
                            <div class="change-grid color-1 fr"><i class="fa fa-th"></i></div>
                            <div class="change-list color-1 fr active"><i class="fa fa-bars"></i></div>
                            <div class="change-to-label fr color-grey-8">Vista:</div>
                        </div>
                    </div>
                    <div class="list-content clearfix">



                        <?php
                        echo $total_rows . " propiedades encontradas <br><br>";
                        if (isset($properties)) {
                            foreach ($properties as $property) {
                                ?> 
                                <div class="list-item-entry">
                                    <div class="hotel-item style-3 bg-white">
                                        <div class="table-view">
                                            <div class="radius-top cell-view">
                                                <a href="<?php echo $property->urls_name ?>"  rel="nofollow" target="_blank" ><img width="50px" height="50px" src="<?php echo $property->picture_url ?>"  alt = ""></a>   

                                            </div>
                                            <div class = "title hotel-middle clearfix cell-view">   
                                                <div class = "date list-hidden">July <strong>19th</strong> to July <strong>26th</strong></div>   
                                                <div class = "date grid-hidden"><strong><?php echo "$data_entry - $data_output / " . ($data_output - $data_entry) ?></strong> noches</div>		
                                             <!--   <h2><?php echo "REF:" . $property->property_id ?> </h2> -->                                         
                                                <h4><b><?php echo $property->text_title ?></b></h4>                         
                                                <div class = "rate-wrap">                                
                                                    <div class = "rate">          
                                                        <span class = "fa fa-star color-yellow"></span>        
                                                        <span class = "fa fa-star color-yellow"></span>       
                                                        <span class = "fa fa-star color-yellow"></span>         
                                                        <span class = "fa fa-star color-yellow"></span>         
                                                        <span class = "fa fa-star color-yellow"></span>           
                                                    </div>                                   
                                                    <!-- <i>485 rewies</i> -->                          
                                                </div>                                             
                                                <p class = "f-14 grid-hidden"><?php
                                                    echo $property->location_address . "<br>";
                                                    echo "Máximo número de huéspedes: " . $property->property_persons . "<br>";
                                                    if ($property->beds_double_beds > 0)
                                                        echo "Camas dobles: " . $property->beds_double_beds . "<br>";

                                                    if ($property->beds_double_sofa_beds > 0)
                                                        echo "Sofás Camas: " . $property->beds_double_sofa_beds . "<br>";
                                                    if ($property->beds_single_sofa_beds > 0)
                                                        echo "Sofás Camas: " . $property->beds_single_sofa_beds . "<br>";
                                                    ?></p>  
                                            </div>                        
                                            <div class = "title hotel-right clearfix cell-view">        
                                                <div class = "hotel-person color-dark-2">desde <span class = "color-blue"><?php echo $property->pricing_price . ' ' . $property->pricing_currency
                                                ?></span>por Noche</div>  
                                                <a class = "c-button b-40 bg-blue hv-blue-o grid-hidden" href = "<?php echo $property->urls_name ?>"  rel="nofollow"   target="_blank" >Ver más</a>   
                                            </div>                            
                                        </div>       
                                    </div> 
                                </div>             
                                <?php
                            }
                        }
                        ?> 

                    </div>
                    <br><br><br>
                    <div class="c_pagination clearfix padd-120">										
                        <!--  <a href="#" class="c-button b-40 bg-blue-2 hv-blue-2-o fl">prev page</a>
                          <a href="#" class="c-button b-40 bg-blue-2 hv-blue-2-o fr">next page</a> -->
                        <ul class="cp_content color-1">																	

<?php echo $paginacion; ?>
                            <!--    <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li> -->
                        </ul>
                    </div>  <!-- FIN PAGINACION -->



                </div>

                </article>
                    

                <aside class="aside aside1">
                <div class="col-xs-12 col-sm-4 col-md-5" id="lateral">
                    <div class="sidebar bg-white clearfix">
                        <div class="sidebar-block">
                            <h4 class="sidebar-title color-dark-2">Buscar</h4>

                            <form action="<?php echo site_url('search'); ?>" method="post">

                                <div class="search-inputs">
                                    <div class="form-block clearfix">
                                        <div class="input-style-1 b-50 color-3">
                                            <img src="<?php echo base_url('assets/webapp'); ?>/img/loc_icon_small_grey.png" alt="">
                                            <input type="text" placeholder="Destino" name="city">
                                        </div>
                                    </div>
                                    <div class = "form-block clearfix">
                                        <div class="input-style-1 b-50 color-3">
                                            <img src="<?php echo base_url('assets/webapp'); ?>/img/calendar_icon_grey.png" alt="">
                                            <input type="text" placeholder="Fecha de entrada" class="datepicker">
                                        </div>
                                    </div>
                                    <div class="form-block clearfix">
                                        <div class="input-style-1 b-50 color-3">
                                            <img src="<?php echo base_url('assets/webapp'); ?>/img/calendar_icon_grey.png" alt="">
                                            <input type="text" placeholder="Fecha de salida" class="datepicker">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="c-button b-40 bg-blue-2 hv-blue-2-o" value="Buscar">
                            </form>

                        </div>

                        <div class="sidebar-block">
                            <p class="sidebar-title color-dark-2">Pincha aquí y mira nuestras ofertas</p>
                            <div class="sidebar-rating">
                                <div class="input-entry color-1">
                                    <input class="checkbox-form" id="star-5" type="checkbox" name="checkbox" value="climat control">
                                    <label class="clearfix" for="star-5" >
                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                        <span class="rate">
                                            <span class="fa fa-star color-yellow"><a href="http://www.tripsta.es/?utm_source=zanox_es&utm_medium=affiliate&utm_content=banner_250x250&utm_campaign=flights&partnerCode=4256cc&userID=2244304&zanpid=2170999692379747328" rel="nofollow" target="_blank" ><b>Vuelos ver precio</b></a></span>
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                        </span>
                                    </label>
                                </div>
                                <div class="input-entry color-1">
                                    <input class="checkbox-form" id="star-4" type="checkbox" name="checkbox" value="climat control">
                                    <label class="clearfix" for="star-4" >
                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                        <span class="rate">
                                            <span class="fa fa-star color-yellow"><a href="http://ad.zanox.com/ppc/?38089538C1771126397T" rel="nofollow" target="_blank" ><b> Alquiler de vehículos ver precio</b></a></span>
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                        </span>
                                    </label>
                                </div>
                                <div class="input-entry color-1">
                                    <input class="checkbox-form" id="star-3" type="checkbox" name="checkbox" value="climat control">
                                    <label class="clearfix" for="star-3" >
                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                        <span class="rate">
                                            <span class="fa fa-star color-yellow"><a href="http://www.booking.com/resorts/index.html?aid=1143346" rel="nofollow" target="_blank" ><b> Alojarse en hoteles ver precios</b></a></span>
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                        </span>
                                    </label>
                                </div>
                                <div class="input-entry color-1">
                                    <input class="checkbox-form" id="star-2" type="checkbox" name="checkbox" value="climat control">
                                    <label class="clearfix" for="star-2" >
                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                        <span class="rate">
                                            <span class="fa fa-star color-yellow"><a href="http://www.booking.com/guest-house/index.html?aid=1143346" rel="nofollow" target="_blank" ><b> Alojarse en hostales ver precio</b></a></span>
                                            <!--<span class="fa fa-star color-yellow"></span>-->
                                        </span>
                                    </label>
                                </div>

                                <!--                                <div class="input-entry color-1">
                                                                    <input class="checkbox-form" id="star-1" type="checkbox" name="checkbox" value="climat control">
                                                                    <label class="clearfix" for="star-1" >
                                                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                        <span class="rate">
                                                                            <span class="fa fa-star color-yellow"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>-->
                            </div>
                        </div>
                        <div class="sidebar-block">
                            <div class="input-entry color-1">
                                <ins class="bookingaff" data-aid="1144828" data-target_aid="1143346" data-prod="banner" data-width="300" data-height="250" data-banner_id="28690">
                                    <!-- Anything inside will go away once widget is loaded. -->
                                    <a href="//www.booking.com?aid=1143346" rel="nofollow"  >Booking.com</a>
                                </ins>
                                <script type="text/javascript">
                                    (function (d, sc, u) {
                                        var s = d.createElement(sc), p = d.getElementsByTagName(sc)[0];
                                        s.type = 'text/javascript';
                                        s.async = true;
                                        s.src = u + '?v=' + (+new Date());
                                        p.parentNode.insertBefore(s, p);
                                    })(document, 'script', '//aff.bstatic.com/static/affiliate_base/js/flexiproduct.js');
                                </script>
                            </div>

                        </div>
                        <div class="sidebar-block">
                            <div class="input-entry color-1">
                                <a href="http://www.hoteltravel.com/es/spain/alicante/promotions/promotions.html" rel="nofollow" target="_blank">
                                    <img alt="hotel con descuento alicante"  border="0" src="http://www.hoteltravel.com/partner/bannerimage.aspx?alt=hotel con descuento alicante&lng=es&co=es&c=alc&bannersize=8&cmp=1&siteid=1"></a>
                            </div>
                        </div>

                        <!-- <div class="sidebar-block"> Prueba-->
                        <!-- 	<div class="input-entry color-1"> Prueba-->

                    </div>

                </div>
                    </aside>




            </div> <!-- FIN DE ROW -->
            </div> <!-- FIN DEL FLEXBOX -->
        </div>  <!-- FIN DIV.CONTAINER.FLUID -->
    </div> <!-- FIN WRAPPER -->
