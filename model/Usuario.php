<?php
class Usuario extends EntidadBase{
    private $id;
    private $rut;
    private $nombre;
    private $clave;
    private $idperfil;    
    
    
    public function __construct($adapter) {
        $table="usuario";
        parent::__construct($table, $adapter);
    }
  
    function getId() {
        return $this->id;
    }

    function getRut() {
        return $this->rut;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getClave() {
        return $this->clave;
    }

    function getIdperfil() {
        return $this->idperfil;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setIdperfil($idperfil) {
        $this->idperfil = $idperfil;
    }

        
    public function update(){
        $query="UPDATE usuario SET "
                . "rut = '$this->rut',"
                . "nombreusuario = '$this->nombre',"
                . "clave = '$this->clave',"
                . "perfil_idperfil = '$this->idperfil' where idusuario= '$this->id'";
        $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }
    
    public function save(){
        $query="INSERT INTO usuario (rut,nombreusuario,clave,perfil_idperfil)
                VALUES('".$this->rut."',
                       '".$this->nombre."',
                       '".$this->clave."',
                       '".$this->idperfil."');";
        $save=$this->db()->query($query);
        $this->db()->error;
        return $save;
    }
    function VerificaUsuarioClave(){
        $sql="SELECT * FROM usuario WHERE rut='$this->rut' and clave='$this->clave'";
              
        $resultado=  $this->db()->query($sql);
               
        if ($resultado->num_rows>=1){
            $row = $resultado->fetch_row();
            $this->id = $row[0];
            $this->rut = $row[1];
            $this->nombre=$row[2];
            $this->clave= $row[3];
            $this->idperfil = $row[4];
            return true;
        }else{
            return false;
        }
    }
    

}
?>