
	<?php
        require ("conectar.php");	
		$consUser = "select * from usuarios where estado_usuario='1'";
		$usuarios = mysqli_query ($con,$consUser);
                
                 return $usuarios;
	?>
