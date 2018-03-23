
<body data-color="theme-1">
    
<!-- Para cargar ventana de en proceso -->   

 <div class="loading">
	<div class="loading-center">
		<div class="loading-center-absolute">
			<div class="object object_four"></div>
			<div class="object object_three"></div>
			<div class="object object_two"></div>
			<div class="object object_one"></div>
		</div>
	</div>
  </div>  
<!-- FIN Para cargar ventana de en proceso -->

    <div class="list-wrapper bg-grey-2">
        <div class="container-fluid">
       
            <div class="row">
               <div class="flex-container">

                    <article class="main col-xs-12 col-sm-8 col-md-12 col-xs-12" id="paginacion">


                        <div class="list-content clearfix">



                            <?php
                            
                            $data_entry = $this->session->userdata('data_entry');
                            $data_output = $this->session->userdata('data_output');
                            $session = session_id();
                           // $session_id = $this->session->userdata('session_id');
                            //echo "<br>Sesion:$session<br>".$total_rows . " propiedades encontradas <br><br>";
                            echo "<br><br>".$total_rows . " propiedades encontradas <br><br>";
                            if (isset($properties)) {
                                foreach ($properties as $property) {
                                    ?> 
                                    <div class="list-item-entry">
                                        <div class="hotel-item style-3 bg-white">
                                            <div class="table-view">
                                                <div class="radius-top cell-view">
                                                    <?php
                                                    
                                                    $property->text_title = str_replace('"', '', $property->text_title);
                                                    
                                                    if ($property->property_provider == "belvilla") {
                                                    $property->picture_url = "https://".$property->picture_url;
                                                    }
                                                    
                                                    if ($property->property_provider == "holiday") {
                                                    $url_base = base_url()."assets/uploads/images/";    
                                                        
                                                        
                                                    $property->picture_url = $url_base.$property->property_code."/".$property->picture_url;
                                                    }
                                                    
                                                    
                                                    if ($property->property_provider == "wimdu") {
                                                        $property->urls_name = str_replace(".com",".es",$property->urls_name)."/?wt_af=int.ot.holidayapartment.1";
                                                    //Para evitar la carga grande de imagenes hemos de rremplazar $property->picture_url
                                                        //print_r($property->picture_url);
                                                                                                               
                                                        if (!empty($property->picture_url)) {
                                                        $url_imatge = explode('/',$property->picture_url);
                                                       // echo "URL_IMATGE<br>";
                                                       // print_r($url_imatge);
                                                       // echo "FIN --URL_IMATGE<br>";
                                                        $property->picture_url = $url_imatge[0] . '/' .$url_imatge[1] .'/'.$url_imatge[2] .'/'.$url_imatge[3] .'/'.$url_imatge[4] .'/'.$url_imatge[5] .'/' .$url_imatge[6] .'/preview.jpg';
                                                        }else
                                                            $property->picture_url="";
                                                        
                                                    }
                                                    //para 9flats hay que añadir 
                                                    if ($property->property_provider == "9flats") {
                                                    $cookie_9flats="?a_aid=holidayapartmentonline&utm_source=coop-holidayapartmentonline&utm_campaign=holidayapartmentonline-integration&utm_medium=commission";
                                                    $property->urls_name.= $cookie_9flats;
                                                    
                                                    }
                                                    
                                                    ?>
                                                    <a href="<?php echo $property->urls_name ?>"  rel="nofollow" target="_blank" ><img src="<?php echo $property->picture_url ?>"  alt = "<?php echo $property->text_title ?>"></a>   

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





                    </article>


                    <aside class="aside aside1 col-xs-12 col-sm-4 col-md-1">
                       
                            <div class="sidebar bg-white clearfix">
                                <div class="sidebar-block">
                                    <h4 class="sidebar-title color-dark-2">Buscar</h4>

                                    <form action="<?php echo site_url('alquiler'); ?>" method="post">

                                        <div class="search-inputs">
                                            <div class="form-block clearfix">
                                                <div class="input-style-1 b-50 color-3">
                                                    <img src="<?php echo base_url('assets/webapp'); ?>/img/loc_icon_small_grey.png" alt="">
                                                    <input type="text" placeholder="Destino" name="city" required="true" value="<?php if (!empty($this->session->userdata('city'))) echo $this->session->userdata('city'); ?>">
                                                </div>
                                            </div>
                                            <div class = "form-block clearfix">
                                                <div class="input-style-1 b-50 color-3">
                                                    <img src="<?php echo base_url('assets/webapp'); ?>/img/calendar_icon_grey.png" alt="">
                                                    <input type="text" placeholder="Fecha de entrada" id="data_entry" name="data_entry"  value="<?php if (!empty($this->session->userdata('data_entry'))) echo $this->session->userdata('data_entry'); ?>" >
                                                </div>
                                            </div>
                                            <div class="form-block clearfix">
                                                <div class="input-style-1 b-50 color-3">
                                                    <img src="<?php echo base_url('assets/webapp'); ?>/img/calendar_icon_grey.png" alt="">
                                                    <input type="text" placeholder="Fecha de salida" id="data_output" name="data_output" value="<?php if (!empty($this->session->userdata('data_output'))) echo $this->session->userdata('data_output'); ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="c-button b-40 bg-blue-2 hv-blue-2-o" value="Buscar">
                                    </form>

                                </div>

                                <div class="sidebar-block">
                                    <p class="sidebar-title color-dark-2">Pincha aquí y mira nuestras ofertas</p>
                                    <ul>
									<li>
									<div class="input-entry color-1">
										<label class="clearfix" for="star-4" >	
											<span class="rate">										
											<span class="fa fa-star color-yellow"><a href="http://www.tripsta.es/?utm_source=zanox_es&utm_medium=affiliate&utm_content=banner_250x250&utm_campaign=flights&partnerCode=4256cc&userID=2244304&zanpid=2170999692379747328" rel="nofollow" target="_blank" ><b>Vuelos ver precio</b></a></span>
											</span>
										</label>					
									</div>		
										
                                    </li>
									<li>	
                                        <div class="input-entry color-1">
                                            
                                            <label class="clearfix" for="star-4" >

                                                <span class="rate">
                                                    <span class="fa fa-star color-yellow"><a href="http://ad.zanox.com/ppc/?38089538C1771126397T" rel="nofollow" target="_blank" ><b> Alquiler de vehículos ver precio</b></a></span>
                                                   
                                                </span>
                                            </label>
                                        </div>
									</li>
									<li>
                                        <div class="input-entry color-1">
                                            
                                            <label class="clearfix" for="star-3" >
                                                
                                                <span class="rate">
                                                <!--    <span class="fa fa-star color-yellow"><a href="http://www.booking.com/resorts/index.html?aid=1143346" rel="nofollow" target="_blank" ><b> Alojarse en hoteles ver precios</b></a></span>
                                                 -->    
                                                 
                                            <span class="fa fa-star color-yellow"><a href="https://www.hoteltravel.com/agents/passthrough.asp?affil_id=312286&co=ES&c=M&lng=es" target="_blank"><b> Alojarse en hoteles ver precios</b></a>
                                                </span>
                                            </label>
                                        </div>
									</li>
									<li>
                                        <div class="input-entry color-1">
                                            
                                            <label class="clearfix" for="star-2" >
                                               
                                                <span class="rate">
                                                    <span class="fa fa-star color-yellow"><a href="http://www.booking.com/guest-house/index.html?aid=1143346" rel="nofollow" target="_blank" ><b> Alojarse en hostales ver precio</b></a></span>
                                                    
                                                </span>
                                            </label>
                                        </div>
									</li>

                                     </ul>  

                                </div>
                                <div class="sidebar-block">
                                    <div class="input-entry color-1">
                                        <ins class="bookingaff" data-aid="1144828" data-target_aid="1143346" data-prod="banner" data-width="200" data-height="250" data-banner_id="28690">
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
                     <!--                   <a href="http://www.hoteltravel.com/es/spain/madrid/promotions/promotions.html" target="_blank"><img alt="hotel con descuento madrid"  border="0" src="http://www.hoteltravel.com/partner/bannerimage.aspx?alt=hotel con descuento madrid&lng=es&co=es&c=med&bannersize=8&cmp=1&siteid=1"></a>  -->
                                        
                                <!--        <a href="https://www.hoteltravel.com/agents/passthrough.asp?affil_id=312286&co=ES&c=MED&lng=en&siteid=1" target="_blank"> -->
                                        <a href="https://www.hoteltravel.com/agents/passthrough.asp?affil_id=312286&co=ES&c=M&lng=es" target="_blank">
                                            
                                            <img alt="Madrid hotels" border="0" src=" https://res3.hoteltravel.com/images/banner_ads/en/madrid/madrid_200x200.jpg"></a>
                                    </div>
                                </div>

                               

                            </div>



                   </aside>



               </div>  <!-- FIN FLEX.CONTAINER -->

            </div> <!-- FIN DE ROW -->

        </div>   <!-- FIN DIV.CONTAINER.FLUID -->

    </div> <!-- FIN list-wrapper bg-grey-2 -->
