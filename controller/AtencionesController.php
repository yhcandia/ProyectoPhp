<?php

class AtencionesController extends ControladorBase {

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

        if (isset($_SESSION['session'])) {
            if ($_SESSION["session"]["idRol"] == "1") {

                if (isset($_SESSION["buscado"]) && isset($_SESSION["buscarpor"])) {
                    unset($_SESSION["buscado"]);
                    unset($_SESSION["buscarpor"]);
                    if(isset($_SESSION["num_registros"])){
                        unset($_SESSION["num_registros"]);
                       
                        
                    }else{
                       $this->verificador() ;
                    }
                    $this->mostrarAtenciones();
                } else {
                    if(isset($_SESSION["num_registros"])){
                        unset($_SESSION["num_registros"]);
                         
                    }else{
                       $this->verificador() ;
                    }
                    $this->mostrarAtenciones();
                }
            }
        }
        $this->mostrarAtenciones();
    }

    public function login() {

        if (isset($_REQUEST["nnombre"]) && isset($_REQUEST["npassword"])) {
            $oUsu = new Usuario($this->adapter);
            $oUsu->setRut($_REQUEST["nnombre"]);
            $oUsu->setClave(md5($_REQUEST["npassword"]));
            if ($oUsu->VerificaUsuarioClave()) {
                //echo "Todo bien";
                $_SESSION["session"]["nombreUsuario"] = $oUsu->getNombre();
                $_SESSION["session"]["idRol"] = $oUsu->getIdperfil();
                $_SESSION["session"]["rutUsuario"] = $oUsu->getRut();
                $this->redirect("index", "index");
            } else {
                $this->view("login", array(
                    "error" => "El usuario o la clave es incorrecta"
                ));
            }
        } else {
            $this->view("login", array(
                "error" => ""
            ));
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect("Usuarios", "index");
    }

    public function crear() {
        if (isset($_REQUEST["fecha"])) {

            //Creamos un usuario
            $atencion = new Atencion($this->adapter);
            $date=$_REQUEST["fecha"];
            $time=$_REQUEST["time"];
            $id_cliente=$_REQUEST["idcliente"];
            $id_abogado=$_REQUEST["idabogado"];
            $fechadatetime=$atencion->fechayhora($date,$time);
            $atencion->setAbogado_id($id_abogado);
            $atencion->setCliente_id($id_cliente);
            $atencion->setFecha($fechadatetime);
            $save=$atencion->save();
            $_SESSION["mensaje"]="Se guardo correctamente la atención";
        }
        
        $this->redirect("Atenciones", "index");
    }

    public function update() {

        if (isset($_REQUEST["id"])) {

            //Creamos un usuario

            $atencion = new Atencion($this->adapter);
            $atencion->setId($_REQUEST["id"]);
            $atencion->setEstado($_REQUEST["estado"]);
            $up=$atencion->update();
            
        }
        $this->redirect("Atenciones", "index");
    }

    public function borrar() {
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];


            $usuario = new Usuario($this->adapter);
            $usuario->deleteById($id);
        }
        $this->redirect("Usuarios", "index");
    }
    public function anular() {
      if (isset($_REQUEST["id"])) {

            //Creamos un usuario

            $atencion = new Atencion($this->adapter);
            $atencion->setId($_REQUEST["id"]);
            $atencion->setEstado("ANULADA");
            $up=$atencion->update();
            
        }
        $this->redirect("Atenciones", "index");
    }

    public function verificador() {
        $query = "SELECT * FROM atencion";
        $res = $this->adapter->query($query);
        $num_registros = mysqli_num_rows($res);
        if ($num_registros == 0) {
            $this->redirect("Atenciones", "index");
            $_SESSION["num_registros"]=0;
            } else {
                while ($roww = $res->fetch_object()) {
                    $resultSet2[] = $roww;
                }
                $arreglo=array();
                foreach ($resultSet2 as $row){
                    $date =$row->fecha_atencion;
                    
                    $array=explode("-", $date); // Sacar día 
                    $dia=explode(" ",$array[2]); // Sacar sobrante
                    $dia=$dia[0]; //obtener día
                    $mes=$array[1];
                    $ano=$array[0];
                    //print_r ($dia);
                    $fechaactual=date('Y-m-d');
                    $fechaactual=  explode("-", $fechaactual);
                    $diaactual=$fechaactual[2]-1;
                    $mesactual=$fechaactual[1];
                    $anoactual=$fechaactual[0];
                    
                    $diferencia=$dia-$diaactual;
                    
                    if($ano==$anoactual){
                    if($diferencia<3){
                        if($diferencia<2 && $row->estado!="CONFIRMADA" && $row->estado!="REALIZADA"){
                            $objat=new Atencion($this->adapter);
                            $objat->setId($row->id_atencion);
                            $objat->setEstado("ANULADA");
                            $objat->update();
                            
                        }else{
                            if($diferencia=2 && $row->estado!="CONFIRMADA" && $row->estado!="REALIZADA"){
                            array_push($arreglo, $row->id_atencion);
                            }
                            // $_SESSION["mensaje"]="La atencion de id = ".$row->id_atencion." debe ser confirmada";
                        }
                    }
                    if(!empty($arreglo)){
                         $_SESSION["debemodificar"]=$arreglo;
                    }
                   // print_r ($diferencia);
                    //print_r ($diaactual);
                    }else{
                        if($ano<$anoactual){
                            $objat=new Atencion($this->adapter);
                            $objat->setId($row->id_atencion);
                            $objat->setEstado("ANULADA");
                            $objat->update();
                        }
                    }
                }
                
               
            }
        
        
    }
    public function mostrarAtenciones() {

        $query = "SELECT *,cliente.rut as rut_cliente ,abogado.rut as rut_abogado,"
                . "abogado.nombre_completo as nombre_abogado, cliente.nombre_completo as nombre_cliente "
                . "FROM atencion INNER JOIN cliente on atencion.cliente_id=cliente.id "
                . "INNER JOIN abogado on atencion.abogado_id=abogado.id"
                . " ORDER BY id_atencion ASC";
        $res = $this->adapter->query($query);

        $num_registros = mysqli_num_rows($res);
        $resul_x_pagina = 5;

        $paginacion = new Zebra_Pagination();
        $paginacion->records($num_registros);
        $paginacion->records_per_page($resul_x_pagina);

        $consulta = "SELECT *,cliente.rut as rut_cliente ,abogado.rut as rut_abogado,"
                . "abogado.nombre_completo as nombre_abogado, cliente.nombre_completo as nombre_cliente "
                . "FROM atencion INNER JOIN cliente on atencion.cliente_id=cliente.id "
                . "INNER JOIN abogado on atencion.abogado_id=abogado.id "
                . "ORDER BY id_atencion ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
        $result = $this->adapter->query($consulta);
        /* while ($row = $result->fetch_object()) {
          $resultSet[]=$row;
          } */
       $allabogados = $this->adapter->query("SELECT * FROM abogado");
        while ($row = $allabogados->fetch_object()) {
            $resultSetAbo[] = $row;
        }
        $allclientes = $this->adapter->query("SELECT * FROM cliente");
        while ($rowww = $allclientes->fetch_object()) {
            $resultSetCli[] = $rowww;
        }
        while ($roww = $result->fetch_object()) {
            $resultSet2[] = $roww;
        }
         if ($num_registros == 0) {
                $this->view("atencion", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => NULL,
                    "abogados" => $resultSetAbo,
                    "clientes" => $resultSetCli
                   
                ));
            } else {
                while ($roww = $result->fetch_object()) {
                    $resultSet2[] = $roww;
                }
                $this->view("atencion", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => $resultSet2,
                    "abogados" => $resultSetAbo,
                    "clientes" => $resultSetCli
                ));
            }
       
    }

    public function buscarNombreUsuario() {
        if (isset($_REQUEST["name"]) || isset($_SESSION['buscado'])) {
            if (isset($_REQUEST["name"]) && isset($_REQUEST["buscarpor"])) {
                $name = utf8_encode($_REQUEST['name']);
                $name = trim($name);
                $buscarpor = utf8_encode($_REQUEST['buscarpor']);
            } else {
                $name = utf8_encode($_SESSION['buscado']);
                $name = trim($name);
                $buscarpor = $_SESSION['buscarpor'];
            }
            $query = "SELECT * FROM usuario INNER JOIN perfil on usuario.perfil_idperfil=perfil.idperfil WHERE " . $buscarpor . " LIKE '%" . $name . "%' ORDER BY " . $buscarpor . " ASC";
            $res = $this->adapter->query($query);
            $num_registros = mysqli_num_rows($res);

            $resul_x_pagina = 3;

            $paginacion = new Zebra_Pagination();
            $paginacion->records($num_registros);
            $paginacion->records_per_page($resul_x_pagina);

            $consulta = "SELECT * FROM usuario INNER JOIN perfil on usuario.perfil_idperfil=perfil.idperfil WHERE " . $buscarpor . " LIKE '%" . $name . "%' ORDER BY " . $buscarpor . " ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . "," . $resul_x_pagina;
            $result = $this->adapter->query($consulta);
            $allperfiles = $this->adapter->query("SELECT * FROM perfil");
            while ($row = $allperfiles->fetch_object()) {
                $resultSet[] = $row;
            }

            $_SESSION['buscado'] = $name;
            $_SESSION['buscarpor'] = $buscarpor;
            if ($num_registros == 0) {
                $this->view("usuario", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => NULL,
                    "perfiles" => $resultSet
                ));
            } else {
                while ($roww = $result->fetch_object()) {
                    $resultSet2[] = $roww;
                }
                $this->view("usuario", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => $resultSet2,
                    "perfiles" => $resultSet
                ));
            }
        } else {
            $this->redirect("Usuarios", "mostrarUsuarios");
        }
    }

}

?>
