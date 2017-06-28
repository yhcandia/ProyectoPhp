<?php
/**
 * Description of Categoria
 *
 * @author Vito
 */
class Prestamo extends EntidadBase{
    private $id_prestamo;
    private $rut_usuario;
    private $id_material;
    private $cantidad;
    private $fecha_prestamo;
    private $fecha_limite;
    private $estado_prestamo;
    private $observacion;
    
    public function __construct($adapter) {
        $table="prestamo";
        parent::__construct($table, $adapter);
    }
    
    function getId_prestamo() {
        return $this->id_prestamo;
    }

    function getRut_usuario() {
        return $this->rut_usuario;
    }

    function getId_material() {
        return $this->id_material;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getFecha_prestamo() {
        return $this->fecha_prestamo;
    }

    function getFecha_limite() {
        return $this->fecha_limite;
    }

    function getEstado_prestamo() {
        return $this->estado_prestamo;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function setId_prestamo($id_prestamo) {
        $this->id_prestamo = $id_prestamo;
    }

    function setRut_usuario($rut_usuario) {
        $this->rut_usuario = $rut_usuario;
    }

    function setId_material($id_material) {
        $this->id_material = $id_material;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setFecha_prestamo($fecha_prestamo) {
        $this->fecha_prestamo = $fecha_prestamo;
    }

    function setFecha_limite($fecha_limite) {
        $this->fecha_limite = $fecha_limite;
    }

    function setEstado_prestamo($estado_prestamo) {
        $this->estado_prestamo = $estado_prestamo;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

        
    public function save(){
        $query="INSERT INTO prestamo (id_prestamo,rut_usuario,id_material,cantidad,fecha_prestamo,fecha_limite,observacion,estado_prestamo)
                VALUES('".NULL."',
                       '".$this->rut_usuario."',
                       '".$this->id_material."',
                       '".$this->cantidad."',
                       '".$this->fecha_prestamo."',
                       '".$this->fecha_limite."',
                       '".$this->observacion."',
                       '".$this->estado_prestamo."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    public function saveProfesor(){
        $query="INSERT INTO prestamo (id_prestamo,rut_usuario,id_material,cantidad,fecha_prestamo,fecha_limite,observacion,estado_prestamo)
                VALUES('".NULL."',
                       '".$this->rut_usuario."',
                       '".$this->id_material."',
                       '".$this->cantidad."',
                       '".$this->fecha_prestamo."',
                       '".NULL."',
                       '".$this->observacion."',
                       '3');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
    public function update($id){
        $query="UPDATE prestamo SET rut_usuario= '$this->rut_usuario',"
                . "id_material = '$this->id_material',"
                . "cantidad = '$this->cantidad',"
                . "fecha_prestamo = '$this->fecha_prestamo',"
                . "fecha_limite = '$this->fecha_limite',"
                . "observacion = '$this->observacion',"
                . "estado_prestamo='$this->estado_prestamo' where id_prestamo= '$id'";
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }


}
