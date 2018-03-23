
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
    <meta charset="utf-8">
    <title>HolidayApartment - Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <div>
         <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
       </div> 
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>../favicon/mifavicon.png">
    <link href="<?php echo base_url(); ?>assets/backoffice/styles/menu.css"
      rel="stylesheet" type="text/css">
      
    <!--<style type="text/css">
    </style>-->
    <!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
		<div class="btn-group btn-group-justified">
            <div class="btn-group">
                <a href='<?php echo site_url('backoffice/users') ?>'>
                <button type="button" class="btn btn-nav">
                    <span class="glyphicon glyphicon-user"></span>
                    <p>Usuarios</p></a>
                </button>
            </div>
            <div class="btn-group">
                <a href='<?php echo site_url('backoffice/roles') ?>'>
                <button type="button" class="btn btn-nav">
                    <span class="glyphicon glyphicon-briefcase"></span>
    			    <p>Roles</p></a>
                </button>
            </div>
            <div class="btn-group">
                <a href='<?php echo site_url('backoffice/newsletter') ?>'
                <button type="button" class="btn btn-nav">
                    <span class="glyphicon glyphicon-file"></span>
    			    <p>Boletines</p></a>
                </button>
            </div>
            <div class="btn-group">
                <a href='<?php echo site_url('backoffice/category') ?>'>
                <button type="button" class="btn btn-nav">
                    <span class="glyphicon glyphicon-paperclip"></span>
    			    <p>Categorias</p></a>
                </button>
            </div>
            <div class="btn-group">
                <a href='<?php echo site_url('backoffice/tag') ?>'>
                <button type="button" class="btn btn-nav">
                    <span class="glyphicon glyphicon-tags"></span>
    			    <p>Etiquetas</p></a>
                </button>
            </div>
            <div class="btn-group">
                <a href='<?php echo site_url('backoffice/post') ?>'>
                <button type="button" class="btn btn-nav">
                    <span class="glyphicon glyphicon-list-alt"></span>
    			    <p>Posts</p></a>
                </button>
            </div>
            <div class="btn-group">
                <a href='<?php echo site_url('backoffice/logout') ?>'>
                <button type="button" class="btn btn-nav">
                    <span class="glyphicon glyphicon-off"></span>
    			    <p>Salir</p></a>
                </button>
            </div>
        </div>
	</div>
</div>

<script type="text/javascript">
var activeEl = 2;
$(function() {
    var items = $('.btn-nav');
    $( items[activeEl] ).addClass('active');
    $( ".btn-nav" ).click(function() {
        $( items[activeEl] ).removeClass('active');
        $( this ).addClass('active');
        activeEl = $( ".btn-nav" ).index( this );
    });
});
</script>

    <div style='height:20px;'></div>  
        <div>
            <?php echo $output; ?>
        </div>
</body>
</html>
