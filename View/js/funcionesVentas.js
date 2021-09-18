let idArray = [];
let cantidadArray = [];
$(document).ready(function(){
    $('#agregarEntrada').click(function(){
        let cantidad = parseInt($('#cantidad').val());
        let idDetalleProducto = parseInt($('#idDetalleProducto option:selected').val());
        let producto = $('#idDetalleProducto option:selected').text();
        if(idArray.includes(idDetalleProducto)){
            $(`#tr-${idDetalleProducto}`).remove();
            let indice = idArray.indexOf(idDetalleProducto);
            cantidad += parseInt(cantidadArray[indice]);
            cantidadArray.splice(indice, 1);
            idArray.splice(indice, 1);
            cantidadArray.push(cantidad);
            idArray.push(idDetalleProducto);
        }else{
            idArray.push(idDetalleProducto);
            cantidadArray.push(cantidad);
        }
        $('#cajaEntradas').append(`
            <tr id="tr-${idDetalleProducto}">
                <input type="hidden" name="cantidad[]" value="${cantidad}">
                <input type="hidden" name="idDetalleProducto[]" value="${idDetalleProducto}">
                <th>${producto}</th>
                <th>${cantidad}</th>
                <th>
                    <button type="button" class="btn btn-danger" onclick="eliminarEntrada(${idDetalleProducto})">X</button>
                </th>
            </tr>
        `);
        $('#cantidad').val() = '';
        $('#idDetalleProducto').val() = 0;
        $('#idDetalleProducto').text() = "";
    });
});

function eliminarEntrada(idDetalleProducto){
    let indice = idArray.indexOf(idDetalleProducto);
    cantidadArray.splice(indice, 1);
    idArray.splice(indice, 1);
    $('#tr-'+idDetalleProducto).remove();
}