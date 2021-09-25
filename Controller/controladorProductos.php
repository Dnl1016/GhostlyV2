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

    public function buscarDetalleProducto($idDetalleProducto){
        $crudProductos = new crudProductos();
        return $crudProductos->buscarDetalleProducto($idDetalleProducto);
    }

    public function registrarProducto($nombre, $genero, $idCategoria, $estado)
    {
        $producto = new productos();
        date_default_timezone_set('America/Bogota');
        $producto->setFechaRegistro(date('Y-m-d')); 
        $producto->setNombre($nombre);
        $producto->setEstado($estado);
        $producto->setGenero($genero);
        $producto->setIdCategoria($idCategoria);
        $crudProductos = new crudProductos(); //Creamos el objeto del modelo para el registro
        return $crudProductos->registrarProducto($producto); //Enviamos el objeto al modelo
    }

    public function editarProducto($idProducto, $nombre, $genero, $idCategoria, $estado)
    {
        $producto = new productos();
        $producto->setNombre($nombre);
        $producto->setEstado($estado);
        $producto->setGenero($genero);
        $producto->setIdCategoria($idCategoria);
        $crudProductos = new crudProductos(); //Creamos el objeto del modelo para el registro
        return $crudProductos->editarProducto($producto, $idProducto); //Enviamos el objeto al modelo
    }

    public function detalleProducto($idProducto){
        $crudProductos = new crudProductos();
        return $crudProductos->detalleProducto($idProducto);
    }

    public function registrarDetalleProducto($idProducto, $nombre, $precio, $idTalla, $idColor){
        $crudProductos = new crudProductos();
        return $crudProductos->registrarDetalleProducto($idProducto, $nombre, $precio, $idTalla, $idColor);
    }
    public function editarDetalleProducto($idDetalleProducto, $nombre, $precio, $idTalla, $idColor){
        $crudProductos = new crudProductos();
        return $crudProductos->editarDetalleProducto($idDetalleProducto, $nombre, $precio, $idTalla, $idColor);
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
    if(trim($_POST['nombre']) == '' || trim($_POST['genero']) == '' || trim($_POST['idCategoria']) == '' || trim($_POST['estado']) == ''){
        header('Location:../View/crearProducto.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
    }   
    $respuesta = $controladorProductos->registrarProducto($_POST['nombre'], $_POST['genero'], $_POST['idCategoria'], $_POST['estado']);
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
    }else if(trim($_POST['nombre']) == '' || trim($_POST['genero']) == '' || trim($_POST['idCategoria']) == '' || trim($_POST['estado']) == ''){
        header('Location:../View/editarProducto.php?idProducto='.$_POST['idProducto'].'&error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
    } 
    $respuesta = $controladorProductos->editarProducto($_POST['idProducto'], $_POST['nombre'], $_POST['genero'], $_POST['idCategoria'], $_POST['estado']);
    if($respuesta == "Se edito con éxito"){
        header('Location:../View/listarProductos.php');
    }else{
        header('Location:../View/editarProducto.php?idProducto='.$_POST['idProducto'].'&error='.$respuesta);
    } 
}
if(isset($_GET['producto'])){
    header('Location:../View/listarDetalleProductos.php?idProducto='.$_GET['producto']);
}
if(isset($_GET['registrarDetalleProducto'])){
    header('Location:../View/crearDetalleProducto.php?idProducto='.$_GET['registrarDetalleProducto']);
}
if(isset($_POST['registrarDetalleProducto'])){
    if($_POST['idProducto'] == null && $_POST['nombre'] == null || $_POST['idTalla'] == null || $_POST['idColor'] == null || $_POST['precio'] == null){
        header('Location:../View/crearDetalleProducto.php?error=Ocurrio-un-error');
    }

    $mensaje = $controladorProductos->registrarDetalleProducto($_POST['idProducto'], $_POST['nombre'],$_POST['precio'], $_POST['idTalla'], $_POST['idColor']);

    if($mensaje == "Se creo con éxito"){
        header('Location:../View/listarDetalleProductos.php?idProducto='.$_POST['idProducto']);
    }else{
        header('Location:../View/crearDetalleProducto.php?error='.$mensaje);
    }
}
if(isset($_GET['editarDetalleProducto'])){
    header('Location:../View/editarDetalleProducto.php?idDetalleProducto='.$_GET['editarDetalleProducto']);
}
if(isset($_POST['editarDetalleProducto'])){
    if(trim($_POST['idDetalleProducto']) == '' || trim($_POST['nombre']) == '' || trim($_POST['idTalla']) == '' || trim($_POST['idColor']) == ''|| trim($_POST['precio']) == ''){
        header('Location:../View/editarDetalleProducto.php?idDetalleProducto='.$_POST['idDetalleProducto'].'&error=Ocurrio-un-error');
    }
    $mensaje = $controladorProductos->editarDetalleProducto($_POST['idDetalleProducto'], $_POST['nombre'], $_POST['precio'], $_POST['idTalla'], $_POST['idColor'], $_POST['precio']);
    if($mensaje == "Se edito con éxito"){
        header('Location:../View/listarDetalleProductos.php?idProducto='.$_POST['idProducto']);
    }else{
        header('Location:../View/editarDetalleProducto.php?idDetalleProducto='.$_GET['idDetalleProducto'].'&error='.$mensaje);
    }
}
?>