function validarVenta(){
    let idPersona,nombreVenta, idDetalleProducto, cantidad ;
    idPersona = document.getElementById("idPersona").value;
    nombreVenta= document.getElementById("nombreVenta").value;
    idDetalleProducto = document.getElementById("idDetalleProducto").value;
    cantidad= document.getElementById("idCategoria").value;
    expresionNombre = /[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,35}/;
    
    if(idPersona == "Seleccione la persona"|| nombreVenta == ""||idDetalleProducto == "Seleccione el producto a vender" || cantidad  == ""){
        Swal.fire('Todos los campos deben ser diligenciados');
        return false;
    }
    
    else if(!expresionNombre.test(nombreVenta)){
        Swal.fire("Debe ingresar un formato válido en el nombre");
        return false;
    }
}