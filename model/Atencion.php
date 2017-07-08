<?php
class Atencion extends EntidadBase{
    private $id;
    private $fecha;
    private $cliente_id;
    private $abogado_id;
    private $estado;
    
    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getCliente_id() {
        return $this->cliente_id;
    }

    function getAbogado_id() {
        return $this->abogado_id;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCliente_id($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    function setAbogado_id($abogado_id) {
        $this->abogado_id = $abogado_id;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        
    public function __construct($adapter) {
        $table="cliente";
        parent::__construct($table, $adapter);
    }
    
   

    public function fechayhora($date,$time){
        
        $date = explode("-", $date); 
    
         
        $time = explode(":", $time); 
    
        $tz_string = "Chile/Continental"; // Use one from list of TZ names http://php.net/manual/en/timezones.php 
        $tz_object = new DateTimeZone($tz_string); 

        $datetime = new DateTime(); 
        $datetime->setTimezone($tz_object); 
        $datetime->setDate($date[0], $date[1], $date[2]); 
        $datetime->setTime($time[0], $time[1], 00); 
        
        return $datetime->format('Y/m/d H:i:s');

    }
    public function update(){
     $query="UPDATE atencion SET "
             . "estado = '$this->estado' where id_atencion= '$this->id'";
     $update=$this->db()->query($query);
        $this->db()->error;
        return $update;
    }
   
    
    public function save(){
        $query="INSERT INTO atencion (fecha_atencion, cliente_id, abogado_id, estado)
                VALUES('".$this->fecha."',
                       '".$this->cliente_id."',
                       '".$this->abogado_id."',
                       'AGENDADA');";
        
        $save=$this->db()->query($query);
        $this->db()->error;
        return $save;
    }
}
?>