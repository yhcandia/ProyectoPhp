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
                if(id=='sinValor'){
                    alert("Debe seleccionar un usuario");                  
                }else{
                    ventana = confirm("¿Esta seguro que desea activar/desactivar el usuario seleccionado?");
                    if (ventana) {
                        window.location.href="<?php echo $helper->url("usuariosPanol", "borrar"); ?>&id="+id;
                    }
                }
            }
        </script>
        <script language="javascript" type="text/javascript">
            function confirmarEditar(id) {
                if(id=='sinValor'){
                    alert("Debe seleccionar un usuario");                  
                }else{
                    ventana = confirm("¿Esta seguro que desea actualizar el usuario seleccionado?");
                    if (ventana) {     
                        window.location.href="<?php echo $helper->url("usuariosPanol", "actualizar"); ?>&id="+id;            
                    }
                }
            }
            function actualiza(){
                var valida = <?php echo intval(isset($_GET['id']))?>;            
                if(valida=='1'){   
                    setTimeout(function(){ $("#modEditar").click(); }, 1000);
                                   
                    return true;
                }else{
                    return false;
                }
            }
        </script>
        <script>
	$(document).ready(function(){
                $("#valorRadio").attr("value", "sinValor");
		load(1);  
	}); 
	function load(page){
                $("#valorRadio").attr("value", "sinValor");
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'controller/usuariosPanol_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='view/img/loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
	</script>  
        <style>
            .container .panel {
                position: absolute;
                top: 250%;
                left: 50%;
                transform: translateX(-50%) translateY(-50%);
            }
            .principal{
                position:relative;
            }
            footer {
                padding-top:10px;
                width:100%;
                top: 580%;
                height:60px;
                position:absolute;
                bottom:0;
                border-top: solid 5px #FAAF3A;
            }
        </style>
    </head>
    <body style="background-color:#012C56;" onload="actualiza()">
    <center>
        <div class="principal">
        <div class="container" style="padding-bottom:100px;">           
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Agregar</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" name="form1" method="post" action="<?php echo $helper->url("usuarios", "crear"); ?>" onsubmit="javascript:return Rut(document.form1.rut.value)">

                                        <div class="form-group"><label>RUT: </label> <input required="" type="text" name="rutUsuario" class="form-control" /></div>
                                        <div class="form-group"><label>Nombre: </label><input required="" type="text" class="form-control" name="nombreUsuario"/></div>
                                        <div class="form-group"><label>Apellido: </label><input required="" type="text" class="form-control" name="apellidoUsuario"/></div>
                                        <div class="form-group"><label>Domicilio: </label><input required="" type="text" class="form-control" name="domicilioUsuario"/></div>
                                        <div class="form-group"><label>Telefono: </label><input required="" type="number" min="1" class="form-control" name="telefonoUsuario"/></div>
                                        <div class="form-group"><label>Estado: </label>
                                                        <select name="estadoUsuario" class="form-control"/>
                                                        <option  class="form-control" value="1"> Activo </option>
                                                        <option  class="form-control" value="0"> Desactivado </option>
                                                    </select></div>
                                        <div class="form-group"><label>Email Usuario: </label><input required="" type="email" class="form-control" name="emailUsuario"/></div>
                                        <div class="form-group"><label>Escuela: </label><input required="" type="text" class="form-control" name="escuelaUsuario"/></div>
                                        <div class="form-group"><label>Rol: </label>
                                            <select name="idRol" class="form-control" required=""/> 
                                            <option value="">-- Seleccione --</option>
                                            <?php
                                            $roles = include('listas/mostrarRoles.php');
                                            while ($row = mysqli_fetch_row($roles)) {
                                                ?>
                                                <?php if ($row[0]!=1 && $row[0]!=0) {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
                                                <?php } ?>
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
                    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Editar</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="<?php echo $helper->url("usuarios","update"); ?>" method="post">
                                        <div class="form-group"><input type="hidden" name="rut" value="<?php echo $usuario->rut_usuario ?>"    class="form-control"/></div>
                                        <div class="form-group"><label>RUT:</label> <input required="" type="text" name="rutUsuario" value="<?php echo $usuario->rut_usuario ?>"    class="form-control"/></div>
                                        <div class="form-group"><label>Nombre:</label> <input required="" type="text" name="nombreUsuario" value="<?php echo $usuario->nombre_usuario ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Apellido:</label> <input required="" type="text" name="apellidoUsuario" value="<?php echo $usuario->apellido_usuario ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Domicilio:</label> <input required="" type="text" name="domicilioUsuario" value="<?php echo $usuario->domicilio_usuario ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Telefono:</label> <input type="number" min="1" required="" name="telefonoUsuario" value="<?php echo $usuario->telefono_usuario ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Estado: </label>
                                                        <select name="estadoUsuario" class="form-control" name="estadoUsuario"/>
                                                        <?php if ($usuario->estado_usuario == 1) {?>
                                                        <option  class="form-control" value="1" selected> Activo </option>
                                                        <option  class="form-control" value="0"> Desactivado </option>
                                                        <?php } 
                                                        
                                                        if ($usuario->estado_usuario == 0) {?>
                                                        <option  class="form-control" value="1" > Activo </option>
                                                        <option  class="form-control" value="0" selected> Desactivado </option>
                                                        <?php } ?>
                                                    </select></div>
                                        <div class="form-group"><label>Email Usuario:</label> <input required="" type="email" name="emailUsuario" value="<?php echo $usuario->mail_usuario ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Escuela:</label> <input required="" type="text" name="escuelaUsuario" value="<?php echo $usuario->escuela_usuario ?>" class="form-control"/></div>
                                        
                                        <div class="form-group"><label>Rol:</label>
                                            <select name="idRol" class="form-control" required=""/>     
                                            <option value="">-- Seleccione --</option>
                                        <?php
                                            $roless = include('listas/mostrarRoles.php');
                                            while ($row = mysqli_fetch_row($roless)) {
                                                
                                            if ($usuario->id_rol==$row[1]){?>
                                                <option selected value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
                                            <?php }
                                            }
                                            ?>
                                                </select></div>
                                        
                                        <div class="form-group"><label>Contraseña:</label> <input required="" type="password" name="password" value="<?php echo $usuario->password_usuario ?>" class="form-control"/></div>
                                        <button type="submit" class="btn btn-default">Editar</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> 
                </div>
            </div>
              <!--listado de usuario desde Ajax con paginador-->
            <div class="outer_div">
                    <div id="loader" class="text-center"></div><!-- Datos ajax Final -->           
            </div>  
              <div style="display: none;">
                   <a data-toggle="modal" id="modEditar" href="#ModalEditar" title="Agregar" class="btn btn-success glyphicon glyphicon-plus"></a>
              </div>
            <div>                  
                <input type="hidden" value="sinValor" id="valorRadio" name="valorRadio">              
            </div>
        </div>
            <footer><center><img src="view/img/logo.png" alt="Duoc Uc"/><center></footer>
        </div>
    </center>
    </body>
</html>