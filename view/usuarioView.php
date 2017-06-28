<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Ejemplo PHP MySQLi POO MVC</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title>.: USUARIOS :.</title>
        <style>
        </style>
        <script type="text/javascript" src="js/validarut.js"></script>
        <script language="javascript" type="text/javascript">
            function confirmarRemover(id) {
                if (id == 'sinValor') {
                    alert("Debe seleccionar un usuario");
                } else {
                    ventana = confirm("¿Esta seguro que desea eliminar el usuario seleccionado?");
                    if (ventana) {
                        window.location.href = "<?php echo $helper->url("usuarios", "borrar"); ?>&id=" + id;
                    }
                }
            }
        </script>
        <script language="javascript" type="text/javascript">
            function confirmarEditar(id) {
                if (id == 'sinValor') {
                    alert("Debe seleccionar un usuario");
                } else {
                    ventana = confirm("¿Esta seguro que desea actualizar el usuario seleccionado?");
                    if (ventana) {
                        window.location.href = "<?php echo $helper->url("usuarios", "update"); ?>&id=" + id;
                    }
                }
            }

        </script>

        <style>
            .container2 .panel {
                position: absolute;
                top: 20%;
                margin-left: 10%;
                width: 80%;
            }
            .principal{
                position:relative;
            }
            footer {
                padding-top:10px;
                width:100%;
                top: 600%;
                height:60px;
                position:absolute;
                bottom:0;
                background-color: white;
                border-top: solid 5px #404040;
            }
        </style>
    </head>
    <body style="background-color:#9E9E9E;" >
   
        <div class="principal">
            <div class="container2" style="padding-bottom:100px;">           
                <div class="row">
                    <div class="col-md-16">
                        <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">


                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Agregar</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" name="form1" method="post" action="<?php echo $helper->url("usuarios", "crear"); ?>" onsubmit="javascript:return Rut(document.form1.rut.value)">

                                            <div class="form-group"><label>RUT: </label> <input type="text" name="rutUsuario" class="form-control" required=""/></div>
                                            <div class="form-group"><label>Nombre Completo: </label><input type="text" class="form-control" name="nombreUsuario" required=""/></div>
                                            <div class="form-group"><label>Perfil: </label>
                                                <select name="idperfil" class="form-control" required=""/>                                           
                                                <option value="">-- Seleccione --</option>
                                                <?php
                                               
                                                foreach ($perfiles as $rowww) {
                                                    ?>

                                                     <option value="<?php echo $rowww->idperfil; ?>"><?php echo $rowww->nombre; ?></option>
                                                        <?php
                                                    
                                                }
                                                ?>
                                                </select></div>                                   
                                            <div class="form-group"><label>Contraseña: </label><input required="" type="password" class="form-control" name="password"/></div>
                                            <button type="submit" class="btn btn-default">Agregar</button>
                                        </form>
                                    </div>



                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->                   

                    </div>
                </div>
           
                        <?php
                        if ($num_registros > 0) {
                            ?>
                            <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>        
                            <div class="panel panel-default">
                                <div class="panel-body ">Datos Usuario</div>
                                <div class="panel-footer">   
                                    <table class="table">

                                        <thead>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Rut</th>
                                        <th>Nombre</th>
                                        <th>Perfil</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        <th></th>
                                        </thead>
                                        <tbody>                          
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>                                 
                                                <tr>
                                                    <td><span class="glyphicon glyphicon-user"></span></td>
                                                    <td><?php echo $row['idusuario']; ?></td>
                                                    <td><?php echo $row['rut']; ?></td>
                                                    <td><?php echo $row['nombreusuario']; ?></td>
                                                    <td><?php echo $row['nombre']; ?></td>
                                                    <td>
                                                       <a data-toggle="modal" href="#ModalEditar<?php echo $row['idusuario'] ?>" title="Editar" class="btn btn-info glyphicon glyphicon-edit"></a>
                                                        <div class="modal fade" id="ModalEditar<?php echo $row['idusuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">


                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title">Editar</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo $helper->url("usuarios", "update"); ?>&id=<?php echo $row['idusuario']; ?>" method="post">
                                                                            <div class="form-group"><input type="hidden" name="rut" value=""    class="form-control"/></div>
                                                                            <div class="form-group"><label>Rut:</label> <input required="" type="text" name="rutUsuario" value="<?php echo $row['rut']; ?>"    class="form-control"/></div>
                                                                            <div class="form-group"><label>Nombre Completo:</label> <input required="" type="text" name="nombreUsuario" value="<?php echo $row['nombreusuario']; ?>" class="form-control"/></div>
                                                                            <div class="form-group"><label>Perfil: </label>
                                                                                <select name="idperfil" class="form-control" required=""/>     
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                
                                                                                foreach ($perfiles as $roww) {
                                                                                    if ($roww->idperfil == $row['idperfil']) {
                                                                                        ?>

                                                                                        <option selected value="<?php echo $roww->idperfil; ?>"><?php echo $roww->nombre; ?></option>
                                                                                    <?php } else { ?>
                                                                                        <option value="<?php echo $roww->idperfil; ?>"><?php echo $roww->nombre; ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                </select></div>
                                                                            <div class="form-group"><label>Contraseña:</label> <input required="" type="password" name="password" value="" class="form-control"/></div>
                                                                            <button type="submit" class="btn btn-default">Editar</button>
                                                                        </form>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal --> 
                                                    </td>     
                                                    <td><a href="#" title="Desactivar" onClick="confirmarRemover(<?php echo $row['idusuario']; ?>)" class="btn btn-danger glyphicon glyphicon-ban-circle"></a> </td>
                                                    <td></td>
                                                </tr>                                 
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>               
                                    <div class="table-pagination pull-right">
                                        <?php $paginacion->render(); ?>  
                                    </div>     
                                </div>    
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="pull-left" style="bottom:20px;position: absolute;">
                                    <a data-toggle="modal" href="#ModalAgregar" title="Agregar" class="btn btn-success glyphicon glyphicon-plus"></a>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="panel panel-default col-md-8 center-block">
                                <div class="panel-body">                
                                    <h4>Aviso!!!</h4> No hay datos para mostrar<br>
                                    <a data-toggle="modal" href="#ModalAgregar" title="Agregar" class="btn btn-success glyphicon glyphicon-plus"></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                    <footer><center><img src="view/img/balanza.png" width="150px" height="100px" alt=""/><center></footer>
            </div>       
    </body>
</html>