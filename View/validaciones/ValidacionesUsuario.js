function validarUsuario(){
    let nombre, apellido, correo, cedula, estado, telefono, direccion, usuario, 
    contrasena, confirmarContrasena, idRol,  expresionCorreo, expresionNombre, expresionApellido;
    nombre = document.getElementById("nombre").value;
    apellido = document.getElementById("apellido").value;
    cedula = document.getElementById("cedula").value;
    correo = document.getElementById("correo").value;
    estado = document.getElementById("estado").value;
    telefono = document.getElementById("telefono").value;
    direccion = document.getElementById("direccion").value;
    usuario = document.getElementById("usuario").value;
    contrasena = document.getElementById("contrasena").value;
    idRol = document.getElementById("idRol").value;
    confirmarContrasena = document.getElementById("confirmarContrasena").value;

    expresionNombre = /[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}/;
    expresionApellido = /[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}/;
    expresionCorreo= /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;

    if(nombre == "" || apellido == "" || correo == "" || contrasena == ""|| 
    direccion== ""|| usuario== "" || confirmarContrasena == "" || telefono == "" ||
     idRol == "Seleccione el rol" || estado == "Seleccione el estado" ){
        Swal.fire('Todos los campos deben ser diligenciados');
        return false;
    }

    else if(!expresionCorreo.test(correo)){
        Swal.fire("Debe ingresar un formato válido en el correo");
        return false;
    }

    else if(!expresionNombre.test(nombre)){
        Swal.fire("Debe ingresar un formato válido en el nombre");
        return false;
    }

    else if(!expresionApellido.test(apellido)){
        Swal.fire("Debe ingresar un formato válido  en el apellido");
        return false;
    }

    else if(contrasena.length < 8){
        Swal.fire("La contraseña debe tener mínimo 8 caracteres ");
        return false;
    }
    else if(contrasena.length > 15){
        Swal.fire("La contraseña debe tener máximo 15 caracteres");
        return false;
    }
    else if(contrasena != confirmarContrasena){
        Swal.fire("Las contraseñas no coinciden");
        return false;
    }

    

}