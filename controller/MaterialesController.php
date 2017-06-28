<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MaterialesController
 *
 * @author Vito
 */
class MaterialesController extends ControladorBase {

    public $conectar;
    public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function index() {
        if (isset($_SESSION['session'])) {
            if ($_SESSION["session"]["idRol"] == "2") {

                if (isset($_REQUEST["name"])) {
                    $this->busqueda();
                } else {

                    $query = "SELECT * FROM material ORDER BY id_material ASC";
                    $res = $this->adapter->query($query);

                    $num_registros = mysqli_num_rows($res);
                    $resul_x_pagina = 3;

                    $paginacion = new Zebra_Pagination();
                    $paginacion->records($num_registros);
                    $paginacion->records_per_page($resul_x_pagina);

                    $consulta = "SELECT * FROM material ORDER BY id_material ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                    $result = $this->adapter->query($consulta);
                    $this->view("solicitudprofesor", array(
                        "paginacion" => $paginacion,
                        "num_registros" => $num_registros,
                        "result" => $result
                    ));
                }
            }
            if ($_SESSION["session"]["idRol"] == "1" || $_SESSION["session"]["idRol"] == "0") {
                //Creamos el objeto usuario
                $material = new Material($this->adapter);

                //Conseguimos todos los usuarios
                $allmateriales = $material->getAll();

                //Producto
                //Cargamos la vista index y le pasamos valores
                $this->view("material", array(
                    "allmateriales" => $allmateriales
                ));
            }
        }
    }

    public function crear() {
        if (isset($_POST["nombreMaterial"])) {

            $foto_name = $_FILES["image"]["name"];
            $foto_size = $_FILES["image"]["size"];
            $foto_type = $_FILES["image"]["type"];
            $foto_temporal = $_FILES["image"]["tmp_name"];
            # Limitamos los formatos de imagen admitidos a: png, jpg y gif
            if ($foto_type == "image/x-png" OR $foto_type == "image/png") {
                $extension = "image/png";
            }
            if ($foto_type == "image/pjpeg" OR $foto_type == "image/jpeg") {
                $extension = "image/jpeg";
            }
            if ($foto_type == "image/gif" OR $foto_type == "image/gif") {
                $extension = "image/gif";
            }
            echo $foto_size;
            $f1 = fopen($foto_temporal, "rb");
            $foto_reconvertida = fread($f1, $foto_size);
            $foto_reconvertida = base64_encode($foto_reconvertida);
            fclose($f1);

            $Material = new Material($this->adapter);
            $Material->setImagen($foto_reconvertida);
            $Material->setIdCategoria($_POST["idCategoria"]);
            $Material->setNombreMaterial($_POST["nombreMaterial"]);
            $Material->setEstadoMaterial($_POST["estadoMaterial"]);
            $Material->setStock($_POST["stock"]);

            $save = $Material->save();
        }
        $this->redirect("Materiales", "index");
    }

    public function update() {
        if (isset($_POST["id"])) {

            $id = $_POST["id"];
            $foto_name = $_FILES["image"]["name"];
            $foto_size = $_FILES["image"]["size"];
            $foto_type = $_FILES["image"]["type"];
            $foto_temporal = $_FILES["image"]["tmp_name"];
            # Limitamos los formatos de imagen admitidos a: png, jpg y gif
            if ($foto_type == "image/x-png" OR $foto_type == "image/png") {
                $extension = "image/png";
            }
            if ($foto_type == "image/pjpeg" OR $foto_type == "image/jpeg") {
                $extension = "image/jpeg";
            }
            if ($foto_type == "image/gif" OR $foto_type == "image/gif") {
                $extension = "image/gif";
            }
            echo $foto_size;
            $f1 = fopen($foto_temporal, "rb");
            $foto_reconvertida = fread($f1, $foto_size);
            $foto_reconvertida = base64_encode($foto_reconvertida);
            fclose($f1);

            $material = new Material($this->adapter);
            $material->setIdCategoria($_POST["idCategoria"]);
            $material->setNombreMaterial($_POST["nombreMaterial"]);
            $material->setEstadoMaterial($_POST["estadoMaterial"]);
            $material->setStock($_POST["stock"]);
            $material->setImagen($foto_reconvertida);
            $save = $material->update($id);
        }
        $this->redirect("Materiales", "index");
    }

    public function borrar() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];


            $material = new Material($this->adapter);
            $material->deleteByIdMaterial($id);
        }
        $this->redirect("Materiales", "index");
    }

    public function actualizar() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $material = new Material($this->adapter);
            $datos['material'] = $material->getByIdMaterial($id);
            $this->view("material", $datos);
        }
    }
     public function busqueda() {
        if (isset($_REQUEST["name"])) {

            $name = utf8_encode($_REQUEST['name']);

            $query = "SELECT * FROM material WHERE nombre_material LIKE '%" . $name . "%' ORDER BY nombre_material ASC";
            $res = $this->adapter->query($query);
            $num_registros = mysqli_num_rows($res);

            $resul_x_pagina = 3;

            $paginacion = new Zebra_Pagination();
            $paginacion->records($num_registros);
            $paginacion->records_per_page($resul_x_pagina);

            $consulta = "SELECT * FROM material WHERE nombre_material LIKE '%" . $name . "%' ORDER BY nombre_material ASC LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . "," . $resul_x_pagina;
            $result = $this->adapter->query($consulta);
            $this->view("solicitudprofesor", array(
                "paginacion" => $paginacion,
                "num_registros" => $num_registros,
                "result" => $result
            ));
        }
    }
}
