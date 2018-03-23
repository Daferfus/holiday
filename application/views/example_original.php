<?php
//como leer una variable de sesion
if (empty($this->session->userData("user_id"))) {

    redirect("backoffice");
} else {


    $user = $this->session->userData("user_nom");
    /*echo "Benvingut $user";*/
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/styles/menu.css" /> 
       
      <body>

        <div id="mimenu">
            <!--menus-->
            <ul id="menu-bar">       

                <li><a href='<?php echo site_url('backoffice/users') ?>'><span class="icon-users"></span>Usuarios</a></li>
                
                <li><a href='<?php echo site_url('backoffice/roles') ?>'><span class="icon-tree"></span>Roles</a></li>
                <li><a href='<?php echo site_url('backoffice/newsletter') ?>'><span class="icon-file-text2"></span>Boletines</a></li>
                <li><a href='<?php echo site_url('backoffice/category') ?>'><span class="icon-folder-open"></span>Categorias</a></li>
                <li><a href='<?php echo site_url('backoffice/tag') ?>'><span class="icon-price-tags"></span>Etiquetas</a></li>
                <li><a href='<?php echo site_url('backoffice/post') ?>'><span class="icon-newspaper"></span>Posts</a></li>
                <li><a href='<?php echo site_url('backoffice/logout') ?>'>Salir</a></li>
                
            </ul>
            
            <span class="username"><h1>Benvingut</h1> <h3><?php echo $_SESSION['user_nom'];?></h3></span>
                 
             
            

        </div>
          
          
          
             <div id="mimenuMovil">
            <!--menus-->
            <!--<ul id="menu-barMovil"> 
                
                <li><a class="entypo-menu" href="#"></a> <span class="menu">Menu</span></li>
                <li><a href='<?php echo site_url('backoffice/users') ?>'><span class="icon-users"></span>Usuarios</a></li>
                <li><a href='<?php echo site_url('backoffice/roles') ?>'><span class="icon-tree"></span>Roles</a></li>
                <li><a href='<?php echo site_url('backoffice/newsletter') ?>'><span class="icon-file-text2"></span>Boletines</a></li>
                <li><a href='<?php echo site_url('backoffice/category') ?>'><span class="icon-folder-open"></span>Categorias</a></li>
                <li><a href='<?php echo site_url('backoffice/tag') ?>'><span class="icon-price-tags"></span>Etiquetas</a></li>
                <li><a href='<?php echo site_url('backoffice/post') ?>'><span class="icon-newspaper"></span>Posts</a></li>
                <li><a href='<?php echo site_url('backoffice/logout') ?>'>Salir</a></li>
                
            </ul>-->
            <ul id="menu-barMovil">
        <li>
            <a class="entypo-menu" href="#"></a> <span class="menu">Página Inicio</span>
        </li>

        <li>
            <a class="entypo-calendar" href="#"></a> <span>Calendario</span>
        </li>

        <li>
            <a class="entypo-picture" href="#"></a> <span>Fotos</span>
        </li>

        <li>
            <a class="entypo-direction" href="#"></a> <span>Localización</span>
        </li>

        <li>
            <a class="entypo-location" href="#"></a> <span>Ubicación</span>
        </li>

        <li>
            <a class="entypo-newspaper" href="#"></a> <span>Descripción</span>
        </li>

        <li>
            <a class="entypo-credit-card" href="#"></a> <span>Tarifas</span>
        </li>
        <li>
            <a class="entypo-attach" href="#"></a> <span>Reservas</span>
        </li>
        <li>
            <a class="entypo-user" href="#"></a> <span>Datos Personales</span>
        </li>
        <li>
            <a class="entypo-logout" href="#"></a> <span>Salir</span>
        </li>
    </ul>
            
            
            <span class="username"><h1>Benvingut</h1> <h3><?php echo $_SESSION['user_nom'];?></h3></span>
                 
           
            
            

        </div>

        <div style='height:20px;'></div>  
        <div>
            <?php echo $output; ?>
        </div>


    </body>
</html>

