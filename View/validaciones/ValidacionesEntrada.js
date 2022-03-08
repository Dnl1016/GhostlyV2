function validarEntrada(){
    let idDetalleProducto, cantidad;
    idDetalleProducto = document.getElementById("idDetalleProducto").value;
    cantidad = document.getElementById("cantidad").value;

    
    if(idDetalleProducto == "Seleccione el producto"|| cantidad == ""){
        Swal.fire('Todos los campos deben ser diligenciados');
        return false;
    }

}