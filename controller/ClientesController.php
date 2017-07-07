<?php

class ClientesController extends ControladorBase {

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
                    $this->mostrarClientes();
                } else {

                    $this->mostrarClientes();
                }
            }
        }
        $this->mostrarClientes();
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
        $this->redirect("Clientes", "index");
    }

    public function crear() {
        if (isset($_REQUEST["rutUsuario"])) {

            //Creamos un usuario
            $cliente = new Cliente($this->adapter);
            $cliente->setRut($_REQUEST["rutUsuario"]);
            $cliente->setNombre($_REQUEST["nombreCliente"]);
            $cliente->setDireccion($_REQUEST["direccionCliente"]);
            $cliente->setTelefono($_REQUEST["telefonoCliente"]);
            $cliente->setFechaIncoporacion($_REQUEST["fechaCliente"]);
            $cliente->setTipoPersona($_REQUEST["TipoPersona"]);
            $cliente->setClave(md5($_REQUEST["password"]));
            $save = $cliente->save();
            $_SESSION["mensaje"]="El cliente se ha ingresado correctamente";
        }
        
        $this->redirect("Clientes", "index");
    }

    public function update() {

        if (isset($_REQUEST["id"])) {

            //Creamos un usuario

            $cliente = new Cliente($this->adapter);
            $cliente->setId($_REQUEST["id"]);
            $cliente->setRut($_REQUEST["rutClientee"]);
            $cliente->setNombre($_REQUEST["nombreClientee"]);
            $cliente->setTelefono($_REQUEST["telefonoClientee"]);
            $cliente->setDireccion($_REQUEST["direccionClientee"]);
            $cliente->setFechaIncoporacion($_REQUEST["fechaClientee"]);
            $cliente->setTipoPersona($_REQUEST["TipoPersonae"]);
            $clavel=  trim($_REQUEST["passworde"]);
             if($clavel != "")
            {
               $cliente->setClave(md5($_REQUEST["passworde"]));
                $up=$cliente->update();
                $_SESSION["mensaje"]="El cliente se ha modificado correctamente";
            } else {
                $up=$cliente->updateSinClave();
                $_SESSION["mensaje"]="El cliente se ha modificado correctamente, manteniendo su clave";
            }   
        }
        $this->redirect("Clientes", "index");
    }

    public function borrar() {
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $cliente = new Cliente($this->adapter);
            $cliente->deleteByCliente($id);
        }
        $this->redirect("Clientes", "index");
    }

    public function mostrarClientes() {

        $query = "SELECT * FROM cliente ORDER BY rut ASC";
        $res = $this->adapter->query($query);

        $num_registros = mysqli_num_rows($res);
        $resul_x_pagina = 3;

        $paginacion = new Zebra_Pagination();
        $paginacion->records($num_registros);
        $paginacion->records_per_page($resul_x_pagina);

        $consulta = "SELECT * FROM cliente ORDER BY rut ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
        $result = $this->adapter->query($consulta);

        $allperfiles = $this->adapter->query("SELECT * FROM perfil");
    
        while ($row = $allperfiles->fetch_object()) {
            $resultSet[] = $row;
        }
        if ($num_registros != 0) {
            while ($roww = $result->fetch_object()) {
                $resultSet2[] = $roww;
            }
       
            $this->view("cliente", array(
                "paginacion" => $paginacion,
                "num_registros" => $num_registros,
                "result" => $resultSet2,
                "perfiles" => $resultSet
            ));
        }else{
              $this->view("cliente", array(
                "paginacion" => $paginacion,
                "num_registros" => $num_registros,
                "result" => null,
                "perfiles" => $resultSet
            ));
        }
    }

    public function buscarNombreCliente() {
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
            $query = "SELECT * FROM cliente WHERE " . $buscarpor . " LIKE '%" . $name . "%' ORDER BY " . $buscarpor . " ASC";
            $res = $this->adapter->query($query);
            $num_registros = mysqli_num_rows($res);

            $resul_x_pagina = 3;

            $paginacion = new Zebra_Pagination();
            $paginacion->records($num_registros);
            $paginacion->records_per_page($resul_x_pagina);

            $consulta = "SELECT * FROM cliente WHERE " . $buscarpor . " LIKE '%" . $name . "%' ORDER BY " . $buscarpor . " ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . "," . $resul_x_pagina;
            $result = $this->adapter->query($consulta);
            $allperfiles = $this->adapter->query("SELECT * FROM perfil");
            while ($row = $allperfiles->fetch_object()) {
                $resultSet[] = $row;
            }

            $_SESSION['buscado'] = $name;
            $_SESSION['buscarpor'] = $buscarpor;
            if ($num_registros == 0) {
                $this->view("cliente", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => NULL,
                    "perfiles" => $resultSet
                ));
            } else {
                while ($roww = $result->fetch_object()) {
                    $resultSet2[] = $roww;
                }
                $this->view("cliente", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => $resultSet2,
                    "perfiles" => $resultSet
                ));
            }
        } else {
            $this->redirect("Clientes", "mostrarClientes");
        }
    }

}

?>
