var user;
function buscarservicios()
{
    var datos = $('#id_proveedores').val();
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxCargarServiciosProveedor.php",
        data: {proveedor: datos},
        success: function (res)
        {
            $('#servicios').html(res);
        }
    });
}
function EliminarCotizacion(id)
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxBorrarCotizacion.php",
        data: {id_cotizacion: id},
        success: function ()
        {
            Recargar();
        }
    });
}
function AprobarCotizacion(id)
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxAgregarCotizacion.php",
        data: {id_cotizacion: id},
        success: function ()
        {
            EliminarCotizacion(id);
            Recargar();
        }
    });
}
function GuardarCotizacion(id)
{
    var data = $('#ArmarCotizaciones').serialize();
    $.ajax({
        url: 'Ajax/AjaxGuardarCotizacionAprobada.php',
        type: 'post',
        data: data,
        success: function ()
        {
            Editar(id);
        }
    });
}
function Recargar()
{
    Buscar(user);
}
function Editar(id)
{
    $.ajax({
        url: 'Ajax/AjaxDetalleCotizacion.php',
        type: 'post',
        data: {id: id},
        success: function (Resultado)
        {
            $('#Contenido').html(Resultado);
            $('#proveedor').load('Ajax/AjaxVerServiciosProveedor.php');
        }
    });
}
function Buscar(id)
{
    $.ajax({
        url: 'Ajax/AjaxVerCotizacionesUsuario.php',
        type: 'post',
        data: {id: id},
        success: function (Resultado)
        {
            $('#Contenido').html(Resultado);
        }
    });
}
function Formato()
{
    $('#Documento').autocomplete({
        source: 'Ajax/AjaxClientesAutocomplete.php',
        select: function (event, data)
        {
            user = data.item.id;
            Buscar(user);
        }

    });
}
$(function ()
{
    $('#ArmarCotizaciones').submit(false);
    Formato();
});