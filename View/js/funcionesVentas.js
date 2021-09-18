function consultarPrecio(idProducto) {
    $("#precioUnitario").val("");
    $("#precioUnitarioOculto").val("");
    $("#precioTotal").val("");
    $("#cantidad").val("");
    if (idProducto != "") {
        let form = new FormData();
        form.append("idProducto", idProducto);
        form.append("consultarPrecio", "");
        $.ajax({
            url: "../Controller/controladorVentas.php", //Consultamos el controlador
            type: "post",
            data: form,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#precioUnitario").val(response);
            },
        });
    }
}

$("#cantidad").keyup(function () {
    $("#precioTotal").val(
        $("#cantidad").val() * $("#precioUnitario").val()
    );
});

$("#cantidad").keypress(function () {
    $("#precioTotal").val(
        $("#cantidad").val() * $("#precioUnitario").val()
    );
});

let arrayIdProducto = [];
let arrayCantidad = [];
let arrayPrecioUnitario = [];
$('#agregarVenta').click(function(){
    let idProducto = $('#idDetalleProducto option:selected').val();
    let nombreProducto = $('#idDetalleProducto option:selected').text();
    let cantidad = $('#cantidad').val();
    let precioUnitario = $('#precioUnitario').val();
    let precioTotal = $('#precioTotal').val();

    $('#cajaVentas').append(`
        <tr id="tr-${idProducto}">
            <input type="hidden" name="detalleIdProducto[]" value="${idProducto}">
            <input type="hidden" name="detalleCantidad[]" value="${cantidad}">
            <input type="hidden" name="detallePrecioUnitario[]" value="${precioUnitario}">
            <td>${nombreProducto}</td>
            <td>${cantidad}</td>
            <td>${precioUnitario}</td>
            <td>${precioTotal}</td>
            <td>
                <button type="button" onclick="eliminarDetalleVenta(${idProducto}, ${precioTotal})" class="btn btn-danger">X</button>
            </td>
        </tr>
    `);

    let precioTotalVenta = $('#precioTotalVenta').val() || 0;
    $('#precioTotalVenta').val(parseInt(precioTotalVenta) + parseInt(precioTotal));
}); 

function eliminarDetalleVenta(idProducto, subtotal){
    $('#tr-'+idProducto).remove();
    let precioTotalVenta = $('#precioTotalVenta').val() || 0;
    $('#precioTotalVenta').val(parseInt(precioTotalVenta) - parseInt(subtotal));
}