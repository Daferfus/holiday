<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Subscripción</title>
        <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/registro_login/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/registro_login/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Asap|Patua+One" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    </head>

    <body class="container">

        <header class=row">
            <h1>Seleccione su plan de subscripción</h1>
        </header>

        <div id="pagewrap">

            <form class="row justify-content-center" id="Reserva" action="<?php echo site_url('backoffice/insertar_tipoPago') ?>" method="post">

                <section class="col-md-6 col-lg-4 col-xl-4" id="content">
                    <p class="titulo">Pago por Reserva</p>
                    <p class="precio">0€</p><p class="txt_1">Ningún pago por adelantado</p><p class="txt_2">Es gratis, pague sólo una comisión del 8% por reserva*</p>

                    <a href="<?php echo site_url('backoffice/season') ?>">
                        <input type="submit" id="0" name="Pago_Reserva" value="Continuar">
                    </a>
                </section>


                <aside class="col-md-6 col-lg-4 col-xl-4" id="sidebar" >
                    <p class="titulo">Suscripción Anual</p><p class="precio">229€</p><p class="txt_1">Pago fijo anual</p><p class="txt_2">Tarifa plana con número ilimitado de reservas sin comisión</p>

                    <a href="<?php echo site_url('backoffice/season') ?>">
                        <input type="submit" id="1" name="Pago_Anual" value="Continuar">
                    </a>
                </aside>

            </form>
        </div>
    </body>
</html>
