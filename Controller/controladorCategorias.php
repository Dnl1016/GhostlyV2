<?php
require_once("ConexionDB.php");
require_once("../Model/categorias.php");
require_once("../Model/crudCategorias.php");

class controladorCategorias
{
    public function __construct(){}

    public function listarCategorias()
    {
        $crudCategorias = new crudCategorias(); //Invocamos el objeto
        return $crudCategorias->listarCategorias(); //Retornamos la lista de clientes
    }

    public function registrarCategoria($nombre)
    {
        $categoria = new categorias();
        $categoria->setNombre($nombre);
        $categoria->setEstado(1);
        $crudCategorias = new crudCategorias(); //Creamos el objeto del modelo para el registro
        return $crudCategorias->registrarCategoria($categoria); //Enviamos el objeto al modelo
    }

    public function buscarCategoria($idCategoria)
    {
        $crudCategorias = new crudCategorias();
        return $crudCategorias->buscarCategoria($idCategoria);
    }

    public function editarCategoria($nombre, $idCategoria, $estado)
    {
        $categoria = new categorias();
        $categoria->setNombre($nombre);
        $categoria->setEstado($estado);

        $crudCategorias = new crudCategorias();
        return $crudCategorias->editarCategoria($categoria, $idCategoria);
    }
}

$controladorCategoria = new controladorCategorias();
    if (isset($_GET['registrarCategoria'])) {
        header('Location:../View/crearCategoria.php');
    }
    if (isset($_GET['listarCategorias'])) {
        header('Location:../View/listarCategorias.php');
    }
    if (isset($_POST['registrarCategoria'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/crearCategoria.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorCategoria->registrarCategoria($_POST['nombre']);
        if($respuesta == "Se creo con éxito"){
            header('Location:../View/listarCategorias.php');
        }else{
            header('Location:../View/crearCategoria.php?error='.$respuesta);
        }
    }
    if (isset($_GET['editarCategoria'])) {
        header('Location:../View/editarCategoria.php?idCategoria='.$_GET['editarCategoria']);
    }
    if (isset($_POST['editarCategoria'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/editarCategoria.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorCategoria->editarCategoria($_POST['nombre'], $_POST['idCategoria'], $_POST['estado']);
        if($respuesta == "Se edito con éxito"){
            header('Location:../View/listarCategorias.php');
        }else{
            header('Location:../View/editarCategoria.php?error='.$respuesta);
        }   
    }
?>