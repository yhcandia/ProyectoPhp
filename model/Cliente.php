<?php
class Cliente extends EntidadBase{
    private $id;
    private $rut;
    private $nombrecliente;
    private $clave;  
    private $fechaIncoporacion;
    private $tipoPersona;
    private $direccion;
    private $telefono;
    
    public function __construct($adapter) {
        $table="cliente";
        parent::__construct($table, $adapter);
    }
  
    function getId() {
        return $this->id;
    }

    function getRut() {
        return $this->rut;
    }

    function getNombre() {
        return $this->nombrecliente;
    }

    function getClave() {
        return $this->clave;
    }

    function getFechaIncoporacion() {
        return $this->fechaIncoporacion;
    }

    function getTipoPersona() {
        return $this->tipoPersona;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombre($nombrecliente) {
        $this->nombrecliente = $nombrecliente;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setFechaIncoporacion($fechaIncoporacion) {
        $this->fechaIncoporacion = $fechaIncoporacion;
    }

    function setTipoPersona($tipoPersona) {
        $this->tipoPersona = $tipoPersona;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function update(){
        $query="UPDATE cliente SET "
                . "rut = '$this->rut',"
                . "nombre_completo = '$this->nombrecliente',"
                . "fecha_incorporacion = '$this->fechaIncoporacion',"
                . "tipo_persona = '$this->tipoPersona',"
                . "direccion = '$this->direccion',"
                . "telefonos = '$this->telefono' where rut= '$this->rut'";
        
        $query2="UPDATE usuario SET "
                . "rut = '$this->rut',"
                . "nombreusuario = '$this->nombrecliente',"
                . "clave = '$this->clave',"
                . "perfil_idperfil = '$this->idperfil' where rut= '$this->rut'";
        $update2=$this->db()->query($query2);
        $this->db()->error;
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }
    public function updateSinClave(){
        $query="UPDATE cliente SET "
                . "rut = '$this->rut',"
                . "nombre_completo = '$this->nombrecliente',"
                . "fecha_incorporacion = '$this->fechaIncoporacion',"
                . "tipo_persona = '$this->tipoPersona',"
                . "direccion = '$this->direccion',"
                . "telefonos = '$this->telefono' where rut= '$this->rut'";
        
        $query2="UPDATE usuario SET "
                . "rut = '$this->rut',"
                . "nombreusuario = '$this->nombrecliente',"
                . "perfil_idperfil = '$this->idperfil' where rut= '$this->rut'";
        $update2=$this->db()->query($query2);
        $this->db()->error;
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }
    
    public function save(){
        $query="INSERT INTO cliente (rut,nombre_completo,fecha_incorporacion,tipo_persona,direccion,telefonos)
                VALUES('".$this->rut."',
                       '".$this->nombrecliente."',
                       '".$this->fechaIncoporacion."',
                       '".$this->tipoPersona."',
                       '".$this->direccion."',
                       '".$this->telefono."');";
        $query2="INSERT INTO usuario (rut,nombreusuario,clave,perfil_idperfil)
                VALUES('".$this->rut."',
                       '".$this->nombrecliente."',
                       '".$this->clave."',
                       '5');";
        $save2=$this->db()->query($query2);
        $this->db()->error;
        $save=$this->db()->query($query);
        $this->db()->error;
        return $save;
    }
}
?>