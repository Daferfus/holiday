<!DOCTYPE html>
 
<html lang="es">
 
<head>
    <title>Calendario codeigniter</title>
    <meta charset="utf-8" />
    <style type="text/css">
    	table{
    		padding: 4px;
    		border: 1px solid #111;
    		margin: 10px 0px 0px 20px;
    		height: 250px;
    		float: left;
    	}
    </style>
</head>
 
<body>
	<?php
	foreach($calendar as $cal)
	{
		echo $cal;
	}
	?>
</body>
</html>

