<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Ejemplo PHP MySQLi POO MVC</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title>.: MATERIALES :.</title>
        <style>
        </style>
        <script language="javascript" type="text/javascript">
            function confirmarRemover(id) {
                if(id=='sinValor'){
                    alert("Debe seleccionar un material");                  
                }else{
                    ventana = confirm("¿Esta seguro que desea activar/desactivar el material seleccionado?");
                    if (ventana) {
                        window.location.href="<?php echo $helper->url("materiales", "borrar"); ?>&id="+id;
                    }
                }
            }
        </script>
        <script language="javascript" type="text/javascript">
            function confirmarEditar(id) {
                if(id=='sinValor'){
                    alert("Debe seleccionar un materiales");                  
                }else{
                    ventana = confirm("¿Esta seguro que desea actualizar el material seleccionado?");
                    if (ventana) {     
                        window.location.href="<?php echo $helper->url("materiales", "actualizar"); ?>&id="+id;            
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
			url:'controller/materiales_ajax.php',
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
                                    <form role="form" method="post" action="<?php echo $helper->url("materiales", "crear"); ?>" enctype="multipart/form-data">

                                        <div class="form-group"><label>Seleccione Categoria: </label>
                                          
                                            <select class="form-control" name="idCategoria" required="">
                                            <option value="">-- Seleccione --</option>
                                            <?php
                                            $materialesP = include('listas/mostrarCategorias.php');
                                            while ($row = mysqli_fetch_row($materialesP)) {
                                                ?>

                                                <option value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>

                                                <?php
                                            }
                                            ?>
						</select></div>
                                        
                                        <div class="form-group"><label>Nombre: </label><input required="" type="text" class="form-control" name="nombreMaterial"/></div>
                                        <div class="form-group"><label>Estado: </label>
                                                        <select name="estadoMaterial" class="form-control" name="estadoMaterial"/>
                                                        <option  class="form-control" value="1"> Activo </option>
                                                        <option  class="form-control" value="0"> Desactivado </option>
                                                    </select></div>
                                        <div class="form-group"><label>Stock: </label><input required="" min="0" type="number" class="form-control" name="stock"/></div>
                                        <div class="form-group"><label>Imagen: </label><input required="" type="file" class="form-control" name="image" accept="image/*"/></div>
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
                                    <form role="form" action="<?php echo $helper->url("materiales","update"); ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group"><input type="hidden" name="id" value="<?php echo $material->id_material ?>"    class="form-control"/></div>
                                        
                                        <div class="form-group"><label>Seleccione Categoria: </label>
                                          
                                            <select class="form-control" name="idCategoria" required="">
                                                <option value="">-- Seleccione --</option>
                                            <?php
                                            $materiales = include('listas/mostrarCategorias.php');
                                            while ($row = mysqli_fetch_row($materiales)) {
                                                if ($material->id_categoria==$row[0]){?>
                                                <option selected value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
                                            <?php }
                                            }
                                            ?>
						</select></div>
                                        
                                        <div class="form-group"><label>Nombre:</label> <input required="" type="text" name="nombreMaterial" value="<?php echo $material->nombre_material ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Estado: </label>
                                                        <select name="estadoMaterial" class="form-control" name="estadoMaterial"/>
                                                        <?php if ($material->estado_material == 1) {?>
                                                        <option  class="form-control" value="1" selected> Activo </option>
                                                        <option  class="form-control" value="0"> Desactivado </option>
                                                        <?php } 
                                                        
                                                        if ($material->estado_material == 0) {?>
                                                        <option  class="form-control" value="1" > Activo </option>
                                                        <option  class="form-control" value="0" selected> Desactivado </option>
                                                        <?php } ?>
                                                        
                                                    </select></div>
                                        <div class="form-group"><label>Stock:</label> <input required="" min="0" type="number" name="stock" value="<?php echo $material->stock_material ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Imagen: </label><input type="file" required="" class="form-control" name="image" accept="image/*"/></div>
                                        <button type="submit" class="btn btn-default">Editar</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> 
                </div>
            </div>
              <!--listado de proveedores desde Ajax con paginador-->
            <div class="outer_div">
                    <div id="loader" class="text-center"></div><!-- Datos ajax Final -->           
            </div>  
              <div class="outer_div2" style="position: absolute;">
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