<?php
    require ("conectar.php");	
            $consMat = "select * from panol";
            $roles = mysqli_query ($con,$consMat);
            return $roles;
?>

