<?php 
    class crudVentas{

        public function __construct(){}

        public function listarVentas(){
            $db = ConexionDB::Conectar();
            $sql = $db->query("SELECT * FROM ventas");
            $sql->execute();
            return $sql->fetchAll();
        }

        public function listarPersonas(){
            $db = ConexionDB::Conectar();
            $sql = $db->query('SELECT p.idPersona, p.nombre, p.apellido, p.cedula
            FROM usuarios u JOIN personas p ON u.idPersona=p.idPersona WHERE u.estado = 1');
            $sql->execute();
            return $sql->fetchAll();
        }

        public function listarProductos(){
            $db = ConexionDB::Conectar();
            $sql = $db->query('SELECT * FROM detalleproductos');
            $sql->execute();
            return $sql->fetchAll();
        }

        public function consultarPrecio($idProducto){
            $db = ConexionDB::Conectar();
            $sql = $db->prepare("SELECT * FROM detalleproductos WHERE idDetalleProducto=:idDetalleProducto");
            $sql->bindValue('idDetalleProducto', $idProducto);
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetch();
        }

        public function registrarVenta($idPersona, $nombreVenta, $detalleIdProducto, $detalleCantidad, $detallePrecioUnitario){
            $mensaje = '';
            $db = ConexionDB::Conectar();
            try {
                $db->beginTransaction();

                $venta = $db->prepare("INSERT INTO ventas(nombre, fechaVenta, valor, estado, idPersona)
                    VALUES (:nombre, :fechaVenta, :valor, :estado, :idPersona)");
                $venta->bindValue('nombre', $nombreVenta);
                $venta->bindValue('fechaVenta', $this->getFecha());
                $venta->bindValue('valor', $this->getValor($detalleCantidad, $detallePrecioUnitario));
                $venta->bindValue('estado', '0');
                $venta->bindValue('idPersona', $idPersona);
                $venta->execute();
                $idVenta = $db->lastInsertId();
                foreach ($detalleIdProducto as $key => $value) {
                    $detalleVenta = $db->prepare("INSERT INTO detalleventa(cantidad, precio, idVenta, idDetalleProducto)
                    VALUES (:cantidad, :precio, :idVenta, :idDetalleProducto)");
                    $detalleVenta->bindValue('cantidad', $detalleCantidad[$key]);
                    $detalleVenta->bindValue('precio', $detallePrecioUnitario[$key]);
                    $detalleVenta->bindValue('idVenta', $idVenta);
                    $detalleVenta->bindValue('idDetalleProducto', $value);
                    $detalleVenta->execute();

                    $descontarCantidadDetalleProducto = $db->prepare("UPDATE detalleproductos SET cantidad = cantidad - :cantidad 
                    WHERE idDetalleProducto=:idDetalleProducto");
                    $descontarCantidadDetalleProducto->bindValue('cantidad', $detalleCantidad[$key]);
                    $descontarCantidadDetalleProducto->bindValue('idDetalleProducto', $value);
                    $descontarCantidadDetalleProducto->execute();

                    $producto = $db->prepare("SELECT * FROM detalleproductos
                        WHERE idDetalleProducto=:idDetalleProducto");
                    $producto->bindValue('idDetalleProducto', $value);
                    $producto->execute();
                    $producto = $producto->fetch();

                    $descontarCantidadProducto = $db->prepare("UPDATE productos SET cantidad = cantidad - :cantidad 
                    WHERE idProducto=:idProducto");
                    $descontarCantidadProducto->bindValue('cantidad', $detalleCantidad[$key]);
                    $descontarCantidadProducto->bindValue('idProducto', $producto['idProducto']);
                    $descontarCantidadProducto->execute();
                }
                $mensaje = 'Venta registrada';
                $db->commit();
            } catch (Exception $e) {
                $db->rollBack();
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($db);
            return $mensaje;
        }

        private function getValor($detalleCantidad, $detallePrecioUnitario){
            $valorTotal = 0;
            foreach ($detalleCantidad as $key => $value) {
                $valorTotal += ($value * $detallePrecioUnitario[$key]);
            }
            return $valorTotal;
        }

        private function getFecha(){
            date_default_timezone_set('America/Bogota');
            $fecha = date('Y-m-d h:m:s');
            return $fecha;
        }

        public function buscarDetalleVenta($idDetalleVenta){
            $db = ConexionDB::Conectar();
            $sql = $db->prepare('SELECT * FROM detalleVenta dv inner join ventas v on dv.idVenta=v.idVenta 
             WHERE dv.idDetalleVenta=:idDetalleVenta');
            $sql->bindValue('idDetalleVenta', $idDetalleVenta);
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetch();
        }

        public function detalleVenta($idVenta){
            $db = ConexionDB::Conectar();
            $sql = $db->prepare('SELECT * FROM detalleVenta dv inner join ventas v on dv.idVenta=v.idVenta WHERE dv.idVenta=:idVenta');
            $sql->bindValue('idVenta', $idVenta);
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetchAll();
        }
    }
?>