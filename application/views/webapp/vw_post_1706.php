<?php
if (!empty($posts))
    foreach ($posts as $post) {
        ?>
      <!--  <div class="vertical-align">
            <div class="container">
-->
                <div class="container">
                    
                    <br><br><br><br><br><br>

                    <h2 class="color-naranja"> <?php echo $post->post_title ?> </h2><br><br>

                    <?php
                    echo "<br><div align='left'>";
                    echo $post->post_body;
                    echo "</div>";
                    ?>



                </div>
   <!--         </div>
        </div>  -->
    <?php } ?>

