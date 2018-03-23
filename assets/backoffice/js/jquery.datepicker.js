jQuery(function ($) {
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '&#x3c;Ant',
                    nextText: 'Sig&#x3e;',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                        'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    numberOfMonths: 3, //enseñar tres meses
                    minDate: 0, //ocultar dias anteriores
                    isRTL: false,
                    showMonthAfterYear: false,
                    changeMonth: true, // despegable cambiar meses
                    changeYear: true, //despegable cambiar años
                    yearRange: "2017:2020", //rangos de años que queremos que aparezcan
                    showWeek: true, //semana del año
                    showButtonPanel: true, //posicionarnos en la fecha actual
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['es']);

            });

            $(document).ready(function () {
                $("#datepicker").datepicker();
            });
            
            
             $(function () {
                $("#from").datepicker({
                    onClose: function (selectedDate) {
                        $("#to").datepicker("option", "minDate", selectedDate);


                    }
                });
                $("#to").datepicker({
                    onClose: function (selectedDate) {
                        $("#from").datepicker("option", "maxDate", selectedDate);
                    }
                });
                
             });
             
             function enviar()
	{
		// Esta es la variable que vamos a pasar
		var miVariableJS=$("#from").val();
                var miVariableJS=$("#to").val();
 
		// Enviamos la variable de javascript a archivo.php
		$.post("archivo.php",{"from":miVariableJS},function(respuesta){
			alert(respuesta);
		});
                
                $.post("archivo.php",{"to":miVariableJS},function(respuesta){
			alert(respuesta);
		});
          
         

                         
                
                
	}

