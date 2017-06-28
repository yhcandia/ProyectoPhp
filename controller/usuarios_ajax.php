<?php

# conectare la base de datos
$db_cfg = require_once '../config/database.php';
$con = @mysqli_connect($db_cfg["host"], $db_cfg["user"], $db_cfg["pass"], $db_cfg["database"]);
if (!$con) {
    die("imposible conectarse: " . mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    die("Connect failed: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
}
$con->query("SET NAMES utf8");
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
?>
