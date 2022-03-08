function validarProducto(){
    let nombre, genero, estado, idCategoria;
    nombre = document.getElementById("nombre").value;
    genero = document.getElementById("genero").value;
    estado = document.getElementById("estado").value;
    idCategoria = document.getElementById("idCategoria").value;
    expresionNombre = /[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,35}/;
    
    if(nombre == ""|| genero == "Seleccione el genero"||estado == "Seleccione el estado" || idCategoria  == "Seleccion la categoria"){
        Swal.fire('Todos los campos deben ser diligenciados');
        return false;
    }
    
    else if(!expresionNombre.test(nombre)){
        Swal.fire("Debe ingresar un formato válido en el nombre");
        return false;
    }
}