<?php
//como leer una variable de sesion
if (empty($this->session->userData("user_id"))) {

    redirect("backoffice");
} else {


    $user = $this->session->userData("user_nom");
    /* echo "Benvingut $user"; */
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
        <meta name="author" content="GeeksLabs">
        <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/backoffice/img/favicon.png">

        <title>Bienvenido a holiday apartmaent</title>

        <!-- Bootstrap CSS -->    
        <link href="<?php echo base_url(); ?>assets/backoffice/css/bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="<?php echo base_url(); ?>assets/backoffice/css/bootstrap-theme.css" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="<?php echo base_url(); ?>assets/backoffice/css/elegant-icons-style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/backoffice/css/font-awesome.min.css" rel="stylesheet" />    
        <!-- full calendar css-->
        <link href="<?php echo base_url(); ?>assets/backoffice/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/backoffice/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
        <!-- easy pie chart-->
        <link href="<?php echo base_url(); ?>assets/backoffice/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <!-- owl carousel -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/css/owl.carousel.css" type="text/css">
        <link href="<?php echo base_url(); ?>assets/backoffice/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/css/fullcalendar.css">
        <link href="<?php echo base_url(); ?>assets/backoffice/css/widgets.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backoffice/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backoffice/css/style-responsive.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/backoffice/css/xcharts.min.css" rel=" stylesheet">	
        <link href="<?php echo base_url(); ?>assets/backoffice/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery-1.8.3.min.js"></script>
    </head>

    <body>
        <!-- container section start -->
        <section id="container" class="">


            <header class="header dark-bg">
                <div class="toggle-nav">
                    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
                </div>

                <!--logo start-->
                <a href="index.html" class="logo">Holiday<img src="<?php echo base_url(); ?>../../../../assets/backoffice/img/logo1.png"><span class="lite">Apartment</span></a>
                <!--logo end-->

                <div class="nav search-row" id="top_menu">
                    <!--  search form start -->
                    <ul class="nav top-menu">                    
                        <li>
                            <form class="navbar-form">
                                <input class="form-control" placeholder="Search" type="text">
                            </form>
                        </li>                    
                    </ul>
                    <!--  search form end -->                
                </div>

                <div class="top-nav notification-row">                
                    <!-- notificatoin dropdown start-->
                    <ul class="nav pull-right top-menu">

                        <!-- task notificatoin start -->
                        <li id="task_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-task-l"></i>
                                <span class="badge bg-important">6</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have 6 pending letter</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Design PSD </div>
                                            <div class="percent">90%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                <span class="sr-only">90% Complete (success)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">
                                                Project 1
                                            </div>
                                            <div class="percent">30%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                                <span class="sr-only">30% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Digital Marketing</div>
                                            <div class="percent">80%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Logo Designing</div>
                                            <div class="percent">78%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                                <span class="sr-only">78% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Mobile App</div>
                                            <div class="percent">50%</div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar"  role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                                <span class="sr-only">50% Complete</span>
                                            </div>
                                        </div>

                                    </a>
                                </li>
                                <li class="external">
                                    <a href="#">See All Tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- task notificatoin end -->
                        <!-- inbox notificatoin start-->
                        <li id="mail_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-envelope-l"></i>
                                <span class="badge bg-important">5</span>
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue"></p>
                                </li>
                                <!--<li>
                                 <a href="#">
                                        <!--<?php
                                        /* $gravatar_link = 'http://www.gravatar.com/avatar/' . md5('juanjocamps@hotmail.com') . '?s=64';
                                          echo '<img src="' . $gravatar_link . '" />'; */
                                        ?>-->
                                  <!--      <span class="photo"><img alt="avatar" src="<?php echo base_url() ?>assets/backoffice/img/avatar-mini.jpg"></span>
                                        -->
                                        <!--<span class="photo"><img alt="avatar" src="$gravatar_link"></span>
                                        <span class="subject">
                                            <span class="from">Greg  Martin</span>
                                            <span class="time">1 min</span>
                                        </span>
                                        <span class="message">
                                            I really like this admin panel.
                                        </span>
                                    </a>-->
                                <!--</li>-->


   <!-- <a href='<?php echo site_url('backoffice/read_mail'. $message->mail_id); ?>'>  -->
                          <?php foreach ($messages as $message) { ?>
                                <li>
                                    <a href='<?php echo site_url('backoffice/'.$message->mail_id);?>'><span class="time"><?php echo $message->mail_date; ?></span>
                                   <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                   <span class="subject"><b>Asunto:</b><?php echo $message->mail_subject; ?></span>
                                   <span class="to"><b>De:</b><?php echo $message->mail_to; ?></span>
                                   <span class="message"><b>Mensaje:</b><br><br>
                                   <?php 
                                   /*$message->mail_body = substr($message->mail_body, 3);*/
                                   $message->mail_body = substr($message->mail_body, 0,20);
                                   ?>  
                                       
                                   <?php echo $message->mail_body; ?> <p id="mas"><a class="boton_personalizado" href='<?php echo site_url('backoffice/vermas_mail/'.$message->mail_id);?>'>Ver Más.....</a></p></span>
                                   
                                  
                                  
                                        </a>
                                   
                              <!-- <span class="<?php echo $message->mail_body; ?> "></span> -->
                             <!--  <span class="from"><?php echo $message->mail_from; ?></span>
                                   -->
                                  
                                   
                                                                   
                                    </li>

                            <?php } ?>
                                <!-- </a> -->
                                

                                <li>
                                    <a href="#">See all messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- inbox notificatoin end -->
                        <!-- alert notification start-->
                        <li id="alert_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <i class="icon-bell-l"></i>
                                <span class="badge bg-important">7</span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have 4 new notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-primary"><i class="icon_profile"></i></span> 
                                        Friend Request
                                        <span class="small italic pull-right">5 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-warning"><i class="icon_pin"></i></span>  
                                        John location.
                                        <span class="small italic pull-right">50 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-danger"><i class="icon_book_alt"></i></span> 
                                        Project 3 Completed.
                                        <span class="small italic pull-right">1 hr</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-success"><i class="icon_like"></i></span> 
                                        Mick appreciated your work.
                                        <span class="small italic pull-right"> Today</span>
                                    </a>
                                </li>                            
                                <li>
                                    <a href="#">See all notifications</a>
                                </li>
                            </ul>
                        </li>
                        <!-- alert notification end-->
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="profile-ava">
                                    <img alt="" src="<?php echo base_url(); ?>../../../../assets/backoffice/images/avatar/1.jpg">
                                </span>
                                <span class="username"><?php echo $_SESSION['user_nom']; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                               <!--<li class="eborder-top">
                                    <a href="#"><i class="icon_profile"></i> Mi Perfil</a>
                                </li>-->
                                <li class="eborder-top">
                                    <a href="#"><i class="icon_profile"></i> Cuenta</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('backoffice/cambiar_pass_user'); ?>"><i class="icon_key_alt"></i> Cambiar Contraseña</a>
                                </li>
                                <li>
<!--                                    <a href="<?php echo site_url('backoffice/read_mail'); ?>"><i class="icon_mail_alt"></i> Bandeja de entrada</a>-->
                                    <a href="<?php echo site_url('backoffice/read_mail_bandejaEntrada'); ?>"><i class="icon_mail_alt"></i> Bandeja de entrada</a>
                                    
                                    
                                </li>
                                <li>
                                    <a href="#"><i class="icon_clock_alt"></i> Cronograma</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_chat_alt"></i> Chats</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_star_alt"></i> Favoritos</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('backoffice/reservas') ?>"><i class="icon_paperclip"></i> Reservas</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo base_url(); ?>backoffice"><i class="icon_close_alt"></i> Salir</a>
                                </li>

                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!-- notificatoin dropdown end-->
                </div>
            </header>      
            <!--header end-->