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

                if (isset($_REQUEST["name"])) {
                    $this->buscarNombreUsuario();
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
            
              if($this->valida_rut($usuario->getRut())){
                $save = $usuario->save();
            }else{
                $_SESSION["mensaje"]="Error al ingresar el rut";
                $this->redirect("Usuarios", "mostrarUsuarios");
            }
        }
        $this->redirect("Usuarios", "index");
    }

    public function update() {
        if (isset($_REQUEST["rutUsuario"])) {

            //Creamos un usuario
            
            $usuario = new Usuario($this->adapter);
            $usuario->setRut($_REQUEST["rutUsuario"]);
            $usuario->setNombre($_REQUEST["nombreUsuario"]);
            $usuario->setid($_REQUEST["id"]);
            $usuario->setIdperfil($_REQUEST["idperfil"]);
            $usuario->setClave(md5($_REQUEST["password"]));
            
            if($this->valida_rut($usuario->getRut())){
                $save = $usuario->update();
            }else{
                $_SESSION["mensaje"]="Error al ingresar el rut";
                $this->redirect("Usuarios", "mostrarUsuarios");
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

    public function mostrarUsuarios(){
        
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
                             $resultSet[]=$row;
                        }
                            $this->view("usuario", array(
                            "paginacion" => $paginacion,
                            "num_registros" => $num_registros,
                            "result" => $result,
                            "perfiles" => $resultSet
                        ));
    }
     public function valida_rut($rut) {
        if (strlen($rut) > 10) {
            return false;
        }

        if (strstr($rut, '-') == false) {
            return false;
        }

        $array_rut_sin_guion = explode('-', $rut); // separamos el la cadena del digito verificador. 
        $rut_sin_guion = $array_rut_sin_guion[0]; // la primera cadena 
        $digito_verificador = $array_rut_sin_guion[1]; // el digito despues del guion. 


        if (is_numeric($rut_sin_guion) == false) {
            return false;
        }
        if ($digito_verificador != 'k' and $digito_verificador != 'K') {
            if (is_numeric($digito_verificador) == false) {
                return false;
            }
        }
        $cantidad = strlen($rut_sin_guion); //8 o 7 elementos 
        for ($i = 0; $i < $cantidad; $i++) {//pasamos el rut sin guion a un vector 
            $rut_array[$i] = $rut_sin_guion{$i};
        }


        $i = ($cantidad - 1);
        $x = $i;
        for ($ib = 0; $ib < $cantidad; $ib++) {// ingresamos los elementos del ventor rut_array en otro vector pero al reves. 
            $rut_reverse[$ib] = $rut_array[$i];

            $rut_reverse[$ib];
            $i = $i - 1;
        }

        $i = 2;
        $ib = 0;
        $acum = 0;
        do {
            if ($i > 7) {
                $i = 2;
            }
            $acum = $acum + ($rut_reverse[$ib] * $i);
            $i++;
            $ib++;
        } while ($ib <= $x);

        $resto = $acum % 11;
        $resultado = 11 - $resto;
        if ($resultado == 11) {
            $resultado = 0;
        }
        if ($resultado == 10) {
            $resultado = 'k';
        }
        if ($digito_verificador == 'k' or $digito_verificador == 'K') {
            $digito_verificador = 'k';
        }

        if ($resultado == $digito_verificador) {
            return true;
        } else {
            return false;
        }
    }
    public function buscarNombreUsuario(){
         if (isset($_REQUEST["name"])) {

            $name = utf8_encode($_REQUEST['name']);

            $query = "SELECT * FROM usuario INNER JOIN perfil on usuario.perfil_idperfil=perfil.idperfil WHERE nombreusuario LIKE '%" . $name . "%' ORDER BY nombreusuario ASC";
            $res = $this->adapter->query($query);
            $num_registros = mysqli_num_rows($res);

            $resul_x_pagina = 3;

            $paginacion = new Zebra_Pagination();
            $paginacion->records($num_registros);
            $paginacion->records_per_page($resul_x_pagina);

            $consulta = "SELECT * FROM usuario INNER JOIN perfil on usuario.perfil_idperfil=perfil.idperfil WHERE nombreusuario LIKE '%" . $name . "%' ORDER BY nombreusuario ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . "," . $resul_x_pagina;
            $result = $this->adapter->query($consulta);
            $allperfiles = $this->adapter->query("SELECT * FROM perfil");
                         while ($row = $allperfiles->fetch_object()) {
                             $resultSet[]=$row;
                        }
            $this->view("usuario", array(
                "paginacion" => $paginacion,
                "num_registros" => $num_registros,
                "result" => $result,
                "perfiles" => $resultSet,
                "buscado" => $name
            ));
        }else{
            $this->redirect("Usuarios", "mostrarUsuarios");
        }     
    }
}

?>