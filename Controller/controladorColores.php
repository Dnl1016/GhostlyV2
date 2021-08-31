<?php
require_once("ConexionDB.php");
require_once("../Model/colores.php");
require_once("../Model/crudColores.php");

class controladorColores
{
    public function __construct(){}

    public function listarColores()
    {
        $crudColores = new crudColores(); //Invocamos el objeto
        return $crudColores->listarColores(); //Retornamos la lista de clientes
    }

    public function registrarColor($nombre)
    {
        $color = new colores();
        $color->setNombre($nombre);
        $crudColores = new crudColores(); //Creamos el objeto del modelo para el registro
        return $crudColores->registrarColor($color); //Enviamos el objeto al modelo
    }

    public function buscarColor($idColor)
    {
        $crudColor = new crudColores();
        return $crudColor->buscarColor($idColor);
    }

    public function editarColor($nombre, $idColor)
    {
        $color = new colores();
        $color->setNombre($nombre);

        $crudColores = new crudColores();
        return $crudColores->editarColor($color, $idColor);
    }
}

$controladorColores = new controladorColores();
    if (isset($_GET['registrarColor'])) {
        header('Location:../View/crearColor.php');
    }
    if (isset($_GET['listarColores'])) {
        header('Location:../View/listarColores.php');
    }
    if (isset($_POST['registrarColor'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/crearColor.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorColores->registrarColor($_POST['nombre']);
        if($respuesta == "Se creo con éxito"){
            header('Location:../View/listarColores.php');
        }else{
            header('Location:../View/crearColor.php?error='.$respuesta);
        }
    }
    if (isset($_GET['editarColor'])) {
        header('Location:../View/editarColor.php?idColor='.$_GET['editarColor']);
    }
    if (isset($_POST['editarColor'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/editarColor.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorColores->editarColor($_POST['nombre'], $_POST['idColor']);
        if($respuesta == "Se edito con éxito"){
            header('Location:../View/listarColores.php');
        }else{
            header('Location:../View/editarColor.php?error='.$respuesta);
        }   
    }
?>