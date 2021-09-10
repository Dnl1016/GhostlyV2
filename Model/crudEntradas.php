<?php 
    class crudEntradas{
        public function __construct(){}

        public function listarEntradas(){
            $db = ConexionDB::Conectar();
            $sql = $db->query("SELECT * FROM entradas");
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetchAll();
        }

        public function listarDetalleProductos(){
            $db = ConexionDB::Conectar();
            $sql = $db->query("SELECT idDetalleProducto, nombre FROM detalleproductos");
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetchAll();
        }
    }
?>