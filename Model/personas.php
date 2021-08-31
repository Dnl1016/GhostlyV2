<?php
    class personas{
        private $nombre;
        private $apellido;
        private $cedula;
        private $correo;
        private $direccion;
        private $telefono;

        public function __construct(){}

        public function setNombre($nombre){
            $this->nombre=$nombre;
        }

        public function setApellido($apellido){
            $this->apellido=$apellido;
        }

        public function setCedula($cedula){
            $this->cedula=$cedula;
        }

        public function setCorreo($correo){
            $this->correo=$correo;
        }

        public function setDireccion($direccion){
            $this->direccion=$direccion;
        }

        public function setTelefono($telefono){
            $this->telefono=$telefono;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellido(){
            return $this->apellido;
        }

        public function getCedula(){
            return $this->cedula;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function getDireccion(){
            return $this->direccion;
        }

        public function getTelefono(){
            return $this->telefono;
        }
    }
?>