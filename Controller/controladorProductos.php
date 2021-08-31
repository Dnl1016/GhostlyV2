<?php 
require_once("ConexionDB.php");
require_once("../Model/productos.php");
require_once("../Model/crudProductos.php");

class controladorProductos{
    public function __construct(){}

    public function listarProductos()
    {
        $crudProductos = new crudProductos(); //Invocamos el objeto
        return $crudProductos->listarProductos(); //Retornamos la lista de clientes
    }

    public function listarCategorias()
    {
        $crudProductos = new crudProductos(); //Invocamos el objeto
        return $crudProductos->listarCategorias(); //Retornamos la lista de clientes
    }

    public function buscarProducto($idProducto){
        $crudProductos = new crudProductos();
        return $crudProductos->buscarProducto($idProducto);
    }

    public function registrarProducto($nombre, $cantidad, $genero, $idCategoria, $estado)
    {
        $producto = new productos();
        date_default_timezone_set('America/Bogota');
        $producto->setFechaRegistro(date('d-m-Y'));
        $producto->setNombre($nombre);
        $producto->setEstado($estado);
        $producto->setGenero($genero);
        $producto->setIdCategoria($idCategoria);
        $producto->setCantidad($cantidad);
        $crudProductos = new crudProductos(); //Creamos el objeto del modelo para el registro
        return $crudProductos->registrarProducto($producto); //Enviamos el objeto al modelo
    }

    public function editarProducto($idProducto, $nombre, $cantidad, $genero, $idCategoria, $estado)
    {
        $producto = new productos();
        $producto->setNombre($nombre);
        $producto->setEstado($estado);
        $producto->setGenero($genero);
        $producto->setIdCategoria($idCategoria);
        $producto->setCantidad($cantidad);
        $crudProductos = new crudProductos(); //Creamos el objeto del modelo para el registro
        return $crudProductos->editarProducto($producto, $idProducto); //Enviamos el objeto al modelo
    }

    public function detalleProducto($idProducto){
        $crudProductos = new crudProductos();
        return $crudProductos->detalleProducto($idProducto);
    }
}
    
$controladorProductos = new controladorProductos();
if(isset($_GET['listarProductos'])){
    header('Location: ../View/listarProductos.php');
}
if(isset($_GET['registrarProducto'])){
    header('Location: ../View/crearProducto.php');
}
if (isset($_POST['registrarProducto'])) {
    if(trim($_POST['nombre']) == '' || trim($_POST['cantidad']) == '' || trim($_POST['genero']) == '' || trim($_POST['idCategoria']) == '' || trim($_POST['estado']) == ''){
        header('Location:../View/crearProducto.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
    }   
    $respuesta = $controladorProductos->registrarProducto($_POST['nombre'], $_POST['cantidad'], $_POST['genero'], $_POST['idCategoria'], $_POST['estado']);
    if($respuesta == "Se creo con éxito"){
        header('Location:../View/listarProductos.php');
    }else{
        header('Location:../View/crearProducto.php?error='.$respuesta);
    }
}
if (isset($_GET['editarProducto'])) {
    header('Location:../View/editarProducto.php?idProducto='.$_GET['editarProducto']);
}
if (isset($_POST['editarProducto'])) {
    if($_POST['idProducto'] == null){
        header('Location:../View/listarProductos.php?error=No-se-encontro-el-producto');
    }else if(trim($_POST['nombre']) == '' || trim($_POST['cantidad']) == '' || trim($_POST['genero']) == '' || trim($_POST['idCategoria']) == '' || trim($_POST['estado']) == ''){
        header('Location:../View/editarProducto.php?idProducto='.$_POST['idProducto'].'&error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
    } 
    $respuesta = $controladorProductos->editarProducto($_POST['idProducto'], $_POST['nombre'], $_POST['cantidad'], $_POST['genero'], $_POST['idCategoria'], $_POST['estado']);
    if($respuesta == "Se edito con éxito"){
        header('Location:../View/listarProductos.php');
    }else{
        header('Location:../View/editarProducto.php?idProducto='.$_POST['idProducto'].'&error='.$respuesta);
    } 
}
if(isset($_GET['producto'])){
    header('Location:../View/listarDetalleProductos.php?idProducto='.$_GET['producto']);
}
?>