<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProveedorMaterial
 *
 * @author cetecom
 */
class ProveedorMaterial extends EntidadBase{
    private $id_proveedor_material;
    private $id_material;
    private $id_proveedor;
    private $cantidad_comprada;
    private $precio_unitario;
    private $fecha_compra;
    
     public function __construct($adapter) {
        $table="proveedor_material";
        parent::__construct($table, $adapter);
    }
    
    function getId_proveedor_material() {
        return $this->id_proveedor_material;
    }

    function getId_material() {
        return $this->id_material;
    }

    function getId_proveedor() {
        return $this->id_proveedor;
    }

    function getCantidad_comprada() {
        return $this->cantidad_comprada;
    }

    function getPrecio_unitario() {
        return $this->precio_unitario;
    }

    function getFecha_compra() {
        return $this->fecha_compra;
    }

    function setId_proveedor_material($id_proveedor_material) {
        $this->id_proveedor_material = $id_proveedor_material;
    }

    function setId_material($id_material) {
        $this->id_material = $id_material;
    }

    function setId_proveedor($id_proveedor) {
        $this->id_proveedor = $id_proveedor;
    }

    function setCantidad_comprada($cantidad_comprada) {
        $this->cantidad_comprada = $cantidad_comprada;
    }

    function setPrecio_unitario($precio_unitario) {
        $this->precio_unitario = $precio_unitario;
    }

    function setFecha_compra($fecha_compra) {
        $this->fecha_compra = $fecha_compra;
    }

    public function update($id){
        $query="UPDATE proveedor_material SET id_material= '$this->id_material',"
                . "id_proveedor = '$this->id_proveedor',"
                . "cantidad_comprada = '$this->cantidad_comprada',"
                . "precio_unitario = '$this->precio_unitario',"
                . "fecha_compra='$this->fecha_compra' where id_proveedor_material= '$id'";
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }

    public function save(){
        $query="INSERT INTO proveedor_material (id_material,id_proveedor,cantidad_comprada,precio_unitario,fecha_compra)
                VALUES('".$this->id_material."',
                       '".$this->id_proveedor."',
                       '".$this->cantidad_comprada."',
                       '".$this->precio_unitario."',
                       '".$this->fecha_compra."');";
        
        $save=$this->db()->query($query);
        $this->db()->error;
        return $save;
    }
    
}
