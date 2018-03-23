<div class="widget-foot">
 <!-- Footer goes here -->
                  </div>
                </div>
              </div>
              
            </div>
                        
          </div> 
              <!-- project team & activity end -->

          </section>
          <div class="text-right">
          <div class="credits">
                
                <!--<a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
            </div>
        </div>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

<!--     javascripts -->
    <!--<script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.js"></script>--> 
    <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery-ui-1.10.4.min.js"></script>
     
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/backoffice/js/jquery-ui-1.9.2.custom.min.js"></script>
      <!--bootstrap -->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/bootstrap.min.js"></script>
      <!--nice scroll -->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.nicescroll.js" type="text/javascript"></script>
      <!--charts scripts -->
     
    <script src="<?php echo base_url(); ?>assets/backoffice/assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.sparkline.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url(); ?>assets/backoffice/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/owl.carousel.js" ></script>
     <!--jQuery full calendar -->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="<?php echo base_url(); ?>assets/backoffice/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/calendar-custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.rateit.min.js"></script>
     <!--custom select -->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.customSelect.min.js" ></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/scripts.js"></script>
     
    <script src="<?php echo base_url(); ?>assets/backoffice/js/sparkline-chart.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/easy-pie-chart.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/xcharts.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.autosize.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.placeholder.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/gdp-data.js"></script>	
	<script src="<?php echo base_url(); ?>assets/backoffice/js/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/sparklines.js"></script>	
	<script src="<?php echo base_url(); ?>assets/backoffice/js/charts.js"></script>
	<script src="<?php echo base_url(); ?>assets/backoffice/js/jquery.slimscroll.min.js"></script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});

</script>
  <footer>
    <p>&copy; 2017 HolidayApartment.online<p>
</footer>

  </body>
</html>

