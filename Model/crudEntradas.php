<?php 
    class crudEntradas{
        public function __construct(){}

        public function listarEntradas(){
            $db = ConexionDB::Conectar();
            $sql = $db->query("SELECT e.idEntrada, e.cantidad, e.fechaEntrada, dp.nombre FROM entradas e JOIN detalleproductos dp ON e.idDetalleProducto=dp.idDetalleProducto");
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

        public function registrarEntradas($cantidad, $productos, $fecha){
            $db = ConexionDB::Conectar();
            try {
                $db->beginTransaction();
                foreach ($productos as $key => $value) {
                    $sql = $db->prepare("INSERT INTO entradas(cantidad, fechaEntrada, idDetalleProducto)
                        VALUES (:cantidad, :fechaEntrada, :idDetalleProducto)");
                    $sql->bindValue('cantidad', $cantidad[$key]);
                    $sql->bindValue('fechaEntrada', $fecha);
                    $sql->bindValue('idDetalleProducto', $value);
                    $sql->execute();

                    $producto = $db->prepare("SELECT idProducto FROM detalleproductos 
                        WHERE idDetalleProducto=:idDetalleProducto");
                    $producto->bindValue('idDetalleProducto', $value);
                    $producto->execute();
                    $producto = $producto->fetch();

                    $updateDetalleProducto = $db->prepare("UPDATE detalleproductos 
                        SET cantidad=cantidad+:cantidad
                        WHERE idDetalleProducto=:idDetalleProducto");
                    $updateDetalleProducto->bindValue('cantidad', $cantidad[$key]);
                    $updateDetalleProducto->bindValue('idDetalleProducto', $value);
                    $updateDetalleProducto->execute();

                    $updateProducto = $db->prepare("UPDATE productos 
                        SET cantidad=cantidad+:cantidad
                        WHERE idProducto=:idProducto");
                    $updateProducto->bindValue('cantidad', $cantidad[$key]);
                    $updateProducto->bindValue('idProducto', $producto['idProducto']);
                    $updateProducto->execute();
                }
                $db->commit();
                $mensaje = "Entradas registradas";
            } catch (Exception $e) {
                $db->rollBack();
                $mensaje = $e->getMessage();
            }
            return $mensaje;
        }
    }
?>