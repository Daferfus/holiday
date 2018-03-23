<?php foreach ($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach ($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
    body
    {
        font-family: Arial;
        font-size: 14px;
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
    <div>


    </div>
    <div>

        <a href='<?php echo site_url('backoffice/location') ?>'>Localización</a> |
        <a href='<?php echo site_url('backoffice/ubicacion') ?>'>Ubicación</a> |
        <a href='<?php echo site_url('backoffice/description') ?>'>Descripción</a> |
        <a href='<?php echo site_url('backoffice/images') ?>'>Fotos</a> |
        <a href='<?php echo site_url('backoffice/season') ?>'>Tarifas</a> |
        <a href='<?php echo site_url('backoffice/cal') ?>'>Calendario</a> |
        <a href='<?php echo site_url('backoffice/reservas') ?>'>Reservas</a> |
        <a href='<?php echo site_url('backoffice/datos_propietarios') ?>'>Datos personales</a> |
        <a href='<?php echo site_url('backoffice/logout') ?>'>Salir</a> 

    </div>
    <div style='height:20px;'></div>  


    <div>
        <?php
        if (!empty($html))
            echo $html;
        else
            echo $output;
        ?>
    </div>
</body>
</html>
