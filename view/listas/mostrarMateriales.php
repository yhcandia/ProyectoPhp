<html>
	<?php
        require ("conectar.php");	
		$consMat = "select * from material where estado_material='1'";
		$materiales = mysqli_query ($con,$consMat);
		return $materiales;
	?>
</html>