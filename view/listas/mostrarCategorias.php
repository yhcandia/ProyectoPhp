<html>
	<?php
        require ("conectar.php");	
		$consMat = "select * from categoria where estado_categoria='1'";
		$categorias = mysqli_query ($con,$consMat);
		return $categorias;
	?>
</html>