<!DOCTYPE HTML>
<html lang="es" style="background-color:#012C56;">
    <head>
        <meta charset="utf-8"/>
        <title>Ejemplo PHP MySQLi POO MVC</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <style>
            .container{
                position: absolute;
                top: 20%;
                width: 100%;

            }
            footer {
                padding-top:10px;
                width:100%;
                top: 80%;
                height:60px;
                position:absolute;
                bottom:0;
                border-top: solid 5px #FAAF3A;
            }
        </style>
    </head>

    <body>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <div class="container">
            <div class="panel panel-default center-block">

                <div class="panel-footer">


                    <div class="form-group">
                        <?php
                        if (isset($result)) {
                            if ($num_registros != 0) {
                                ?>

                                <table class="table">
                                    <thead>
                                    <th>ID DE PRESTAMO</th>
                                    <th>ID DEL MATERIAL</th>
                                    <th>Cantidad Solicitada</th>
                                    <th>Fecha Prestamo</th>
                                    <th>Fecha Limite</th>
                                    <th>Estado Prestamo</th>
                                    <th>Detalle Material</th>

                                    </thead>
                                    <tbody> 
                                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                                            <tr>
                                                <td><?php echo $row['id_prestamo']; ?></td>
                                                <td><?php echo $row['id_material']; ?></td>
                                                <td><?php echo $row['cantidad']; ?></td>
                                                <td><?php echo $row['fecha_prestamo']; ?></td>
                                                <td><?php echo $row['fecha_limite']; ?></td>
                                                <?php if ($row['estado_prestamo']==0){?>
                                                <td><?php echo "DESACTIVADO";?></td>
                                                <?php }?>
                                                <?php if ($row['estado_prestamo']==1){?>
                                                <td><?php echo "RECIBIDO";?></td>
                                                <?php }?>
                                                <?php if ($row['estado_prestamo']==2){?>
                                                <td><?php echo "PENDIENTE";?></td>
                                                <?php }?>
                                                <?php if ($row['estado_prestamo']==3){?>
                                                <td><?php echo "POR CONFIRMAR";?></td>
                                                <?php }?>
                                                <?php
                                                $foto = $row['imagen'];
                                                $Base64Img = base64_decode($foto);
                                                ?>
                                                <td>
                                                    <a data-toggle="modal" name="myModalImagebtn<?php echo $row['id_material']; ?>" id="myModalImagebtn<?php echo $row['id_material']; ?>" href="#myModalImage<?php echo $row['id_material']; ?>" title="Ver Detalle" class="btn">Ver material</a>
                                                    <div id="myModalImage<?php echo $row['id_material']; ?>" class="modal fade" role="dialog">  
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">      
                                                                <div class="modal-header">        
                                                                    <button type="button" class="close" data-dismiss="modal">×</button>        
                                                                    <h4 class="modal-title">Material solicitado</h4>      </div> 
                                                                <center>
                                                                    <div class="modal-body">
                                                                        <table class="table">
                                                                        <thead>
                                                                        <th>ID</th>
                                                                        <th>Nombre</th>
                                                                        <th>Imagen</th>
                                                                        </thead>    
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><?php echo $row['id_material']; ?></td>
                                                                                <td><?php echo $row['nombre_material']; ?></td>
                                                                                <td>
                                                                                 <img id="imagenPop" src="data:image/png;base64,<?php echo $foto; ?>" class="img-rounded" width="304" height="236" />   </div>      
                                                                                </td>
                                                                        </tbody>
                                                                        </table>
                                                                        </div>      

                                                                </center>
                                                                <div class="modal-footer"> 

                                                                </div>  
                                                            </div>  
                                                        </div>    
                                                    </div>
                                                </td>   

                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>      

                            <?php } else { ?>
                                <p class="alert alert-warning">No hay resultados</p>
                                <?php
                            };
                            $paginacion->render();
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <footer><center><img src="view/img/logo.png" alt="Duoc Uc"/><center></footer>


                    </body>

                    </html>
