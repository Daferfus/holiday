<div class="container" >
   <?php                          
    
	if (!empty($posts))	
    foreach ($posts as $post) { ?>
 
     
	<div class="item flights gal-item col-mob-12 col-xs-12 col-sm-12" id="post">
	
    <h1 align="center" class="color-naranja"> <?php 
	
	
	echo $post->post_title ?> </h1><br><br>
  <!--  <img id="img-treballadors" src="<?php echo base_url('assets/webapp'); ?>/img/personas-trabajando.jpg" width="720px" height="450px"></img> -->
    
	 
        <?php 
		echo "<br><div align='left'>";
		echo $post->post_body;
		echo "</div>";

		?>

    

</div>
	<?php 				   } ?>

</div>
