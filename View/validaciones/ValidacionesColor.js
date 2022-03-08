function validarColor(){
    let nombre;
    nombre = document.getElementById("nombre").value;
    expresionNombre = /[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,35}/;
    
    if(nombre == ""){
        Swal.fire('Todos los campos deben ser diligenciados');
        return false;
    }
    
    else if(!expresionNombre.test(nombre)){
        Swal.fire("Debe ingresar un formato válido en el nombre");
        return false;
    }
   
}