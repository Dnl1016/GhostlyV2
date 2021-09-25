$(document).ready(function(){
    $('#agregarDetalleProducto').click(function(){
        let contador = 0;
        let nombre = $('#nombre').val();
        let idTalla = $('#idTalla option:selected').val();
        let idColor = $('#idColor option:selected').val();
        let talla = $('#idTalla option:selected').text();
        let color = $('#idColor option:selected').text();
        let precio = $('#precio').val();
        $('#cajaDetalleProducto').append(`
            <tr id="tr-${contador}">
                <input type="hidden" name="nombre[]" value="${nombre}">
                <input type="hidden" name="idTalla[]" value="${idTalla}">
                <input type="hidden" name="idColor[]" value="${idColor}">
                <input type="hidden" name="precio[]" value="${precio}">
                <th>${nombre}</th>
                <th>${talla}</th>
                <th>${color}</th>
                <th>${precio}</th>
                <th>
                    <button type="button" class="btn btn-danger" onclick="eliminarDetalleProducto(${contador})">X</button>
                </th>
            </tr>
        `);
        contador += 1;
    });
});

function eliminarDetalleProducto(contador){
    $('#tr-'+contador).remove();
}