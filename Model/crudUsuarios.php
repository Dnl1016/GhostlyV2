<?php
    class crudUsuarios{
        public function __construct(){}

        public function listarUsuarios(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query('SELECT u.idUsuario, p.nombre, p.apellido, p.correo, p.cedula, p.telefono, u.usuario, u.estado, r.nombre as nombreRol FROM roles r inner join usuarios u ON r.idRol=u.idRol
            INNER join personas p on u.idPersona=p.idPersona');//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        public function listarRoles(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query('SELECT * FROM roles');//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        private function validarUsuario($nombreUsuario){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->prepare("SELECT * FROM usuarios WHERE usuario=:nombreUsuario");//Consultamos la base de datos
            $sql->bindValue('nombreUsuario', $nombreUsuario);
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            if($sql->rowCount() > 0){
                return true;
            }
            return false;
        }

        private function validarDocumento($documento){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->prepare("SELECT * FROM personas WHERE documento=:documento");//Consultamos la base de datos
            $sql->bindValue('documento', $documento);
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            if($sql->rowCount() > 0){
                return true;
            }
            return false;
        }

        private function validarCorreo($correo){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->prepare("SELECT * FROM personas WHERE correo=:correo");//Consultamos la base de datos
            $sql->bindValue('correo', $correo);
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            if($sql->rowCount() > 0){
                return true;
            }
            return false;
        }

        public function registrarUsuario($usuario, $persona){
            $mensaje = '';
            $Db = ConexionDB::Conectar(); //Conectamos la base de datos
            if($this->validarUsuario($usuario->getUsuario())){
                return 'El-usuario-ya-esta-registrado.';
            }elseif($this->validarDocumento($persona->getDocumento())){
                return 'El-documento-ya-esta-registrado.';
            }elseif($this->validarDocumento($persona->getCorreo())){
                return 'El-correo-ya-esta-registrado.';
            }
            $idPersona = $this->registrarPersona($persona);
            // $usuario->setIdPersona($this->registrarPersona($persona));
            $sql = $Db->prepare('INSERT INTO usuarios(usuario, contrasena, estado, idPersona, idRol)
            VALUES (:usuario, :contrasena, :estado, :idPersona, :idRol)');
            $sql->bindvalue('usuario',$usuario->getUsuario());
            $sql->bindvalue('contrasena', sha1($usuario->getContrasena()));
            $sql->bindvalue('estado',$usuario->getEstado());
            $sql->bindvalue('idPersona', $idPersona); //Asignamos los valores al value
            $sql->bindvalue('idRol',$usuario->getIdRol()); //Asignamos los valores al value
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Se creo con éxito";
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db); //Cerramos conexion a la DB
            return $mensaje;
        }

        private function registrarPersona($persona){
            $db = ConexionDB::Conectar(); //Conectamos la base de datos
            $sql = $db->prepare('INSERT INTO personas(nombre, apellido, cedula, correo, direccion, telefono)
            VALUES (:nombre, :apellido, :cedula, :correo, :direccion, :telefono)');
            $sql->bindvalue('nombre',$persona->getNombre());
            $sql->bindvalue('apellido',$persona->getApellido());
            $sql->bindvalue('cedula',$persona->getCedula());
            $sql->bindvalue('correo',$persona->getCorreo()); //Asignamos los valores al value
            $sql->bindvalue('direccion',$persona->getDireccion()); //Asignamos los valores al value
            $sql->bindvalue('telefono',$persona->getTelefono()); //Asignamos los valores al value
            try {
                $sql->execute();
                $idPersona = $db->lastInsertId();
            } catch (Exception $e) {
                $idPersona = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db); //Cerramos conexion a la DB
            return $idPersona;
        }

        /* public function RegistrarClientes($Cliente){
            $mensaje;
            $Db = ConexionDB::Conectar(); //Conectamos la base de datos
            $sql = $Db->prepare('INSERT INTO clientes(Documento, Nombre, Apellido, Celular)
            VALUES (:Documento, :Nombre, :Apellido, :Celular)');
            $sql->bindvalue('Documento',$Cliente->getDocumento());
            $sql->bindvalue('Nombre',$Cliente->getNombre());
            $sql->bindvalue('Apellido',$Cliente->getApellido());
            $sql->bindvalue('Celular',$Cliente->getCelular()); //Asignamos los valores al value
            
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Registro exitoso";
            } catch (Exception $e) {
                $mensaje = $e.getMessage();
            }
            ConexionDB::CerrarConexion($Db); //Cerramos conexion a la DB
            return $mensaje;
        }
        */
        public function buscarUsuario($idUsuario){
            $Db = ConexionDB::Conectar(); //Establecemos conexion
            $sql = $Db->prepare('SELECT p.idPersona, p.direccion, p.nombre, p.apellido, p.correo, p.cedula, p.telefono, u.usuario, u.estado, r.idRol FROM roles r inner join usuarios u ON r.idRol=u.idRol
            INNER join personas p on u.idPersona=p.idPersona WHERE u.idUsuario=:idUsuario'); //Preparamamos el query
            $sql->bindvalue('idUsuario',$idUsuario); //Asignamos el valor documento
            $sql->execute();//Ejecutamos la consulta
            return $sql->fetch(); //Retornamos una linea
        }
        
        public function editarUsuario($usuario, $persona, $idPersona){
            $db = ConexionDB::Conectar(); //Conectamos la base de datos
            $respuesta = $this->editarPersona($persona, $idPersona);
            if($respuesta != "Editado con éxito"){
                return $respuesta;
            }
            $sql = $db->prepare('UPDATE usuarios SET
            usuario=:usuario,
            estado=:estado,
            idRol=:idRol
            WHERE idPersona=:idPersona');
            $sql->bindValue('usuario', $usuario->getUsuario());
            $sql->bindValue('estado', $usuario->getEstado());
            $sql->bindValue('idRol', $usuario->getIdRol());
            $sql->bindValue('idPersona', $idPersona);
            try{
                $sql->execute();
                $mensaje = "Editado con éxito";
            }catch(Exception $e){
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db);
            return $mensaje;
        }

        private function editarPersona($persona, $idPersona){
            $db = ConexionDB::Conectar(); //Conectamos la base de datos
            $sql = $db->prepare('UPDATE personas SET
            nombre=:nombre,
            apellido=:apellido,
            cedula=:cedula,
            correo=:correo,
            direccion=:direccion,
            telefono=:telefono
            WHERE idPersona=:idPersona');
            $sql->bindValue('nombre', $persona->getNombre());
            $sql->bindValue('apellido', $persona->getApellido());
            $sql->bindValue('cedula', $persona->getCedula());
            $sql->bindValue('correo', $persona->getCorreo());
            $sql->bindValue('direccion', $persona->getDireccion());
            $sql->bindValue('telefono', $persona->getTelefono());
            $sql->bindValue('idPersona', $idPersona);
            try{
                $sql->execute();
                $mensaje = "Editado con éxito";
            }catch(Exception $e){
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db);
            return $mensaje;
        }
        /*
        public function EliminarClientes($Documento){
            $mensaje = "";
            $Db = ConexionDB::Conectar();
            $sql = $Db->prepare('DELETE FROM clientes
            WHERE Documento=:Documento1');
            $sql->bindvalue('Documento1',$Documento);
            try{
                $sql->execute();
                $mensaje = "Eliminación exitosa";
            }catch(Exception $e){
                $mensaje = $e.getMessage();
            }
            ConexionDB::CerrarConexion($Db);
            return $mensaje;
        } */
    }
?>