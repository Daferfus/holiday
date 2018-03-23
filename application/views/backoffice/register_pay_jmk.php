<!DOCTYPE html>
<html>
    <head>
        <title>Método de pago</title>
        <style>
            #div1{
                float:left;
                width:300px;
                border:0px ;
                margin: 0 auto;
                height:50px;
                text-align:center;
            }
            #div2{
                width:700px;
                margin: 0 auto;
                height:50px;
                text-align:center;
            }
            #contenedor{
                background-image: url(https://holidayapartment.online/assets/webapp/img/imatgeshome/alquiler-vacacional-mallorca.jpg);
                width: 100%;
                position: absolute;
            }
            #contenedorRsv{
                position: relative;
                display:table-cell;
                vertical-align:middle;
            }
            #transparencia{
                /*border:10px solid #000000;*/
                float: left;
                padding: 10px;
                color: white;
                margin: 20px;
                width: 400px;                
                height:auto;
                text-align:center;
                background-color: black;
                opacity:0.6;
            }
            #calculadora{
                text-align: center;
                background-color: white;
                padding: 10px;
            }
            #dentrocalculadora{
                text-align: left;
            }
        </style>
        <script>
            function calculaPrecio(){
                var formObj=document.getElementById("Calculadora");
                var precio=document.getElementById("precio").value;
                var dias=document.getElementById("dias").value;
                
                var precio1=parseFloat(precio);
                var dias1=parseFloat(dias);
                var final;
                if(precio===""){
                    document.getElementById("requerido1").style.display="block";
                }
                else{
                    document.getElementById("requerido1").style.display="none";
                }
                if(dias===""){
                    document.getElementById("requerido2").style.display="block";
                }
                else{
                    document.getElementById("requerido2").style.display="none";
                }
                
                if(precio!=""&&dias!=""){
                    final=((precio1*0.08))*dias1;
                    document.getElementById("total1").innerHTML=final+"€<font size='3'>/año</font>";
                }
            }
            
        </script>
    </head>
    <body>

        <div id="contenedor">
            <div id="div1"><font size="5">Holiday Apartment</font></div>
            <div id="div1" style="float:right; text-align:left">¿Necesita ayuda? Envíenos<br> email o llámenos 900 838 426</div><br><br><br>
            <div id="div2" style="text-align:left"><font size="6">Seleccione su plan de suscripción</font></div><br><br>
            <div id="contenedorRsv">
                <form id="Reserva" action="<?php echo site_url('backoffice/insertar_tipoPago') ?>" method="post">
                    <div id="transparencia">
                        <font size="6">Pago por Reserva</font><br><br><font size="20">0<sup><sup>€</sup></sup></font><br>Ningún pago por adelantado<br><br>Es gratis, pague sólo una comisión del 8% por reserva*<br><br><br><br><br>
                        <input type="submit" id="0" name="Pago_Reserva" value="Continuar"style='width:350px; height:55px;background: orange'>
                    </div>
                    <div id="transparencia" style="float:right">
                        <font size="6">Suscripción Anual</font><br><br><font size="20">229<sup><sup>€</sup></sup></font><br>Pago fijo anual<br><br>Tarifa plana con número ilimitado de reservas sin comisión<br><br><br><br><br>
                        <input type="submit" id="1" name="Pago_Anual" value="Continuar"style='width:350px; height:55px;background: orange'>
                    </div>
                </form>
            </div>
            <div>
                <div id="calculadora">
                    <h2  style="text-align:center;"> <font color="blue">Decida usted mismo utilizando nuestra calculadora de comparación</font></h2><br><br><br><br>
                    <div style="float:right;text-align:left">
                        Coste estimado de pago por reserva<br> <div style="font-size:25pt;" id="total1"></div><br><hr>
                        Coste de Suscripción anual <br><font size="6">229€</font>/año<br>
                    </div>
                    <form id="Calculadora">
                        ¿Cuál es el precio por día de su propiedad?<br>
                        <input type="text" id="precio" placeholder="€ 50 por día">
                        <small style="color:red; display:none" id="requerido1"> Dato requerido</small>
                        <br><br>¿Cuántos días al año alquilará su propiedad?<br>
                        <input type="text" id="dias" placeholder="60 días">
                        <small style="color:red; display:none" id="requerido2"> Dato requerido</small><br><br>
                        
                        <input type="button" value="calcular"style='width:100px; height:35px; color: white ;background: blue' onclick="calculaPrecio()">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>