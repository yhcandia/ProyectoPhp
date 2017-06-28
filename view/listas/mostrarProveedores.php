<html>
	<?php
        require ("conectar.php");	
		$consMat = "select * from proveedor where estado_proveedor='1'";
		$materiales = mysqli_query ($con,$consMat);
		return $materiales;
	?>
</html>
