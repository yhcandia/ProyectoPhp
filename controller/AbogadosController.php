<?php

class AbogadosController extends ControladorBase {

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
                    $this->mostrarAbogados();
                } else {

                    $this->mostrarAbogados();
                }
            }
        }
        $this->mostrarAbogados();
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
        $this->redirect("Abogados", "index");
    }

    public function crear() {
        $rutValida = $_REQUEST["rutUsuario"]; 
        $queryValida="SELECT * FROM abogado where rut='$rutValida'";
        $res = $this->adapter->query($queryValida);
        $num_registros = mysqli_num_rows($res);
        if($num_registros<=0){
            if (isset($_REQUEST["rutUsuario"])) {

                //Creamos un usuario
                $abogado = new Abogado($this->adapter);
                $abogado->setRut($_REQUEST["rutUsuario"]);
                $abogado->setNombreCompleto($_REQUEST["nombreAbogado"]);
                $abogado->setEspecialidad($_REQUEST["especialidadAbogado"]);
                $abogado->setFechaContratacion($_REQUEST["fechaAbogado"]);
                $abogado->setValorHora($_REQUEST["valorAbogado"]);
                $save = $abogado->save();
                $_SESSION["mensaje"]="El abogado se ha ingresado correctamente";
            }
        }else{
               $_SESSION["mensaje"]="El abogado ya existe!";
        }
        $this->redirect("abogados", "index");
    }

    public function update() {

        if (isset($_REQUEST["id"])) {

            $abogado = new Abogado($this->adapter);
            $abogado->setId($_REQUEST["id"]);
            $abogado->setRut($_REQUEST["rutAbogadoe"]);
            $abogado->setNombreCompleto($_REQUEST["nombreAbogadoe"]);
            $abogado->setEspecialidad($_REQUEST["especialidadAbogadoe"]);
            $abogado->setFechaContratacion($_REQUEST["fechaAbogadoe"]);
            $abogado->setValorHora($_REQUEST["valorAbogadoe"]);
            $up=$abogado->update();
            $_SESSION["mensaje"]="El abogado se ha modificado correctamente";           
        }
        $this->redirect("Abogados", "index");
    }

    public function borrar() {
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $cliente = new Cliente($this->adapter);
            $cliente->deleteByIdAbogado($id);
        }
        $this->redirect("Abogados", "index");
    }

    public function mostrarAbogados() {

        $query = "SELECT * FROM abogado ORDER BY rut ASC";
        $res = $this->adapter->query($query);

        $num_registros = mysqli_num_rows($res);
        $resul_x_pagina = 3;

        $paginacion = new Zebra_Pagination();
        $paginacion->records($num_registros);
        $paginacion->records_per_page($resul_x_pagina);

        $consulta = "SELECT * FROM abogado ORDER BY rut ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
        $result = $this->adapter->query($consulta);

        $allperfiles = $this->adapter->query("SELECT * FROM perfil");
    
        while ($row = $allperfiles->fetch_object()) {
            $resultSet[] = $row;
        }
        if ($num_registros != 0) {
            while ($roww = $result->fetch_object()) {
                $resultSet2[] = $roww;
            }
       
            $this->view("abogado", array(
                "paginacion" => $paginacion,
                "num_registros" => $num_registros,
                "result" => $resultSet2,
                "perfiles" => $resultSet
            ));
        }else{
              $this->view("abogado", array(
                "paginacion" => $paginacion,
                "num_registros" => $num_registros,
                "result" => null,
                "perfiles" => $resultSet
            ));
        }
    }

    public function buscarNombreAbogado() {
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
            $query = "SELECT * FROM abogado WHERE " . $buscarpor . " LIKE '%" . $name . "%' ORDER BY " . $buscarpor . " ASC";
            $res = $this->adapter->query($query);
            $num_registros = mysqli_num_rows($res);

            $resul_x_pagina = 3;

            $paginacion = new Zebra_Pagination();
            $paginacion->records($num_registros);
            $paginacion->records_per_page($resul_x_pagina);

            $consulta = "SELECT * FROM abogado WHERE " . $buscarpor . " LIKE '%" . $name . "%' ORDER BY " . $buscarpor . " ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . "," . $resul_x_pagina;
            $result = $this->adapter->query($consulta);
            $allperfiles = $this->adapter->query("SELECT * FROM perfil");
            while ($row = $allperfiles->fetch_object()) {
                $resultSet[] = $row;
            }

            $_SESSION['buscado'] = $name;
            $_SESSION['buscarpor'] = $buscarpor;
            if ($num_registros == 0) {
                $this->view("abogado", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => NULL,
                    "perfiles" => $resultSet
                ));
            } else {
                while ($roww = $result->fetch_object()) {
                    $resultSet2[] = $roww;
                }
                $this->view("abogado", array(
                    "paginacion" => $paginacion,
                    "num_registros" => $num_registros,
                    "result" => $resultSet2,
                    "perfiles" => $resultSet
                ));
            }
        } else {
            $this->redirect("Abogados", "mostrarAbogados");
        }
    }

}

?>
