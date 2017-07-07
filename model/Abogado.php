<?php
class Abogado extends EntidadBase{
    private $id;
    private $rut;
    private $nombreCompleto;
    private $clave;  
    private $fechaContratacion;
    private $especialidad;
    private $valorHora;
    
    public function __construct($adapter) {
        $table="abogado";
        parent::__construct($table, $adapter);
    }
  
    function getId() {
        return $this->id;
    }

    function getRut() {
        return $this->rut;
    }

    function getNombreCompleto() {
        return $this->nombreCompleto;
    }

    function getClave() {
        return $this->clave;
    }

    function getFechaContratacion() {
        return $this->fechaContratacion;
    }

    function getEspecialidad() {
        return $this->especialidad;
    }

    function getValorHora() {
        return $this->valorHora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombreCompleto($nombreCompleto) {
        $this->nombreCompleto = $nombreCompleto;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setFechaContratacion($fechaContratacion) {
        $this->fechaContratacion = $fechaContratacion;
    }

    function setEspecialidad($especialidad) {
        $this->especialidad = $especialidad;
    }

    function setValorHora($valorHora) {
        $this->valorHora = $valorHora;
    }

    public function update(){
        $query="UPDATE abogado SET "
                . "rut = '$this->rut',"
                . "nombre_completo = '$this->nombreCompleto',"
                . "fecha_contratacion = '$this->fechaContratacion',"
                . "especialidad = '$this->especialidad',"
                . "valor_hora = '$this->valorHora' where rut= '$this->rut'";
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }
    
    public function save(){     
        $query="INSERT INTO abogado (rut,nombre_completo,fecha_contratacion,especialidad,valor_hora)
                VALUES('".$this->rut."',
                       '".$this->nombreCompleto."',
                       '".$this->fechaContratacion."',
                       '".$this->especialidad."',
                       '".$this->valorHora."');";
        $save=$this->db()->query($query);
        $this->db()->error;
       
        return $save;
        
    }
}
?>