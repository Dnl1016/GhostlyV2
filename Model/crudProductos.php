<?php
    class crudProductos{
        public function __construct(){}

        public function listarProductos(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query("SELECT productos.*, categorias.nombre as nombreCategoria FROM productos
            JOIN categorias on productos.idCategoria = categorias.idCategoria");//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        public function listarCategorias(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query('SELECT idCategoria, nombre FROM categorias');//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        public function registrarProducto($producto){
            $mensaje = '';
            $db = ConexionDB::Conectar();
            $sql = $db->prepare('INSERT INTO productos(nombre, cantidad, estado, genero, fechaRegistro, idCategoria)
            VALUES (:nombre, :cantidad, :estado, :genero, :fechaRegistro, :idCategoria)');
            $sql->bindvalue('nombre',$producto->getNombre());
            $sql->bindvalue('cantidad', 0);
            $sql->bindvalue('estado',$producto->getEstado());
            $sql->bindvalue('genero',$producto->getGenero());
            $sql->bindvalue('fechaRegistro',$producto->getFechaRegistro());
            $sql->bindvalue('idCategoria',$producto->getIdCategoria());
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Se creo con éxito";
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($db); //Cerramos conexion a la DB
            return $mensaje;
        }

        public function editarProducto($producto, $idProducto){
            $mensaje = '';
            $db = ConexionDB::Conectar();
            $sql = $db->prepare('UPDATE productos 
            SET nombre=:nombre, estado=:estado, genero=:genero, idCategoria=:idCategoria
            WHERE idProducto=:idProducto');
            $sql->bindvalue('idProducto',$idProducto);
            $sql->bindvalue('nombre',$producto->getNombre());
            $sql->bindvalue('estado',$producto->getEstado());
            $sql->bindvalue('genero',$producto->getGenero());
            $sql->bindvalue('idCategoria',$producto->getIdCategoria());
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Se edito con éxito";
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($db); //Cerramos conexion a la DB
            return $mensaje;
        }

        public function buscarProducto($idProducto){
            $db = ConexionDB::Conectar();
            $sql = $db->prepare("SELECT * FROM productos WHERE idProducto=:idProducto");
            $sql->bindValue('idProducto', $idProducto);
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetch();
        }

        public function buscarDetalleProducto($idDetalleProducto){
            $db = ConexionDB::Conectar();
            $sql = $db->prepare("SELECT * FROM detalleproductos WHERE idDetalleProducto=:idDetalleProducto");
            $sql->bindValue('idDetalleProducto', $idDetalleProducto);
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetch();
        }

        public function detalleProducto($idProducto){
            $db = ConexionDB::Conectar();
            $sql = $db->prepare("SELECT * FROM detalleProductos WHERE idProducto=:idProducto");
            $sql->bindValue('idProducto', $idProducto);
            $sql->execute();
            ConexionDB::CerrarConexion($db);
            return $sql->fetchAll();
        }

        public function registrarDetalleProducto($idProducto, $nombre, $idTalla, $idColor){
            $db = ConexionDB::Conectar();
            $mensaje = "";
            try {
                $db->beginTransaction();
                foreach($nombre as $key => $value){
                    $imagenUno = "ImagenUno_".$value;
                    $imagenDos = "ImagenDos_".$value;
                    $imagenTres = "ImagenTres_".$value;
                    $sql = $db->prepare("INSERT INTO detalleproductos(nombre, cantidad, imagenUno, imagenDos, imagenTres, idTalla, idColor, idProducto)
                        VALUE (:nombre, :cantidad, :imagenUno, :imagenDos, :imagenTres, :idTalla, :idColor, :idProducto)");
                    $sql->bindValue('nombre', $value);
                    $sql->bindValue('cantidad', 0);
                    $sql->bindValue('imagenUno', $imagenUno);
                    $sql->bindValue('imagenDos', $imagenDos);
                    $sql->bindValue('imagenTres', $imagenTres);
                    $sql->bindValue('idTalla', $idTalla[$key]);
                    $sql->bindValue('idColor', $idColor[$key]);
                    $sql->bindValue('idProducto', $idProducto);
                    $sql->execute();
                }
                $mensaje = "Se creo con éxito";
                $db->commit();
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
                $db->rollBack();
            }
            ConexionDB::CerrarConexion($db);
            return $mensaje;
        }

        public function editarDetalleProducto($idDetalleProducto, $nombre, $idTalla, $idColor){
            $db = ConexionDB::Conectar();
            $mensaje = "";
            try {
                $sql = $db->prepare("UPDATE detalleproductos SET nombre=:nombre, idTalla=:idTalla, idColor=:idColor WHERE idDetalleProducto=:idDetalleProducto");
                $sql->bindValue('nombre', $nombre);
                $sql->bindValue('idTalla', $idTalla);
                $sql->bindValue('idColor', $idColor);
                $sql->bindValue('idDetalleProducto', $idDetalleProducto);
                $sql->execute();
                $mensaje = "Se edito con éxito";
            } catch (Exception $e){
                $mensaje = $e->getMessage();
                $db->rollBack();
            }
            ConexionDB::CerrarConexion($db);
            return $mensaje;
        }
    }
?>