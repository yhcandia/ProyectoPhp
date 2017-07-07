<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Ejemplo PHP MySQLi POO MVC</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title>.: CLIENTES :.</title>
        <script language="javascript" type="text/javascript">     
        function confirmarRemover(id) {
                if (id == 'sinValor') {
                    alert("Debe seleccionar un abogado");
                } else {
                    ventana = confirm("¿Esta seguro que desea eliminar el abogado seleccionado?");
                    if (ventana) {
                        window.location.href = "<?php echo $helper->url("abogados", "borrar"); ?>&id=" + id;
                    }
                }
        }
            function confirmarEditar(id) {
                if (id == 'sinValor') {
                    alert("Debe seleccionar un abogado");
                } else {
                    ventana = confirm("¿Esta seguro que desea actualizar el abogado seleccionado?");
                    if (ventana) {
                        window.location.href = "<?php echo $helper->url("abogados", "update"); ?>&id=" + id;
                    }
                }
            }

        </script>
        <script language="javascript" type="text/javascript">
            function revisarDigito( dvr )
{	
	dv = dvr + ""	
	if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K')	
	{		
		alert("Debe ingresar un digito verificador valido");		
		window.document.form1.rutUsuario.focus();		
		window.document.form1.rutUsuario.select();		
		return false;	
	}	
	return true;
}

function revisarDigito2( crut )
{	
	largo = crut.length;	
	if ( largo < 2 )	
	{		
		alert("Debe ingresar el rut completo")		
		window.document.form1.rutUsuario.focus();		
		window.document.form1.rutUsuario.select();		
		return false;	
	}	
	if ( largo > 2 )		
		rut = crut.substring(0, largo - 1);	
	else		
		rut = crut.charAt(0);	
	dv = crut.charAt(largo-1);	
	revisarDigito( dv );	

	if ( rut == null || dv == null )
		return 0	

	var dvr = '0'	
	suma = 0	
	mul  = 2	

	for (i= rut.length -1 ; i >= 0; i--)	
	{	
		suma = suma + rut.charAt(i) * mul		
		if (mul == 7)			
			mul = 2		
		else    			
			mul++	
	}	
	res = suma % 11	
	if (res==1)		
		dvr = 'k'	
	else if (res==0)		
		dvr = '0'	
	else	
	{		
		dvi = 11-res		
		dvr = dvi + ""	
	}
	if ( dvr != dv.toLowerCase() )	
	{		
		alert("EL rut es incorrecto")		
		window.document.form1.rutUsuario.focus();		
		window.document.form1.rutUsuario.select();		
		return false	
	}

	return true
}

