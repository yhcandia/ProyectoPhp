<?php

class Perfil extends EntidadBase{
    private $idperfil;
    private $nombre;
 
    
    
        
    public function __construct($adapter) {
        $table="perfil";
        parent::__construct($table, $adapter);
    }
    
    function getIdperfil() {
        return $this->idperfil;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setIdperfil($idperfil) {
        $this->idperfil = $idperfil;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

        
    public function save(){
        $query="INSERT INTO rol (nombre)
                VALUES('".$this->nombre."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
    


}
