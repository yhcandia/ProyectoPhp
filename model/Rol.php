<?php
/**
 * Description of Rol
 *
 * @author Vito
 */
class Rol extends EntidadBase{
    private $idRol;
    private $nombreRol;
    private $estadoRol;
    
    
    function getEstadoRol() {
        return $this->estadoRol;
    }

    function setEstadoRol($estadoRol) {
        $this->estadoRol = $estadoRol;
    }

        
    public function __construct($adapter) {
        $table="rol";
        parent::__construct($table, $adapter);
    }
    
    function getIdRol() {
        return $this->idRol;
    }

    function getNombreRol() {
        return $this->nombreRol;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    function setNombreRol($nombreRol) {
        $this->nombreRol = $nombreRol;
    }
    
    public function save(){
        $query="INSERT INTO rol (id_rol,estado_rol,nombre_rol)
                VALUES('".NULL."',
                       '".$this->estadoRol."',
                       '".$this->nombreRol."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
    public function update($id){
        $query="UPDATE rol SET nombre_rol = '$this->nombreRol',"
                . "estado_rol='$this->estadoRol' where id_rol= '$id'";
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }


}
