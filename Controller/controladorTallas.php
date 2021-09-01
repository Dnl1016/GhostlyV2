<?php
require_once("ConexionDB.php");
require_once("../Model/tallas.php");
require_once("../Model/crudTallas.php");

class controladorTallas
{
    public function __construct(){}

    public function listarTallas()
    {
        $crudTallas = new crudTallas(); //Invocamos el objeto
        return $crudTallas->listarTallas(); //Retornamos la lista de clientes
    }

    public function registrarTalla($nombre)
    {
        $talla = new tallas();
        $talla->setNombre($nombre);
        $crudTallas = new crudTallas(); //Creamos el objeto del modelo para el registro
        return $crudTallas->registrarTalla($talla); //Enviamos el objeto al modelo
    }

    public function buscarTalla($idTalla)
    {
        $crudTalla = new crudTallas();
        return $crudTalla->buscarTalla($idTalla);
    }

    public function editarTalla($nombre, $idTalla)
    {
        $talla = new tallas();
        $talla->setNombre($nombre);

        $crudTallas = new crudTallas();
        return $crudTallas->editarTalla($talla, $idTalla);
    }
}

$controladorTallas = new controladorTallas();
    if (isset($_GET['registrarTalla'])) {
        header('Location:../View/crearTalla.php');
    }
    if (isset($_GET['listarTallas'])) {
        header('Location:../View/listarTallas.php');
    }
    if (isset($_POST['registrarTalla'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/crearTalla.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorTallas->registrarTalla($_POST['nombre']);
        if($respuesta == "Se creo con éxito"){
            header('Location:../View/listarTallas.php');
        }else{
            header('Location:../View/crearTalla.php?error='.$respuesta);
        }
    }
    if (isset($_GET['editarTalla'])) {
        header('Location:../View/editarTalla.php?idTalla='.$_GET['editarTalla']);
    }
    if (isset($_POST['editarTalla'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/editarTalla.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorTallas->editarTalla($_POST['nombre'], $_POST['idTalla']);
        if($respuesta == "Se edito con éxito"){
            header('Location:../View/listarTallas.php');
        }else{
            header('Location:../View/editarTalla.php?error='.$respuesta);
        }   
    }
?>