<style>
    .ig-b- { display: inline-block; }
    .ig-b- img { visibility: hidden; }
    .ig-b-:hover { background-position: 0 -60px; } 
    .ig-b-:active { background-position: 0 -120px; }
    .ig-b-32 { width: 32px; height: 32px; background: url(//badges.instagram.com/static/images/ig-badge-sprite-32.png) no-repeat 0 0; }
    @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
        .ig-b-32 { background-image: url(//badges.instagram.com/static/images/ig-badge-sprite-32@2x.png); background-size: 60px 178px; } }

</style>

<script type='text/javascript' async defer  data-pin-shape='round' data-pin-height='32' data-pin-hover='true' src='//assets.pinterest.com/js/pinit.js'></script>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.7";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- INNER-BANNER -->
<br><br>
<div class="inner-banner style-6">
   <img class="center-image" src="<?php echo base_url('assets/webapp'); ?>/img/detail/bg_5.jpg" alt="Blog Holiday">
    
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <ul class="banner-breadcrumb  clearfix">
                   <!--     <li><a class="link-blue-2" href="#">home</a> /</li>  -->
                        <li><span><h1>blog holiday</h1></span></li>
                    </ul>
                    
                   
                </div>
            </div>
        </div>
    </div>
    
</div>
<br><br>
<!-- BLOG -->
<div class="detail-wrapper">
    <div class="container">
       	<div class="row padd-90">
            <div class="col-xs-12 col-md-8">
                <div class="blog-list">
                    <?php
                    // echo "<br><br><br>";
                    foreach ($posts as $post) {
                        ?>   			
                        <div class="blog-list-entry">
                            <div class="blog-list-top">
                                <img src="<?php echo base_url(); ?>assets/uploads/files/<?php echo $post->post_image ?>" alt="<?php echo $post->post_image_alt ?>"/>
                            </div>
                            <h2 class="blog-list-title"><a class="color-dark-2 link-dr-blue-2" href="<?php echo site_url('/post/' . $post->post_slug) ?>"><?php echo $post->post_title ?></a></h2>
                            <div class="tour-info-line clearfix">
                                <div class="tour-info fl">
                                    <img src="<?php echo base_url('assets/webapp'); ?>/img/calendar_icon_grey.png" alt="">
                                    <span class="font-style-2 color-dark-2"><?php echo $post->dia . "/" . $post->mes ?></span>
                                </div>
                                <div class="tour-info fl">
                                    <img src="<?php echo base_url('assets/webapp'); ?>/img/people_icon_grey.png" alt="">
                                    <span class="font-style-2 color-dark-2">By <?php echo $post->post_author ?></span>
                                </div>
                                <div class="tour-info fl">
                                    <img src="<?php echo base_url('assets/webapp'); ?>/img/comment_icon_grey.png" alt="">
                                    <span class="font-style-2 color-dark-2">10 comments</span>
                                </div>						
                            </div>
                            <div class="blog-list-text color-grey-3"><?php echo $post->post_abstract ?> </div>


                            <a href="<?php echo site_url('/post/' . $post->post_slug) ?>" class="c-button small bg-dr-blue-2 hv-dr-blue-2-o"><span>leer más</span></a>	  	 					
                   <!--         <div id="container"> -->
                                <div class="fb-share-button" data-href="https://holidayapartment.online" data-layout="button" data-mobile-iframe="true">
                                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fholidayapartment.online%2F&amp;src=sdkpreparse">Compartir</a>


                                </div>
                                
                        
                            <!--    <div> -->
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-dnt="true">Tweet</a> <script>!function (d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                        if (!d.getElementById(id)) {
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = p + '://platform.twitter.com/widgets.js';
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }
                                    }(document, 'script', 'twitter-wjs');</script>
                            <!--    </div> -->


                                <!-- Inserta esta etiqueta donde quieras que aparezca Botón Compartir. -->
                                <div class="g-plus" data-action="share"></div>
                          <!--      <div> -->
                                    <a href="https://www.instagram.com/holidayapartment.online/?ref=badge" class="ig-b- ig-b-32"><img src="//badges.instagram.com/static/images/ig-badge-32.png" alt="Instagram" /></a>

                          <!--      </div> -->

                          <!--  </div> -->

                        </div>

                    <?php } ?>
                    <div class="c_pagination clearfix">
                        <a href="#" class="c-button b-40 bg-dr-blue-2 hv-dr-blue-2-o fl">prev page</a>
                        <a href="#" class="c-button b-40 bg-dr-blue-2 hv-dr-blue-2-o fr">next page</a>
                        <ul class="cp_content color-3">
                            <?php echo $paginacion; ?>
                       <!--     <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">10</a></li> -->
                        </ul>
                    </div>
                </div>				       			
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="right-sidebar">
                    <!--       <div class="sidebar-block type-2">
                               <div class="widget-search clearfix">
                                   <form>
                                       <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                           <input type="text" placeholder="Enter what you want to find">
                                       </div>
                                       <input class="widget-submit" type="submit" value="">
                                   </form>
                               </div>
                           </div> -->
                    <div class="sidebar-block type-2">
                        <h4 class="sidebar-title color-dark-2">categorias</h4>
                        <ul class="sidebar-category color-5">


                            <?php foreach ($categories_post as $categoria) { ?>
                                <li><a href="<?php echo site_url('/cat_blog/' . $categoria->post_category_slug) ?>"><?php echo $categoria->post_category_name ?></a></li>
                            <?php } ?> 
                            <!--       <li>
                                       <a href="#">all <span class="fr">(125)</span></a>
                                   </li>
                                   <li>
                                       <a href="#">family <span class="fr">(26)</span></a>									
                                   </li>
                                   <li>
                                       <a href="#">adventure <span class="fr">(66)</span></a>								
                                   </li>
                                   <li>
                                       <a href="#">romantic  <span class="fr">(59)</span></a>
                                   </li>
                                   <li>
                                       <a href="#">wildlife  <span class="fr">(55)</span></a>
                                   </li>
                                   <li class="active">
                                       <a href="#">beach  <span class="fr">(89)</span></a>
                                   </li>																
                                   <li>
                                       <a href="#">honeymoon  <span class="fr">(27)</span></a>
                                   </li>
                                   <li>
                                       <a href="#">island  <span class="fr">(45)</span></a>
                                   </li>
                                   <li>
                                       <a href="#">parks  <span class="fr">(72)</span></a>
                                   </li> -->																									
                        </ul>
                    </div> 
                    <div class="sidebar-block type-2">
                        <h4 class="sidebar-title color-dark-2">etiquetas</h4>
                        <ul class="widget-tags clearfix">


                            <?php foreach ($tags as $tag) { ?>
                                <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="<?php echo site_url('/tag/' . $tag->tag_slug) ?>"><?php echo $tag->tag_name ?></a></li>
                            <?php } ?>
                            <!--       <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">flights</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">travelling</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">Sale</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">cruises</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">Sale</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">travelling</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">travelling</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">Illegal</a></li>
                                   <li><a class="c-button b-30 b-1 bg-grey-2 hv-dr-blue-2" href="#">flights</a></li> 							
                            --> </ul>
                    </div>
                    <div class="sidebar-block type-2">
                        <h4 class="sidebar-title color-dark-2">últimas publicaciones</h4>
                        <div class="widget-popular">

                            <?php foreach ($last_posts as $post) { ?>
                                <div class="hotel-small style-2 clearfix">
                                    <a class="hotel-img black-hover" href="<?php echo site_url('/post/' . $post->post_slug) ?>">
                                        <img class="img-responsive radius-0" src="<?php echo base_url(); ?>assets/uploads/files/<?php echo $post->post_image ?>" alt="<?php echo $post->post_image_alt ?>">
                                        <div class="tour-layer delay-1"></div>        						
                                    </a>
                                    <div class="hotel-desc">
                                        <div class="tour-info-line">
                                            <div class="tour-info">
                                                <img src="<?php echo base_url('assets/webapp'); ?>/img/calendar_icon_grey.png" alt="">
                                                <span class="font-style-2 color-dark-2"><?php echo $post->post_date ?></span>
                                            </div>
                                            <div class="tour-info">
                                                <img src="<?php echo base_url('assets/webapp'); ?>/img/people_icon_grey.png" alt="">
                                                <span class="font-style-2 color-dark-2">By <?php echo $post->post_author ?></span>
                                            </div>					
                                        </div>
                                        <h4><?php echo $post->post_title ?></h4>
                                        <div class="tour-info-line clearfix">
                                            <div class="tour-info">
                                                <img src="<?php echo base_url('assets/webapp'); ?>/img/comment_icon_grey.png" alt="">
                                                <span class="font-style-2 color-dark-2">10 comments</span>
                                            </div>						
                                        </div>			    					
                                    </div>
                                </div>

                            <?php } ?>

                            <!--
                            <div class="hotel-small style-2 clearfix">
                                <a class="hotel-img black-hover" href="#">
                                    <img class="img-responsive radius-0" src="img/home_7/small_hotel_7.jpg" alt="">
                                    <div class="tour-layer delay-1"></div>        						
                                </a>
                                <div class="hotel-desc">
                                    <div class="tour-info-line">
                                        <div class="tour-info">
                                            <img src="img/calendar_icon_grey.png" alt="">
                                            <span class="font-style-2 color-dark-2">03/07/2015</span>
                                        </div>
                                        <div class="tour-info">
                                            <img src="img/people_icon_grey.png" alt="">
                                            <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                        </div>					
                                    </div>
                                    <h4>mauritius from 5 days</h4>
                                    <div class="tour-info-line clearfix">
                                        <div class="tour-info">
                                            <img src="img/comment_icon_grey.png" alt="">
                                            <span class="font-style-2 color-dark-2">10 comments</span>
                                        </div>						
                                    </div>			    					
                                </div>
                            </div>	
                            
                            -->
                        </div>
                    </div>
                    <!--
                    <div class="sidebar-block type-2">
                        <div class="simple-tab tab-3 color-1 tab-wrapper">
                            <div class="tab-nav-wrapper">
                                <div class="nav-tab  clearfix">
                                    <div class="nav-tab-item active">
                                        commented
                                    </div>
                                    <div class="nav-tab-item">
                                        popular
                                    </div>
                                    <div class="nav-tab-item">
                                        new
                                    </div>                          
                                </div>
                            </div>
                            <div class="tabs-content clearfix">
                                <div class="tab-info active">
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/home_9/cruise_1.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/detail/popular_1.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/detail/popular_2.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>	
                                </div>
                                <div class="tab-info">
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/detail/popular_2.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>                                 
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/home_9/cruise_1.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/detail/popular_1.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>		
                                </div>
                                <div class="tab-info">
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/detail/popular_1.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>                                
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/home_9/cruise_1.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>
                                    <div class="hotel-small style-2 clearfix">
                                        <a class="hotel-img black-hover" href="#">
                                            <img class="img-responsive radius-0" src="img/detail/popular_2.jpg" alt="">
                                            <div class="tour-layer delay-1"></div>        						
                                        </a>
                                        <div class="hotel-desc">
                                            <div class="tour-info-line">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">03/07/2015</span>
                                                </div>				
                                            </div>
                                            <h4>cruises reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/people_icon_grey.png" alt="">
                                                    <span class="font-style-2 color-dark-2">By Emma Stone</span>
                                                </div>					
                                            </div>			    					
                                        </div>
                                    </div>										
                                </div>     
                            </div>
                        </div>	
                    </div>
                    
                    
                    -->
                    <!--
                    <div class="sidebar-block type-2">
                        <div class="widget-slider arrows">
                            <div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="900" data-center="0" data-slides-per-view="1">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide radius-4 active" data-val="0">
                                        <img class="center-image" src="img/detail/widget_s.jpg" alt="">
                                        <div class="vertical-bottom">
                                            <h4 class="color-white">best hotels reviews</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon.png" alt="">
                                                    <span class="font-style-2 color-white">03/07/2015</span>
                                                </div>
                                                <div class="tour-info">
                                                    <img src="img/people_icon.png" alt="">
                                                    <span class="font-style-2 color-white">By Emma Stone</span>
                                                </div>					
                                            </div>											
                                        </div>
                                    </div>
                                    <div class="swiper-slide radius-4" data-val="1">
                                        <img class="center-image" src="img/home_9/f_slide.jpg" alt="">
                                        <div class="vertical-bottom">
                                            <h4 class="color-white">royal Hotel</h4>
                                            <div class="tour-info-line clearfix">
                                                <div class="tour-info">
                                                    <img src="img/calendar_icon.png" alt="">
                                                    <span class="font-style-2 color-white">03/07/2015</span>
                                                </div>
                                                <div class="tour-info">
                                                    <img src="img/people_icon.png" alt="">
                                                    <span class="font-style-2 color-white">By Emma Stone</span>
                                                </div>					
                                            </div>												
                                        </div>										
                                    </div>	
                                </div>    
                                <div class="pagination pagination-hidden poin-style-1"></div>
                                <div class="arr-t-3">
                                    <div class="swiper-arrow-left sw-arrow"><span class="fa fa-angle-left"></span></div>
                                    <div class="swiper-arrow-right sw-arrow"><span class="fa fa-angle-right"></span></div>
                                </div>			
                            </div>
                        </div>
                    </div>
                    -->
                    <!--
                    <div class="sidebar-block type-2">
                        <h4 class="sidebar-title color-dark-2">latest comments</h4>
                        <div class="widget-comment">
                            <div class="w-comment-entry">
                                <div class="w-comment-date"><img src="img/calendar_icon_grey.png" alt=""> july <strong>19th 2015</strong></div>
                                <div class="w-comment-title color-grey-3"><a class="color-dark-2" href="#">BEST HOTELS REVIEWS</a> by <span class="color-dark-2">Emma Stone</span></div>
                                <div class="w-comment-text color-grey-3">Lorem ipsum dolor sit amet, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                            </div>
                            <div class="w-comment-entry">
                                <div class="w-comment-date"><img src="img/calendar_icon_grey.png" alt=""> july <strong>21th 2015</strong></div>
                                <div class="w-comment-title color-grey-3"><a class="color-dark-2" href="#">TOP BEST HOTELS AND TOURS</a> by <span class="color-dark-2">Emma Stone</span></div>
                                <div class="w-comment-text color-grey-3">Lorem ipsum dolor sit amet, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                            </div>
                            <div class="w-comment-entry">
                                <div class="w-comment-date"><img src="img/calendar_icon_grey.png" alt=""> july <strong>29th 2015</strong></div>
                                <div class="w-comment-title color-grey-3"><a class="color-dark-2" href="#">TOP BEST HOTELS AND TOURS</a> by <span class="color-dark-2">Emma Stone</span></div>
                                <div class="w-comment-text color-grey-3">Lorem ipsum dolor sit amet, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                            </div>														
                        </div>
                    </div>
                    
                    -->



                </div>       			
            </div>
       	</div>
    </div>
</div>



