<?php
if (!empty($posts)) {
    ?>    

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
    </script>  ?>
    <?php
    foreach ($posts as $post) {
        ?>
        <!--  <div class="vertical-align">
              <div class="container">
        -->
        <div class="container">

            <br><br><br><br><br><br>
            <div id="container">
                <div class="fb-share-button" data-href="https://holidayapartment.online" data-layout="button" data-mobile-iframe="true">
                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fholidayapartment.online%2F&amp;src=sdkpreparse">Compartir</a>


                </div>

                <div><a href="https://twitter.com/share" class="twitter-share-button" data-dnt="true">Tweet</a> <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + '://platform.twitter.com/widgets.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'twitter-wjs');</script>
                </div>


                <!-- Inserta esta etiqueta donde quieras que aparezca Botón Compartir. -->
                <div class="g-plus" data-action="share"></div>
            </div>

            <h1 class="color-naranja"> <?php echo $post->post_title ?> </h1><br><br>

            <?php
            echo "<br><div align='left'>";
            echo $post->post_body;
            echo "</div>";
            ?>



        </div>
        <!--         </div>
             </div>  -->
    <?php }
}
?>

