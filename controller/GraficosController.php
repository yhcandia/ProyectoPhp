<?php

class GraficosController extends ControladorBase {

    public $conectar;
    public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function getAdapter() {
        return $this->adapter;
    }

    public function index() { 

        $queryTotalClienteJuridico="SELECT * FROM cliente where tipo_persona='Juridica'";
        $res1 = $this->adapter->query($queryTotalClienteJuridico);
        $num_registros1 = mysqli_num_rows($res1);
        $queryTotalClienteNatural="SELECT * FROM cliente where tipo_persona='Natural'";
        $res2 = $this->adapter->query($queryTotalClienteNatural);
        $num_registros2 = mysqli_num_rows($res2);
        
        $queryAtencionesClientes="SELECT atencion.cliente_id as id_cliente, cliente.nombre_completo as nombre, COUNT(atencion.cliente_id) as cantidad FROM cliente INNER JOIN atencion ON cliente.id = atencion.cliente_id GROUP BY atencion.cliente_id;";
        $res3 = $this->adapter->query($queryAtencionesClientes);
        while ($row = $res3->fetch_object()) {
            $resultGrafico2[] = $row;
        }
        
        $queryFechaClientes="SELECT * FROM cliente;";
        $res4 = $this->adapter->query($queryFechaClientes);
        while ($row2 = $res4->fetch_object()) {
            $resultGrafico3[] = $row2;
        }

        $this->view("grafico", array(
                "numJuridica" => $num_registros1,
                "numNatural" => $num_registros2,
                "grafico2" => $resultGrafico2,
                "grafico3" => $resultGrafico3
        ));       
    }

 
}

?>