function Rut(texto)
{	
	var tmpstr = "";	
	for ( i=0; i < texto.length ; i++ )		
		if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' )
			tmpstr = tmpstr + texto.charAt(i);	
	texto = tmpstr;	
	largo = texto.length;	

	if ( largo < 2 )	
	{		
		alert("Debe ingresar el rut completo")		
		window.document.form1.rutUsuario.focus();		
		window.document.form1.rutUsuario.select();		
		return false;	
	}	

	for (i=0; i < largo ; i++ )	
	{			
		if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" )
 		{			
			alert("El valor ingresado no corresponde a un R.U.T valido");			
			window.document.form1.rutUsuario.focus();			
			window.document.form1.rutUsuario.select();			
			return false;		
		}	
	}	

	var invertido = "";	
	for ( i=(largo-1),j=0; i>=0; i--,j++ )		
		invertido = invertido + texto.charAt(i);	
	var dtexto = "";	
	dtexto = dtexto + invertido.charAt(0);	
	dtexto = dtexto + '-';	
	cnt = 0;	

	for ( i=1,j=2; i<largo; i++,j++ )	
	{		
		//alert("i=[" + i + "] j=[" + j +"]" );		
		if ( cnt == 3 )		
		{			
			dtexto = dtexto + '.';			
			j++;			
			dtexto = dtexto + invertido.charAt(i);			
			cnt = 1;		
		}		
		else		
		{				
			dtexto = dtexto + invertido.charAt(i);			
			cnt++;		
		}	
	}	

	invertido = "";	
	for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )		
		invertido = invertido + dtexto.charAt(i);	

	window.document.form1.rutUsuario.value = invertido.toUpperCase()		

	if ( revisarDigito2(texto) )		
		return true;	

	return false;
        }</script>
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
        <?php if(isset($_SESSION['mensaje']) ) { ?>
        <script>alert("<?php echo $_SESSION['mensaje'];?>");</script>
        <?php  
        unset($_SESSION['mensaje']);
         }
        ?>
             <form action="<?php echo $helper->url("abogados", "buscarNombreAbogado"); ?>" method="post">
                 <div class="form-group" style="width: 100%;text-align: center">
                     <center>
                            <label>Buscar:</label>
                            <?php if(isset($_SESSION['buscado'])) {?>
                            <input type="text" class="form-control" style="width: 30%;" name="name" value="<?php echo $_SESSION['buscado']; ?>" class="form-control"/>
                            <?php }else{ ?>
                             <input type="text" class="form-control" style="width: 30%" name="name" class="form-control"/>
                            <?php } ?>
                             <select name="buscarpor"  class="form-control" style="width: 30%" required=""/>     

                             <?php if (isset($_SESSION['buscarpor'])) { ?>
                                 <option value="<?php echo $_SESSION['buscarpor'] ?>" selected="<?php echo $_SESSION['buscarpor'] ?>">
                                     <?php if ($_SESSION['buscarpor'] == "nombre_completo") { ?>
                                     Buscar por Nombre </option> 
                                     <option value="especialidad">Buscar por Especialidad</option>
                                     <option value="rut">Buscar por RUT</option>
                                     <option value="id">Buscar por ID de abogado</option>
                                 <?php } if ($_SESSION['buscarpor'] == "especialidad") { ?>
                                     Buscar por Especialidad </option> 
                                     <option value="nombre_completo">Buscar por Nombre</option>
                                     <option value="rut">Buscar por RUT</option>
                                     <option value="id">Buscar por ID de cliente</option>
                                 <?php } if ($_SESSION['buscarpor'] == "rut") { ?>
                                     Buscar por RUT </option> 
                                     <option value="nombre_completo">Buscar por Nombre</option>
                                     <option value="especialidad">Buscar por Especialidad</option>
                                     <option value="id">Buscar por ID de abogado</option>
                                 <?php } if ($_SESSION['buscarpor'] == "id") { ?>
                                     Buscar por ID de abogado </option> 
                                     <option value="nombre_completo">Buscar por Nombre</option>
                                     <option value="especialidad">Buscar por Especialidad</option>
                                     <option value="rut">Buscar por RUT</option>
                                 <?php } ?>


                             <?php } else { ?>
                                 <option value="nombre_completo">Buscar por Nombre</option>
                                 <option value="tipo_persona">Buscar por Especialidad</option>
                                 <option value="rut">Buscar por RUT</option>
                                 <option value="id">Buscar por ID de abogado</option>
                             <?php } ?>
                             </select>
                         <div class="form-group" >
                            <input type="submit"  value="buscar" class="btn btn-default"/>
                        </div>  
                     </center>
                 </div>                                
                       
                    </form>

        
        <div class="principal">
            <div class="container2" style="padding-bottom:100px;">           
                <div class="row">
                    <div class="col-md-16">
                        <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">


                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Agregar</h4> <h5><font color="red">Todos los campos son obligatorios</font></h5>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" name="form1" method="post" action="<?php echo $helper->url("abogados", "crear");?>" onSubmit="javascript:return Rut(document.form1.rutUsuario.value)">

                                            <div class="form-group"><label>RUT: </label> <input type="text" maxlength="12" value="" name="rutUsuario" class="form-control" required=""/></div>
                                            <div class="form-group"><label>Nombre Completo: </label><input type="text" class="form-control" name="nombreAbogado" required=""/></div>
                                            <div class="form-group"><label>Especialidad: </label><input type="text" class="form-control" name="especialidadAbogado" required=""/></div>
                                            <div class="form-group"><label>Valor Hora: $</label><input type="number" min="1" class="form-control" name="valorAbogado" required=""/></div>
                                            <div class="form-group"><label >Fecha de contratación:</label><p><input min="2016-01-01" max="2018-12-31" value="<?php echo date('Y-m-d');?>" type="date" class="form-control" name="fechaAbogado"/></p> </div>                                           
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
                                <div class="panel-body ">Datos Abogados</div>
                                <div class="panel-footer">   
                                    <table class="table">

                                        <thead>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Rut</th>
                                        <th>Nombre Completo</th>
                                        <th>Fecha contratación</th>
                                        <th>Valor Hora</th>
                                        <th>Especialidad</th>                                 
                                        <th>Editar</th>
                                        <?php if ($_SESSION['session']['idRol'] == '1' || $_SESSION['session']['idRol'] == '3' ){ ?>
                                        <th>Eliminar</th>
                                        <?php } ?>
                                        <th></th>
                                        </thead>
                                        <tbody>                          
                                            <?php
                                            foreach($result as $row) {
                                                ?>                                 
                                                <tr>
                                                    <td><span class="glyphicon glyphicon-user"></span></td>
                                                    <td><?php echo $row->id; ?></td>
                                                    <td><?php echo $row->rut; ?></td>
                                                    <td><?php echo $row->nombre_completo; ?></td>
                                                    <td><?php echo $row->fecha_contratacion; ?></td>
                                                    <td><?php echo $row->valor_hora; ?></td>
                                                    <td><?php echo $row->especialidad; ?></td>
                                                    <td>
                                                       <a data-toggle="modal" href="#ModalEditar<?php echo $row->id ?>" title="Editar" class="btn btn-info glyphicon glyphicon-edit"></a>
                                                        <div class="modal fade" id="ModalEditar<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">


                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title">Editar</h4> 
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form role="form" name="form2" action="<?php echo $helper->url("clientes", "update"); ?>" method="post">  
                                                                             <div class="form-group"><label>ID:</label> <input required="" type="text" name="id" value="<?php echo $row->id; ?>" readonly=""   class="form-control" /></div>
                                                                            <div class="form-group"><label>Rut:</label> <input required="" type="text" name="rutAbogadoe" value="<?php echo $row->rut; ?>"   readonly=""  class="form-control" /></div>
                                                                            <div class="form-group"><label>Nombre Completo:</label> <input required="" type="text" name="nombreAbogadoe" value="<?php echo $row->nombre_completo; ?>" class="form-control"/></div>
                                                                             <div class="form-group"><label>Especialidad:</label> <input required="" type="text" name="especialidadAbogadoe" value="<?php echo $row->especialidad; ?>" class="form-control"/></div>
                                                                            <div class="form-group"><label>Valor Hora: </label><input type="number" min="200000000" max="999999999" value="<?php echo $row->valor_hora; ?>" class="form-control" name="valorAbogadoe" required=""/></div>
                                                                            <div class="form-group"><label >Fecha de Contratación:</label><p><input min="2016-01-01" value="<?php echo $row->fecha_contratacion; ?>" max="2018-12-31" value="<?php echo date('Y-m-d');?>" type="date" class="form-control" name="fechaAbogadoe"/></p> </div>
                                                                            
                                                                            <button type="submit" class="btn btn-default">Editar</button>
                                                                        </form>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal --> 
                                                    </td>  
                                                    <?php if ($_SESSION['session']['idRol'] == '1' || $_SESSION['session']['idRol'] == '3' ){ ?>
                                                    <td><a href="#" title="Eliminar" onClick="confirmarRemover(<?php echo $row->id; ?>)" class="btn btn-danger glyphicon glyphicon-ban-circle"></a> </td>
                                                    <?php } else {?>
                                                    <td></td>
                                                    <?php }?>
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
                                <div class="pull-left" style="bottom:20px;position: absolute;left: 10px;">
                                    <a data-toggle="modal" href="#ModalAgregar" title="Agregar" class="btn btn-success glyphicon glyphicon-plus"></a>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="panel panel-default col-md-8 center-block">
                                <div class="panel-body" style="text-align: center">                
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
