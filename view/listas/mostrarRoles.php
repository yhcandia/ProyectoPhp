<?php
    require ("conectar.php");	
            $consMat = "select * from rol where estado_rol='1'";
            $roles = mysqli_query ($con,$consMat);
            return $roles;
?>

