<?php
    class crudRegistrar{
        public function __construct(){}
        
        private function validarUsuario($usuario){
            
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");//Consultamos la base de datos
            $sql->bindValue('usuario', $usuario);
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            if($sql->rowCount() > 0){
                return true;
            }
            return false;
        }

        private function validarDocumento($cedula){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->prepare("SELECT * FROM personas WHERE cedula=:cedula");//Consultamos la base de datos
            $sql->bindValue('cedula', $cedula);
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
            }elseif($this->validarDocumento($persona->getCedula())){
                return 'El-documento-ya-esta-registrado.';
            }elseif($this->validarCorreo($persona->getCorreo())){
                return 'El-correo-ya-esta-registrado.';
            }
            $idPersona = $this->registrarPersona($persona);
            // $usuario->setIdPersona($this->registrarPersona($persona));
            $sql = $Db->prepare('INSERT INTO usuarios(usuario, contrasena, estado, idPersona, idRol)
            VALUES (:usuario, :contrasena, :estado, :idPersona, :idRol)');
            $sql->bindvalue('usuario',$usuario->getUsuario());
            $sql->bindvalue('contrasena', sha1($usuario->getContrasena()));
            $sql->bindvalue('estado',1);
            $sql->bindvalue('idPersona', $idPersona); //Asignamos los valores al value
            $sql->bindvalue('idRol',2);
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
    }
?>