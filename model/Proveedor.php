<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedor
 *
 * @author Oscar
 */
class Proveedor extends EntidadBase{
    private $id_proveedor;
    private $rut_proveedor;
    private $nombre_proveedor;
    private $estado_proveedor;
    private $direccion_proveedor;
    
    public function __construct($adapter) {
        $table="proveedor";
        parent::__construct($table, $adapter);
    }
    
    function getId_proveedor() {
        return $this->id_proveedor;
    }

    function getRut_proveedor() {
        return $this->rut_proveedor;
    }

    function getNombre_proveedor() {
        return $this->nombre_proveedor;
    }
    
    function getEstado_proveedor() {
        return $this->estado_proveedor;
    }

    function getDireccion_Proveedor() {
        return $this->direccion_proveedor;
    }

    function setId_proveedor($id_proveedor) {
        $this->id_proveedor = $id_proveedor;
    }

    function setRut_proveedor($rut_proveedor) {
        $this->rut_proveedor = $rut_proveedor;
    }

    function setNombre_proveedor($nombre_proveedor) {
        $this->nombre_proveedor = $nombre_proveedor;
    }
    
    function setEstado_proveedor($estado_proveedor) {
        $this->estado_proveedor = $estado_proveedor;
    }

    function setDireccion_Proveedor($direccion_proveedor) {
        $this->direccion_proveedor = $direccion_proveedor;
    }
    
     public function update($rut){
        $query="UPDATE proveedor SET rut_proveedor= '$this->rut_proveedor',"
                . "nombre_proveedor = '$this->nombre_proveedor',"
                . "estado_proveedor = '$this->estado_proveedor',"
                . "direccion_proveedor='$this->direccion_proveedor' where rut_proveedor= '$rut'";
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }

    public function save(){
        $query="INSERT INTO proveedor (rut_proveedor,nombre_proveedor,estado_proveedor,direccion_proveedor)
                VALUES(
                       '".$this->rut_proveedor."',
                       '".$this->nombre_proveedor."',
                       '".$this->estado_proveedor."',
                       '".$this->direccion_proveedor."');";
        $save=$this->db()->query($query);
        $this->db()->error;
        return $save;
    }
    
}
