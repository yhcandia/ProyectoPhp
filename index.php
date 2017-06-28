<?php
session_start();
//Configuración global
require_once 'config/global.php';

//Base para los controladores
require_once 'core/ControladorBase.php';

//Funciones para el controlador frontal
require_once 'core/ControladorFrontal.func.php';

//Cargamos controladores y acciones


if (isset($_SESSION['session'])) {
    require("menu/menu.php");
    if (isset($_GET["controller"])) {
        
        $controllerObj = cargarControlador($_GET["controller"]);
        lanzarAccion($controllerObj);
    } else {

        $controllerObj = cargarControlador(CONTROLADOR_DEFECTO);
        lanzarAccion($controllerObj);
    }
} else {
    $controllerObj = cargarControlador("Usuarios");
    cargarAccion($controllerObj, "login");
}
?>
