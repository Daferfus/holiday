    <section class="main-container">
        <div class="container" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-12">
                   <ul class="col-md-8 content-blog" style="border-right: dotted 1px #333;">
                          <?php
                          
                          echo "<br><br><br>";
                           foreach ($posts as $post) { ?>
                            <li class="blog-post format-standard isotope-item">
                                
                                <div class="post-info clearfix">
                                        <div class="meta-container" id="no-decoration">
                                            <a  href="<?php echo site_url('/post/'.$post->post_slug) ?>">
                                                <h2><?php echo $post->post_title ?></h2>
                                            </a>
                                        </div>
                                    </div>
                                
                                
                                <div class="post-media">
<!--                                    <a href="<?php //echo site_url($carpeta.'/post/'.$post->post_slug) ?>">-->
                                        <img src="<?php echo base_url(); ?>assets/uploads/files/<?php echo $post->post_image ?>" alt=""/>
<!--                                    </a>-->
                                </div>

                                <article class="post-body clearfix">
<!--                                    <div class="post-info clearfix">
                                        <div class="meta-container">
                                            <a href="<?php //echo site_url($carpeta.'/post/'.$post->post_slug) ?>">
                                                <h3><?php //echo $post->post_title ?></h3>
                                            </a>
                                        </div>
                                    </div>-->

                                  <?php                                   
                                   echo $post->post_abstract 
                                  ?>


                                </article>
                                <a  href="<?php echo site_url('/post/'.$post->post_slug) ?> " class="read-more">Ver Publicación</a>
                            </li>
                                
                          <?php }

                          echo $paginacion;
                          ?>

                        </ul>

                    
                    
                    
                        <div class="col-md-4 content-blog">
                            <ul class="aside-widgets">
                                
                                
                                
                                <!-- CATEGORIAS -->
                               
                                <li class="widget widget_categories">
                                    <?php echo "<br><br><br>"; ?>
                                    <h5>CATEGORIAS</h5>

                                    <ul>
                                    <?php foreach ($categories_post as $categoria) { ?>
                                        <li><a href="<?php echo site_url('/cat_blog/'.$categoria->post_category_slug) ?>"><?php echo $categoria->post_category_name ?></a></li>
                                    <?php } ?>                                      
                                    </ul>
                                </li>
                                <!-- ETIQUETAS -->    
                                <li class="widget widget_tag_cloud">
                                     <?php echo "<br><br><br>"; ?>
                                    <h5>ETIQUETAS</h5>

                                    <div class="tagcloud">
                                      <?php foreach ($tags as $tag) { ?>
                                        <a class="tag" href="<?php echo site_url('/tag/'.$tag->tag_slug) ?>"><?php echo $tag->tag_name ?></a>
                                      <?php } ?>                                        
                                    </div>
                                </li>
                                <!-- ÚLTIMAS PUBLICACIONES -->
                                <li class="widget pi_recent_posts">
                                   <?php echo "<br><br><br>"; ?>
                                    <h5>ÚLTIMAS PUBLICACIONES</h5>
                                    <ul>
                                      <?php foreach ($last_posts as $post) { ?>

                                          <li>
                                            <!--<div class="post-media">
                                                <a href="#">
                                                    <img style="max-width:30%; float:left;" src="<?php //echo base_url(); ?>assets/upload/files/blog/<?php //echo $post->post_image ?>" alt=""/>                                                    
                                                </a>
                                            </div>-->

                                            <div class="post-info">
                                                <div class="post">
                                                    <h5>
                                                      <a href="<?php echo site_url('/post/'.$post->post_slug) ?>"><?php echo $post->post_title ?></a>
                                                    </h5>
                                                    <!--<span class="authot"><a href="<?php //echo site_url($carpeta.'/post/'.$post->post_slug) ?>"><?php //echo $post->post_author ?></a></span>-->
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                        </li>

                                    <?php  } ?>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </section>
