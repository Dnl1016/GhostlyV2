<?php
    class acceso{
        private $usuario;
        private $contrasena;
        private $rol;
        private $estado;

        public function __construct(){}

        public function setUsuario($usuario){
            $this->usuario=$usuario;
        }

        public function setContrasena($contrasena){
            $this->contrasena=$contrasena;
        }

        public function setRol($rol){
            $this->rol=$rol;
        }

        public function setEstado($estado){
            $this->estado=$estado;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function getContrasena(){
            return $this->contrasena;
        }

        public function getRol(){
            return $this->rol;
        }

        public function getEstado(){
            return $this->estado;
        }
    }
?>