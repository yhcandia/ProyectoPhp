<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Mantenedor Categoria</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title>.: Categorias :.</title>
        <style>
        </style>
        <script language="javascript" type="text/javascript">
            function confirmarRemover(id) {
                if(id=='sinValor'){
                    alert("Debe seleccionar una categoria");                  
                }else{
                    ventana = confirm("¿Esta seguro que desea eliminar el registro?");
                    if (ventana) {
                        window.location.href="<?php echo $helper->url("categorias", "borrar"); ?>&id="+id;
                    }
                }
            }
        </script>
        <script language="javascript" type="text/javascript">
            function confirmarEditar(id) {
                if(id=='sinValor'){
                    alert("Debe seleccionar una categoria");                  
                }else{
                    ventana = confirm("¿Esta seguro que desea actualizar el registro?");
                    if (ventana) {     
                        window.location.href="<?php echo $helper->url("categorias", "actualizar"); ?>&id="+id;            
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
			url:'controller/categorias_ajax.php',
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
                top: 520%;
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
                                    <form role="form" method="post" action="<?php echo $helper->url("categorias", "crear"); ?>">

                                        <div class="form-group"><label>Nombre categoria: </label> <input required type="text" class="form-control" name="nombreCategoria"/></div>
                                        <div class="form-group"><label>Desechable: </label>
                                            <select name="desechable" class="form-control" name="desechable" required=""/>
                                                        <option value="">-- Seleccione --</option>
                                                        <option  class="form-control" value="0"> Desechable </option>
                                                        <option  class="form-control" value="1"> Retornable </option>
                                                        </select></div>
                                        <div class="form-group"><label>Estado: </label>
                                            <select name="estadoCategoria" class="form-control" name="estadoCategoria" required=""/>
                                                        <option value="">-- Seleccione --</option>
                                                        <option  class="form-control" value="1"> Activo </option>
                                                        <option  class="form-control" value="0"> Desactivado </option>
                                                    </select></div>
                                         
                                        <div class="form-group"><label>Pañol: </label>
                                          
                                        <select class="form-control" name="idPanol">
                                            <?php
                                            $panol = include('listas/mostrarpanol.php');
                                            while ($row = mysqli_fetch_row($panol)) {
                                                ?>

                                            <option selected value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>

                                                <?php
                                            }
                                            ?>
						</select></div>
                                        
                                        
                                        
                                        
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
                                    <form role="form" action="<?php echo $helper->url("categorias","update"); ?>" method="post">
                                        <div class="form-group"><input type="hidden" name="idCategoria" value="<?php echo $categoria->id_categoria ?>"    class="form-control"/></div>
                                        <div class="form-group"><label>Nombre categoria</label> <input type="text" name="nombreCategoria" value="<?php echo $categoria->nombre_categoria ?>" class="form-control"/></div>
                                        <div class="form-group"><label>Desechable: </label>
                                            <select name="desechable" class="form-control" required=""/>
                                                        <option value="">-- Seleccione --</option>
                                                        <option  class="form-control" value="0"> Desechable </option>
                                                        <option  class="form-control" value="1"> Retornable </option>
                                                        </select></div>
                                        <div class="form-group"><label>Estado: </label>
                                            <select name="estadoCategoria" class="form-control" required=""/>
                                                        <option value="">-- Seleccione --</option>
                                                        <?php if ($categoria->estado_categoria == 1) {?>
                                                        <option  class="form-control" value="1" selected> Activo </option>
                                                        <option  class="form-control" value="0"> Desactivado </option>
                                                        <?php } 
                                                        
                                                        if ($categoria->estado_categoria == 0) {?>
                                                        <option  class="form-control" value="1" > Activo </option>
                                                        <option  class="form-control" value="0" selected> Desactivado </option>
                                                        <?php } ?>
                                                    </select></div>
                                         <div class="form-group"><label>Pañol: </label>
                                        <select class="form-control" name="idPanol">
                                            <?php
                                            $panol = include('listas/mostrarpanol.php');
                                            while ($row = mysqli_fetch_row($panol)) {
                                                
                                            if ($categoria->id_panol==$row[0]){?>
                                                <option selected value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
                                            <?php }
                                            }
                                            ?>
						</select></div>           
                                        
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