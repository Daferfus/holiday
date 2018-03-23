<!DOCTYPE html>
<html lang="es">
  <head>
      <title>Calendario codeigniter</title>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="<?=base_url()?>assets/backoffice/css/estilos.css" />
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/pepper-grinder/jquery-ui.css" />
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>   
      <script type="text/javascript" src="<?=base_url()?>assets/backoffice/js/funciones.js"></script>
  </head>

  <body>
    <?=$calendario?>
    <input type="hidden" value="<?=$this->uri->segment(3)?>" class="year" />
    <input type="hidden" value="<?=$this->uri->segment(4)?>" class="month" />
    <div id="midiv"></div>
  </body>
</html>
