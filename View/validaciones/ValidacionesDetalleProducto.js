function validarDetalleProducto(){
    let nombre, idTalla, idColor, precio, expresionNombre;
    nombre = document.getElementById("nombre").value;
    idTalla = document.getElementById("idTalla").value;
    idColor = document.getElementById("idColor").value;
    precio = document.getElementById("precio").value;
    expresionNombre = /[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,35}/;
    
    if(nombre == ""|| idTalla == "Seleccione la talla"||idColor == "Seleccione el color" || precio == ""){
        Swal.fire('Todos los campos deben ser diligenciados');
        return false;
    }
    
    else if(!expresionNombre.test(nombre)){
        Swal.fire("Debe ingresar un formato válido en el nombre");
        return false;
    }
}