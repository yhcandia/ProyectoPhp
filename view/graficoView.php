<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" >
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Ejemplo PHP MySQLi POO MVC</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <title>.: GRAFICOS :.</title>
        <style>
            .container2 .panel {
                position: absolute;
                top: 20%;
                margin-left: 10%;
                width: 100%;
            }
            .principal{
                position:relative;
            }
            footer {
                padding-top:10px;
                width:100%;
                top: 150%;
                height:60px;
                position:absolute;
                bottom:0;
                background-color: white;
                border-top: solid 5px #404040;
            }
        </style>
        <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer",
            {
                    title:{
                            text: "Tipo de Persona",
                            fontSize: 20,
                            fontFamily: "arial black"
                    },
                    exportEnabled: true,
                    animationEnabled: true,
                    legend: {
                            verticalAlign: "bottom",
                            horizontalAlign: "center"
                    },
                    theme: "theme1",
                    data: [
                    {        
                            type: "pie",
                            indexLabelFontFamily: "Garamond",       
                            indexLabelFontSize: 20,
                            indexLabelFontWeight: "bold",
                            startAngle:0,
                            indexLabelFontColor: "MistyRose",       
                            indexLabelLineColor: "darkgrey", 
                            indexLabelPlacement: "inside", 
                            toolTipContent: "{name}: {y} cliente(s)",
                            showInLegend: true,
                            indexLabel: "#percent%", 
                            dataPoints: [
                                    {  y: <?php echo $numJuridica ?>, name: "Juridicas", legendMarkerType: "circle"},
                                    {  y:  <?php echo $numNatural ?>, name: "Naturales", legendMarkerType: "circle"}
                            ]
                    }
                    ]
            });
            var chart2 = new CanvasJS.Chart("chartContainer2",
            {
                title:{
                  text: "Atenciones",
                  fontSize: 20,
                  fontFamily: "arial black"
                },
                axisY: {			
			title: "Atenciones"		
		}, 
		axisX: {
			title: "Clientes"
		},
                exportEnabled: true,
                animationEnabled: true,              
                legend: {
                  verticalAlign: "bottom",
                  horizontalAlign: "center"
                },
                theme: "theme2",        
                data: [

                    {        
                      type: "column",        
                      toolTipContent: "{label}: {y} atenciones",
                      legendMarkerColor: "grey",
                      dataPoints: [  
                      <?php foreach($grafico2 as $row) { ?>
                        {y: <?php echo $row->cantidad; ?> , label: '<?php echo $row->nombre; ?>'},
                      <?php } ?>       
                      ]
                    }   
                ]
            });
            var chart3 = new CanvasJS.Chart("chartContainer3",
            {
                title:{
                  text: "Antiguedad en Meses",
                  fontSize: 20,
                  fontFamily: "arial black"
                },
                axisY: {			
			title: "Meses"		
		}, 
		axisX: {
			title: "Clientes"
		},
                exportEnabled: true,
                animationEnabled: true,              
                legend: {
                  verticalAlign: "bottom",
                  horizontalAlign: "center"
                },
                theme: "theme2",
                data: [

                    {        
                      type: "column",                        
                      legendMarkerColor: "grey",
                      toolTipContent: "{label}: {y} meses",
                      dataPoints: [  
                      <?php foreach($grafico3 as $row) {
                            $fecha = new DateTime($row->fecha_incorporacion);              
                            $fecha2 = new DateTime();              
                            $diferencia = $fecha->diff($fecha2);
                            $meses = ( $diferencia->y * 12 ) + $diferencia->m;                               
                          ?>
                        {y: <?php echo $meses; ?> , label: '<?php echo $row->nombre_completo; ?>'},
                      <?php } ?>       
                      ]
                    }   
                ]
            });
            var chart4 = new CanvasJS.Chart("chartContainer4",
            {
                title:{
                  text: "Atenciones por Abogado",
                  fontSize: 20,
                  fontFamily: "arial black"
                },
                axisY: {			
			title: "Atenciones"		
		}, 
		axisX: {
			title: "Abogados"
		},
                exportEnabled: true,
                animationEnabled: true,              
                legend: {
                  verticalAlign: "bottom",
                  horizontalAlign: "center"
                },
                theme: "theme2",        
                data: [

                    {        
                      type: "column",        
                      toolTipContent: "{label}: {y} atenciones",
                      legendMarkerColor: "grey",
                      dataPoints: [  
                      <?php foreach($grafico4 as $row) { ?>
                        {y: <?php echo $row->cantidad; ?> , label: '<?php echo $row->nombre; ?>'},
                      <?php } ?>       
                      ]
                    }   
                ]
            });
            
            var chart5 = new CanvasJS.Chart("chartContainer5",
            {
                    title:{
                            text: "Estados de Atenciones",
                            fontSize: 20,
                            fontFamily: "arial black"
                    },
                    exportEnabled: true,
                    animationEnabled: true,
                    legend: {
                            verticalAlign: "bottom",
                            horizontalAlign: "center"
                    },
                    theme: "theme1",
                    data: [
                    {        
                            type: "pie",
                            indexLabelFontFamily: "Garamond",       
                            indexLabelFontSize: 22,
                            indexLabelFontWeight: "bold",
                            startAngle:0,
                            indexLabelFontColor: "MistyRose",       
                            indexLabelLineColor: "darkgrey", 
                            indexLabelPlacement: "inside", 
                            toolTipContent: "{name}: {y} atenciones",
                            showInLegend: true,
                            indexLabel: "#percent%", 
                            dataPoints: [
                                    {  y: <?php echo $numRealizada ?>, name: "Realizada", legendMarkerType: "circle"},
                                    {  y: <?php echo $numAgendada ?>, name: "Agendada", legendMarkerType: "circle"},
                                    {  y: <?php echo $numConfirmada ?>, name: "Confirmada", legendMarkerType: "circle"},
                                    {  y: <?php echo $numPerdida ?>, name: "Perdida", legendMarkerType: "circle"},
                                    {  y: <?php echo $numAnulada ?>, name: "Anulada", legendMarkerType: "circle"}
                            ]
                    }
                    ]
            });
            var chart6 = new CanvasJS.Chart("chartContainer6",
            {
                title:{
                  text: "Atenciones",
                  fontSize: 20,
                  fontFamily: "arial black"
                },
                axisY: {			
			title: "Atenciones"		
		}, 
		axisX: {
			title: "Especialidades"
		},
                exportEnabled: true,
                animationEnabled: true,              
                legend: {
                  verticalAlign: "bottom",
                  horizontalAlign: "center"
                },
                theme: "theme2",        
                data: [

                    {        
                      type: "column",        
                      toolTipContent: "{label}: {y} atenciones",
                      legendMarkerColor: "grey",
                      dataPoints: [  
                      <?php foreach($grafico6 as $row) { ?>
                        {y: <?php echo $row->cantidad; ?> , label: '<?php echo $row->especialidad; ?>'},
                      <?php } ?>       
                      ]
                    }   
                ]
            });
            
            chart.render();
            chart2.render();
            chart3.render();
            chart4.render();
            chart5.render();
            chart6.render();
    }
    </script>
    </head>
    <body style="background-color:#9E9E9E;" >
        
        <div class="container2">  
            <div style="width: 100%;height:60px;text-align: center;background-color: #B0B0B0;padding-top: 2px;position: relative"><font color="white" ><b><h3>ESTADISTICAS DE CLIENTES</h3></b></div>
            <div style="width: 100%;height:420px;text-align: center;padding-top: 2px;position: relative">
            <div id="chartContainer" style="width: 31%;position: relative;margin-top: 8px;"></div>
            <div id="chartContainer2" style="width: 31%;position: relative;left: 34%;"></div>
            <div id="chartContainer3" style="width: 31%;position: relative;left: 68%;"></div>
            </div>
            <div style="width: 100%;height:60px;text-align: center;background-color: #B0B0B0;padding-top: 2px;position: relative"><font color="white" ><b><h3>ESTADISTICAS DE ATENCIONES</h3></b></div>
            <div style="width: 100%;height:420px;text-align: center;padding-top: 2px;position: relative">
            <div id="chartContainer4" style="width: 31%;position: relative;margin-top: 8px;"></div>
            <div id="chartContainer5" style="width: 31%;position: relative;left: 34%;"></div>
            <div id="chartContainer6" style="width: 31%;position: relative;left: 68%;"></div>
            </div>
            <div style="width: 100%;height:420px;text-align: center;padding-top: 2px;position: relative">
            <div id="chartContainer7" style="width: 31%;position: relative;margin-top: 8px;"></div>
            <div id="chartContainer8" style="width: 31%;position: relative;left: 48%;"></div>
 
            </div>
                    <footer><center><img src="view/img/balanza.png" width="150px" height="100px" alt=""/><center></footer>
        </div>
    </body>
</html>
