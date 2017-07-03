<?php

class UsuariosController extends ControladorBase {

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
                    $this->mostrarUsuarios();
                } else {

                    $this->mostrarUsuarios();
                }
            }
        }
        $this->mostrarUsuarios();
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
        if (isset($_REQUEST["rutUsuario"])) {

            //Creamos un usuario
            $usuario = new Usuario($this->adapter);
            $usuario->setRut($_REQUEST["rutUsuario"]);
            $usuario->setNombre($_REQUEST["nombreUsuario"]);
            $usuario->setIdperfil($_REQUEST["idperfil"]);
            $usuario->setClave(md5($_REQUEST["password"]));
            $save = $usuario->save();
            $_SESSION["mensaje"]="El usuario se ha ingresado correctamente";
        }
        
        $this->redirect("Usuarios", "index");
    }

    public function update() {

        if (isset($_REQUEST["id"])) {

            //Creamos un usuario

            $usuario = new Usuario($this->adapter);
            $usuario->setRut($_REQUEST["rutUsuarioe"]);
            $usuario->setNombre($_REQUEST["nombreUsuarioe"]);
            $usuario->setid($_REQUEST["id"]);
            $usuario->setIdperfil($_REQUEST["idperfile"]);
            $clavel=  trim($_REQUEST["passworde"]);
             if($clavel != "")
            {
               $usuario->setClave(md5($_REQUEST["passworde"]));
                $up=$usuario->update();
                $_SESSION["mensaje"]="El usuario se ha modificado correctamente";
            } else {
                $up=$usuario->updateSinClave();
                $_SESSION["mensaje"]="El usuario se ha modificado correctamente, manteniendo su clave";
            }   
        }
        $this->redirect("Usuarios", "index");
    }

    public function borrar() {
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];


            $usuario = new Usuario($this->adapter);
            $usuario->deleteById($id);
        }
        $this->redirect("Usuarios", "index");
    }

    public function mostrarUsuarios() {

        $query = "SELECT * FROM usuario INNER JOIN perfil on usuario.perfil_idperfil=perfil.idperfil ORDER BY idusuario ASC";
        $res = $this->adapter->query($query);

        $num_registros = mysqli_num_rows($res);
        $resul_x_pagina = 3;

        $paginacion = new Zebra_Pagination();
        $paginacion->records($num_registros);
        $paginacion->records_per_page($resul_x_pagina);

        $consulta = "SELECT * FROM usuario INNER JOIN perfil on usuario.perfil_idperfil=perfil.idperfil ORDER BY idusuario ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
        $result = $this->adapter->query($consulta);
        /* while ($row = $result->fetch_object()) {
          $resultSet[]=$row;
          } */




        $allperfiles = $this->adapter->query("SELECT * FROM perfil");
        while ($row = $allperfiles->fetch_object()) {
            $resultSet[] = $row;
        }
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
