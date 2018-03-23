<?php 

if (empty($css_files)) $css_files=array();
foreach ($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php 

if (empty($js_files)) $js_files=array();
foreach ($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
    
<style type='text/css'>
    body
    {
        font-family: Arial;
        font-size: 14px;
        /*background: #E8FFFD;*/
       
    }
    a {
        color: blue;
        text-decoration: none;
        font-size: 14px;
    }
    a:hover
    {
        text-decoration: underline;
    }

</style>

</head>
<body>
    <!--sidebar start-->
    <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li class="active">
                      <a class="" href='<?php echo site_url('index') ?>'>
                          <i class="icon_house_alt"></i>
                          <span>Inicio</span>
                      </a>
                  </li>
				  <li class="sub-menu">
                      <a href='<?php echo site_url('backoffice/cal') ?>' class="">
                          <i class="icon_document_alt"></i>
                          <span>Calendario</span>
                         
                      </a>
                      
                  </li>
                  <li class="sub-menu">
                      <a href='<?php echo site_url('backoffice/images') ?>' class="">
                          <i class="icon_image"></i>
                          <span>Fotos</span>
                          
                      </a>
                      
                  </li>
                  <li class="sub-menu">
                      <a href='<?php echo site_url('backoffice/location') ?>' class="">
                          <i class="icon_pushpin_alt"></i>
                          <span>Localización</span>
                        
                      </a>
                     
                  </li>
                  <li class="sub-menu">
                      <a href='<?php echo site_url('backoffice/ubicacion') ?>' class="">
                          <i class="icon_pin_alt"></i>
                          <span>Ubicación</span>
                         
                      </a>
                      
                  </li>       
                  <li class="sub-menu">
                      <a href='<?php echo site_url('backoffice/description') ?>' class="">
                          <i class="icon_pencil-edit"></i>
                          <span>Descripción</span>
                         
                      </a>
                      
                  </li>
                  <li>
                      <a class="" href='<?php echo site_url('backoffice/season') ?>'>
                          <i class="icon_creditcard"></i>
                          <span>Tarifas</span>
                      </a>
                  </li>
                  <li>                     
                      <a class="" href='<?php echo site_url('backoffice/reservas') ?>'>
                          <i class="icon_paperclip"></i>
                          <span>Reservas</span>
                      </a>
                  </li>
                             
                  <li class="sub-menu">
                      <a href='<?php echo site_url('backoffice/datos_propietarios') ?>' class="">
                          <!--<i class="icon_contacts_alt"></i>-->
                           <i class="icon_profile"></i>
                          <span>Datos Personales</span>
                          </a>
                      
                  </li>
                  
                  <li class="sub-menu">
                      <a href='<?php echo site_url('backoffice/logout') ?>' class="">
                          <i class="icon_close_alt"></i>
                          <span>Salir</span>
                          </a>
                      
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">            

            <?php
            $user_id = $this->session->userData("user_id");
            if (empty($user_id)) {
                redirect("backoffice");
            }

            $property_id_active = $this->session->property_id;
//echo "VARIABLE DE SESION PROPIEDAD ACTIVA:".$this->session->property_id."<br>";
            if (!empty($property_id_active)) {
                //$property_id = $this->session->property_id;
                echo "<center><h1>PROPIEDAD ACTIVA:</h1><center>";
//    if(!empty($properties)){
//    foreach ($properties as $property) {
//        echo "<h2>REFERENCIA: $property->property_id : $property->property_type , $property->text_title</h2>";
//        echo "<br>";
                redirect("backoffice/description");

//    }
            } else {
                echo "<h1>Activa propiedad a editar</h1>";
                //echo "<br>Propiedades";
                //print_r($properties);
                //echo "Fin de Propiedades<br>";
               if (!empty($properties)) 
                foreach ($properties as $property) {
                    echo "<a href = '" . site_url('backoffice/active_property/' . $property->property_id) . "'><h2>REFERENCIA: $property->property_id : $property->property_type , $property->text_title</h2></a>";
                    echo "<br>";
                }

//        redirect("backoffice/description");
            }
//}
//}
            ?>





           


                <div id="grocery-crud">
                    <?php
                    if (!empty($html))
                        echo $html;
                    else
                        echo $output;
                    ?>
                </div>

            
        </section>
    </section>
</body>

