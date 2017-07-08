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

        $num_registros1 = null;
        $num_registros2= null;
        $resultGrafico2= null;
        $resultGrafico3= null;
        $resultGrafico4= null;
        $num_reg1= null;
        $num_reg2= null;
        $num_reg3= null;
        $num_reg4= null;
        $num_reg5= null;
        $resultGrafico6= null;
        $resultGrafico7= null;
        
        //grafico 1
        $queryTotalClienteJuridico="SELECT * FROM cliente where tipo_persona='Juridica'";
        $res1 = $this->adapter->query($queryTotalClienteJuridico);
        $num_registros1 = mysqli_num_rows($res1);
        $queryTotalClienteNatural="SELECT * FROM cliente where tipo_persona='Natural'";
        $res2 = $this->adapter->query($queryTotalClienteNatural);
        $num_registros2 = mysqli_num_rows($res2);
        
        //grafico 2
        $queryAtencionesClientes="SELECT atencion.cliente_id as id_cliente, cliente.nombre_completo as nombre, COUNT(atencion.cliente_id) as cantidad FROM cliente INNER JOIN atencion ON cliente.id = atencion.cliente_id GROUP BY atencion.cliente_id;";
        $res3 = $this->adapter->query($queryAtencionesClientes);
        while ($row = $res3->fetch_object()) {
            $resultGrafico2[] = $row;
        } 
        //grafico 3
        $queryFechaClientes="SELECT * FROM cliente;";
        $res4 = $this->adapter->query($queryFechaClientes);
        while ($row2 = $res4->fetch_object()) {
            $resultGrafico3[] = $row2;
        }
        
        //grafico 4
        $queryAtencionesAbogado="SELECT atencion.abogado_id as id_abogado, abogado.nombre_completo as nombre, COUNT(atencion.abogado_id) as cantidad FROM abogado INNER JOIN atencion ON abogado.id = atencion.abogado_id GROUP BY atencion.abogado_id;";
        $res5 = $this->adapter->query($queryAtencionesAbogado);
        while ($row = $res5->fetch_object()) {
            $resultGrafico4[] = $row;
        }
        
        //grafico 5
        $queryEstado1="SELECT * FROM atencion where estado='REALIZADA'";
        $resp1 = $this->adapter->query($queryEstado1);
        $num_reg1 = mysqli_num_rows($resp1);
         $queryEstado2="SELECT * FROM atencion where estado='AGENDADA'";
        $resp2 = $this->adapter->query($queryEstado2);
        $num_reg2 = mysqli_num_rows($resp2);
         $queryEstado3="SELECT * FROM atencion where estado='CONFIRMADA'";
        $resp3 = $this->adapter->query($queryEstado3);
        $num_reg3 = mysqli_num_rows($resp3);
         $queryEstado4="SELECT * FROM atencion where estado='PERDIDA'";
        $resp4 = $this->adapter->query($queryEstado4);
        $num_reg4 = mysqli_num_rows($resp4);
        $queryEstado5="SELECT * FROM atencion where estado='ANULADA'";
        $resp5 = $this->adapter->query($queryEstado5);
        $num_reg5 = mysqli_num_rows($resp5);
        
        //grafico 6
        $queryEspecialidadAtencion=" SELECT atencion.abogado_id as id_abogado, abogado.especialidad as especialidad, COUNT(atencion.abogado_id) as cantidad FROM abogado INNER JOIN atencion ON abogado.id = atencion.abogado_id GROUP BY abogado.especialidad;";
        $res6 = $this->adapter->query($queryEspecialidadAtencion);
        while ($row = $res6->fetch_object()) {
            $resultGrafico6[] = $row;
        }
        //grafico 7
        $queryMesAtencion="SELECT MONTH(atencion.fecha_atencion) as mes,count(*) as cantidad from atencion GROUP BY MONTH(atencion.fecha_atencion);";
        $res7 = $this->adapter->query($queryMesAtencion);
        while ($row = $res7->fetch_object()) {
            $resultGrafico7[] = $row;
        }
        
        $this->view("grafico", array(
                "numJuridica" => $num_registros1,
                "numNatural" => $num_registros2,
                "grafico2" => $resultGrafico2,
                "grafico3" => $resultGrafico3,
                "grafico4" => $resultGrafico4,
                "numRealizada" => $num_reg1,
                "numAgendada" => $num_reg2,
                "numConfirmada" => $num_reg3,
                "numPerdida" => $num_reg4,
                "numAnulada" => $num_reg5,
                "grafico6" => $resultGrafico6,
                "grafico7" => $resultGrafico7
        ));      
    }

 
}

?>
