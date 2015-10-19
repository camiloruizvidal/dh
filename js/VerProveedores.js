function GuardarCambios()
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxActualizarProveedor.php",
        data: {
            id: $('#id').val(),
            Nombre: $('#Nombre').val(),
            Telefono: $('#Telefono').val(),
            Email: $('#Email').val(),
            Nit: $('#Nit').val(),
            Direccion: $('#Direccion').val(),
            Descripcion: $('#Descripcion').val()
        },
        success: function (Resultado)
        {
            $('#notificacion').show();
            $('#notificacion').html(Resultado);
            setTimeout('Restaurar()',1000);
        }
    });
}
function Ver(id)
{
    $('#Listado_proveedores').hide();
    $('#editar').show();
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxVerProveedor.php",
        data: {
            id: id
        },
        success: function (Resultado)
        {
            Resultado = JSON.parse(Resultado);
            $('#Nombre').val(Resultado.Nombre);
            $('#Telefono').val(Resultado.Telefono);
            $('#Email').val(Resultado.Email);
            $('#Nit').val(Resultado.Nit);
            $('#Direccion').val(Resultado.Direccion);
            $('#Descripcion').val(Resultado.Descripcion);
            $('#id').val(id);
        }
    });
}
function Activar(id)
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxActivarProveedor.php",
        data: {
            id: id
        },
        success: function ()
        {
            Restaurar();
        }
    });
}
function Quitar(id)
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxQuitarProveedor.php",
        data: {
            id: id
        },
        success: function ()
        {
            Restaurar();
        }
    });
}
function Restaurar()
{
    $('#editar').hide();
    $('#notificacion').hide();
    $('#Listado_proveedores').show();
    $('#Listado_proveedores').load('./Ajax/AjaxVerProveedores.php');
}
$(function () {
    Restaurar();
});