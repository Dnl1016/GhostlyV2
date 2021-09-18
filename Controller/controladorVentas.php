<?php 
    require_once("ConexionDB.php");
    require_once("../Model/crudVentas.php");

    class controladorVentas{

        public function __construct(){}

        public function listarVentas(){
            $crudVentas = new crudVentas();
            return $crudVentas->listarVentas();
        }

        public function listarPersonas(){
            $crudVentas = new crudVentas;
            return $crudVentas->listarPersonas();
        }

    }

    $controladorVentas = new controladorVentas();

    if(isset($_GET['listarVentas'])){
        header('Location: ../View/listarVentas.php');
    }else{
        if(isset($_GET['registrarVentas'])){
            header('Location: ../View/crearVenta.php');
        }
    }
?>