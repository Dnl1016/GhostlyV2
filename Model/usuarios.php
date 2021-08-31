<?php
    class usuarios{
        private $usuario;
        private $contrasena;
        private $idRol;
        private $idPersona;
        private $estado;

        public function __construct(){}

        public function setUsuario($usuario){
            $this->usuario=$usuario;
        }

        public function setContrasena($contrasena){
            $this->contrasena=$contrasena;
        }

        public function setIdRol($idRol){
            $this->idRol=$idRol;
        }

        public function setIdPersona($idPersona){
            $this->idPersona=$idPersona;
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

        public function getIdRol(){
            return $this->idRol;
        }

        public function getIdPersona(){
            return $this->idPersona;
        }

        public function getEstado(){
            return $this->estado;
        }
    }
?>