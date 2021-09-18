<?php 
    require_once("ConexionDB.php");
    require_once("../Model/crudVentas.php");

    class controladorVentas{

        public function __construct(){}

        public function listarVentas(){
            $crudVentas = new crudVentas();
            return $crudVentas->listarVentas();
        }

        public function listarProductos(){
            $crudVentas = new crudVentas();
            return $crudVentas->listarProductos();
        }

        public function listarPersonas(){
            $crudVentas = new crudVentas;
            return $crudVentas->listarPersonas();
        }

        public function consultarPrecio($idProducto){
            $crudVentas = new crudVentas();
            return $crudVentas->consultarPrecio($idProducto);
        }

        public function registrarVenta($idPersona, $nombreVenta, $detalleIdProducto, $detalleCantidad, $detallePrecioUnitario){
            $crudVentas = new crudVentas();
            return $crudVentas->registrarVenta($idPersona, $nombreVenta, $detalleIdProducto, $detalleCantidad, $detallePrecioUnitario);
        }

    }

    $controladorVentas = new controladorVentas();

    if(isset($_GET['listarVentas'])){
        header('Location: ../View/listarVentas.php');
    }else{
        if(isset($_GET['registrarVentas'])){
            header('Location: ../View/crearVenta.php');
        }else{
            if(isset($_POST['consultarPrecio'])){
                echo $controladorVentas->consultarPrecio($_POST['idProducto'])['precio'];
            }else{
                if(isset($_POST['registrarVenta'])){
                    if(trim($_POST['idPersona']) == '' || trim($_POST['nombreVenta']) == '' || count($_POST['detalleIdProducto']) < 1 || count($_POST['detalleCantidad']) < 1 || count($_POST['detallePrecioUnitario']) < 1)
                        header('Location: ../View/crearVenta.php?error=No-se-pudo-registra-la-venta.');
                    else{
                        $mensaje = $controladorVentas->registrarVenta($_POST['idPersona'],$_POST['nombreVenta'], $_POST['detalleIdProducto'], $_POST['detalleCantidad'], $_POST['detallePrecioUnitario']);
                        if($mensaje == 'Venta registrada'){
                            header('Location: ../View/listarVentas.php');
                        }else{
                            header('Location: ../View/crearVenta.php?error='.$mensaje);
                        }
                    }
                }
            }
        }
    }
?>