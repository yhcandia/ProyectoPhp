<?php
class AyudaVistas{
    
    public function url($controlador="",$accion=""){
        $urlString="index.php?controller=".$controlador."&action=".$accion;
        return $urlString;
    }
    
    //Helpers para las vistas
}
?>
