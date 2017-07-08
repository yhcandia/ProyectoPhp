
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Menu</title>
        <link rel="stylesheet" href="menu/stilo.css">
        <link rel="stylesheet" href="menu/font.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    </head>
    <body>
        <header>
            <div class="menu_bar">
                <a href="#" class="bt-menu"><span class="icon-home"></span> Menu <div  style="position: absolute;background:#404040; right: 0px ;top: 30px; height: 50px; width: 25%;text-align: center; font-size: 70%">Bienvenid@ <?php echo $_SESSION['session']['nombreUsuario']; ?>&#32; </div></a>         
            </div>
            <nav>
                <ul>
                    <?php
                    if (isset($_SESSION['session'])) {
                     ?>   
                        <li><a href="./index.php?controller=index"><span class="glyphicon glyphicon-home"></span>Inicio</a></li> 
                    <?php         
                        if ($_SESSION['session']['idRol'] == '1') { //SUPERADMIN
                            ?>    
                            <li><a href="./index.php?controller=usuarios&action=index"><span class="glyphicon glyphicon-user"></span>Usuarios</a></li>
                            <li><a href="./index.php?controller=clientes&action=index"><span class="glyphicon glyphicon-user"></span>Clientes</a></li>
                            <li><a href="./index.php?controller=abogados&action=index"><span class="glyphicon glyphicon-user"></span>Abogados</a></li>
                            <li><a href="./index.php?controller=graficos&action=index"><span class="glyphicon glyphicon-user"></span>Graficos</a></li>
                            <li><a href="./index.php?controller=atenciones&action=index"><span class="glyphicon glyphicon-user"></span>Atenciones</a></li>
                            <?php
                        }
                        if ($_SESSION['session']['idRol'] == '2') { //GERENTE
                            ?>  
                            <li><a href="./index.php?controller=clientes&action=index"><span class="glyphicon glyphicon-user"></span>Clientes</a></li>
                            <li><a href="./index.php?controller=abogados&action=index"><span class="glyphicon glyphicon-user"></span>Abogados</a></li>
                            <li><a href="./index.php?controller=graficos&action=index"><span class="glyphicon glyphicon-user"></span>Graficos</a></li>
                            <li><a href="./index.php?controller=atenciones&action=index"><span class="glyphicon glyphicon-user"></span>Atenciones</a></li>
                           
                            
                            <?php
                        }
                        if ($_SESSION['session']['idRol'] == '3') { //ADMINISTRADOR
                            ?>  
                            
                            <li><a href="./index.php?controller=usuarios&action=index"><span class="glyphicon glyphicon-user"></span>Usuarios</a></li>
                            <li><a href="./index.php?controller=clientes&action=index"><span class="glyphicon glyphicon-user"></span>Clientes</a></li>
                            <li><a href="./index.php?controller=abogados&action=index"><span class="glyphicon glyphicon-user"></span>Abogados</a></li>
                            
                            <?php
                        }
                        if ($_SESSION['session']['idRol'] == '4') { //SECRETARIA
                            ?>  
                            <li><a href="./index.php?controller=clientes&action=index"><span class="glyphicon glyphicon-user"></span>Clientes</a></li>
                            <li><a href="./index.php?controller=abogados&action=index"><span class="glyphicon glyphicon-user"></span>Abogados</a></li>
                            <li><a href="./index.php?controller=atenciones&action=index"><span class="glyphicon glyphicon-user"></span>Atenciones</a></li>
                            <?php
                        }
                        if ($_SESSION['session']['idRol'] == '5') { //CLIENTE
                            ?> 
                            <li><a href="./index.php?controller=atenciones&action=index"><span class="glyphicon glyphicon-user"></span>Atenciones</a></li>
                            <?php
                        }
                    }
                    ?>
                    <li><a href="./index.php?controller=usuarios&action=logout"><span class="icon-enter"></span>Salir</a></li>

                </ul>
            </nav>
        </header>

        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="menu/menu.js"></script>

    </body>
</html>
