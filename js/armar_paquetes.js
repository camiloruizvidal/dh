function Editar(id_servicio)
{
    $.ajax({
        type: 'POST',
        url: "../Ajax/AjaxEditarInfoServicio.php",
        data: {
            id_servicio: id_servicio
        },
        success: function (Resultado)
        {
            $('#Lista').html(Resultado);
        }
    });
}
function Eliminar(id_servicio)
{
    $.ajax({
        type: 'POST',
        url: "../Ajax/AjaxEditarServicio.php",
        data: {
            id_servicio: id_servicio
        },
        success: function ()
        {
            CargarLista();
        }
    });
}
function Guardar()
{
    var Paquetes = $('#idPaquetes').val();
    var Servicio = $('#idServicios').val();
    var Precio = $('#ganancia').val();
    var Cantidad = $('#Cantidad').val();
    var Porcentaje = $('#Porcentaje').val();
    $.ajax({
        type: 'POST',
        url: "../Ajax/AjaxGuardarServicioPaquete.php",
        data: {
            Paquetes: Paquetes,
            Servicio: Servicio,
            Precio: Precio,
            Cantidad: Cantidad,
            Porcentaje: Porcentaje
        },
        success: function (Resultado)
        {
            $('#Resultado').html(Resultado);
            CargarLista();
        }
    });
}
function GuardarEdicion()
{
    var id_servicio_paquete = $('#id_servicio_paquete').val();
    var edit_ganancia = $('#edit_ganancia').val();
    var edit_cantidad = $('#edit_cantidad').val();
    var edit_porcentaje = $('#edit_porcentaje').val();
    $.ajax({
        type: 'POST',
        url: "../Ajax/AjaxEditadoServicioPaquete.php",
        data: {
            id_servicio_paquete: id_servicio_paquete,
            edit_ganancia: edit_ganancia,
            edit_cantidad: edit_cantidad,
            edit_porcentaje: edit_porcentaje
        },
        success: function (Resultado)
        {
            $('#Log').html(Resultado);
            CargarLista();
        }
    });
}
function CargarLista()
{
    var Paquetes = $('#idPaquetes').val();
    var NombrePaquete = $('#idPaquetes:selected').text();
    $.ajax({
        type: 'POST',
        url: "../Ajax/AjaxCargarListaPaquetes.php",
        data: {
            Paquetes: Paquetes
        },
        success: function (Resultado)
        {
            $('#Lista').html(Resultado);
            $('#Texto_lista').html('Servicios del paquete ' + NombrePaquete);
        }
    });
}


function CargarServicios()
{
    var proveedor = $('#idProveedores').val();
    $.ajax({
        type: 'POST',
        url: "../Ajax/AjaxCargarServiciosProveedor.php",
        data: {
            proveedor: proveedor
        },
        success: function (Resultado)
        {
            $('#Servicios').html(Resultado);
        }
    });
}
function CargarDatos()
{
    var Proveedores = $('#Proveedores').val();
    $.ajax({
        url: "../Ajax/AjaxVerArmarPaquetes.php",
        data: {
            Proveedores: Proveedores
        },
        success: function (Resultado)
        {
            Resultado = JSON.parse(Resultado);
            $('#Paquetes').html(Resultado.Paquetes);
            $('#Proveedores').html(Resultado.Proveedores);
        }
    });
}
$(function ()
{
    CargarDatos();
    $('#ganancia').numeric('.');
    $('#Cantidad').numeric();
    $('#Porcentaje').numeric('.');
});