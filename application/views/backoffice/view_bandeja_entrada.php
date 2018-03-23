<!DOCTYPE HTML>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <script src="<?php echo base_url(); ?>assets/backoffice/js/jquery-1.8.3.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/backoffice/css/view_BandejaEntrada.css" rel="stylesheet">
    
</head>





<body>
    <div class="container">  
        <!--        <div class="table-responsive"> -->

        <?php if(!empty($messages)){ ?>
        <table class="table-responsive">
            <?php foreach ($messages as $message) { ?>


                <tr>

                    <td class="fecha"><span class="time"><?php echo $message->fecha; ?></span></td>
                     <?php 
                                   /*$message->mail_body = substr($message->mail_body, 3);*/
                                   $message->mail_body = substr($message->mail_body, 0,2);
                                   ?>  
                    <td><span class="subject"><b>Asunto:</b><?php echo $message->mail_subject; ?></span></td>
                    <td><span class="to"><b>De:</b><?php echo $message->mail_to; ?></span></td>
                    <td><a href="<?php echo site_url('backoffice/EditMessageById/' . $message->mail_id); ?>"><input type="submit"  class="responder" id="responder"  value="Responder" /></a></td>
                     
                </tr>


            <?php } ?>
        </table>
       
       <?php } else {?>
        
        <?php redirect ('backoffice/read_mail_vacio/'); ?>
        
        
       <?php } ?>
        <!--</div>-->
    </div>





</body>



