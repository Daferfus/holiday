<?php
if (!empty($posts)) {
    ?>    
    	<style>#botones-para-compartir{text-align:center;}.likedino:hover, .facebooko:hover, .twittero:hover, .googleo:hover,.instagram:hover {-webkit-transform: rotate(360deg);-moz-transform: rotate(360deg);transform: rotate(360deg);transition:all .3s ease-out;-moz-transition: all .5s;-webkit-transition: all .5s;-o-transition: all .5s;}.likedino, .facebooko, .twittero, .googleo, .instagram {transition:all .3s ease-out;-moz-transition: all .5s;-webkit-transition: all .5s;-o-transition: all .5s;margin-left:10px; /* espacio entre cada boton */}
    	
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
    </script>  ?>
    <?php
    foreach ($posts as $post) {
        ?>
        <!--  <div class="vertical-align">
              <div class="container">
        -->
        <div class="container">

            <br><br><br><br><br><br>
        <!--    <div id="container">  -->

                <div id="botones-para-compartir">
			<a href="javascript:void(0);" onclick="window.open(&quot;https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fholidayapartment.online%2F&amp;src=sdkpreparse&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Facebook"><img alt="compartir en facebook" class="facebooko" height="40" src="http://1.bp.blogspot.com/-rwK-4X3iLjc/ViFsOclr9NI/AAAAAAAABwc/ocBw9cxRK2M/s1600/facebook-long.png" title="compartir en facebook" width="40" /></a>

<a href="javascript:void(0);" onclick="window.open(&quot;https://plus.google.com/share?url=https://holidayapartment.online/blog&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Google+"><img alt="compartir en google+" class="googleo" height="40" src="http://1.bp.blogspot.com/-SKqPlZHzLgg/ViFsOt7HbeI/AAAAAAAABw0/bQQhWqgEpWM/s1600/google-long.png" title="compartir en google+" width="40" /></a>

<a href="javascript:void(0);" onclick="window.open(&quot;https://www.instagram.com/holidayapartment.online/?ref=badge&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Instagram"><img alt="Perfil Instagram" class="instagram" height="40" src="http://s2.subirimagenes.com/otros/previo/thump_96731511484650504874585.jpg" title="Instagram" width="40" /></a>

<a href="javascript:void(0);" onclick="window.open(&quot;https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fholidayapartment.online%2Fblog&ref_src=twsrc%5Etfw&text=Alquiler%20vacacional%20-%20Buscador%20de%20alojamientos%20para%20vacaciones&tw_p=tweetbutton&url=https%3A%2F%2Fholidayapartment.online%2Fblog&quot;,&quot;gplusshare&quot;,&quot;toolbar=0,status=0,width=548,height=325&quot;);" rel="nofollow" title="Compartir en Google+"><img alt="compartir en twitter" class="twittero" height="40" src="http://4.bp.blogspot.com/-gqVyoE8cVME/ViFsO009lbI/AAAAAAAABwo/1oK8cUnY36Q/s1600/twitter-long.png" title="compartir en twitter" width="40" /></a>
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
    <?php
    }
}
?>

