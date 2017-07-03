<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title></title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title>.: INICIO :.</title>
        <style>        
            footer {
                padding-top:10px;
                width:100%;
                top: 500px;
                height:60px;
                position:relative;
                bottom:0;
                background-color: white;
                border-top: solid 5px #404040;
            }
            .container {
                position: absolute;
                margin-top:15%;
                left: 50%;          
                transform: translateX(-50%) translateY(-50%);
            }
        </style>
    <body style="background-color:#9E9E9E;" onload="actualiza()">
        
    </body>
    <div class="container" style="color: white;">
        <div style="width: 100%;text-align: center;position: relative;float: left;top: 0px; "><h1><b>Sistema Bufete.</b></h1></div>
        <div style="width: 100%;text-align: center;position: relative;float: left;top: 50px   "><img src="view/img/martillo.png" width="200px" height="30%"></div>
        <div style="width: 100%;text-align: center;position: relative; float: left;top: 80px "><b><h1>
           <?php if($_SESSION["session"]["idRol"]==1){ ?>
               SUPER ADMINISTRADOR
           <?php }if($_SESSION["session"]["idRol"]==2){ ?>
               Gerente
           <?php }if($_SESSION["session"]["idRol"]==3){ ?>
               Administrador
           <?php }if($_SESSION["session"]["idRol"]==4){ ?>
               Secretaria
           <?php }if($_SESSION["session"]["idRol"]==5){ ?>
               Cliente
           <?php } ?>
            </b></h1></div>
    </div>
    
    </div>
        <footer><center><img src="view/img/balanza.png" width="150px" height="100px" alt="Bufete"/><center></footer>
    </div>
</html>