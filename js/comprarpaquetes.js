$(function ()
{
    $('#proveedor').load('Ajax/AjaxVerProveedoresselect.php');
    $('#Datos').hide();
    $("#Buscar").click(function () {
        $('#Formulario').submit(false);
        $('#Datos').show('slow');
    });


    $("#proveedor").change(function () {
        var id = $('#proveedor').val();
        $('#servicio').load('Ajax/AjaxVerTodosServicios.php?id=' + id);
    });
    inicio();
});
function valida()
{
    //console.log($("#Formulario").validate());
    return true;
}
function enviar()
{
    if (valida())
    {

        var data = $('#Formulario').serialize();
        $.ajax({
            url: "Ajax/AjaxGuardarDatosComprarPaquetes.php",
            data: data,
            type: 'POST',
            success: function (res) {
                res = JSON.parse(res);
                $('#Numeroval').html(res.codigo);
                $('#Preciostotal').html(res.valor);
                $('#myModal').modal('show');
                $('#Tipoid').val(0);
                $('#Documento').val('');
                $('#Nombres').val('');
                $('#proveedor').val('0');
                $('#cantidad').val('');
                $('#servicio').val('0');
                $('#fecha').val('');
                $('#Email').val('');
                $('#Telefono').val('');
                $('#Datos').hide();
            }
        });
    }
}
function inicio()
{
    $('#Nombres').autocomplete({
        source: 'Ajax/AjaxClientesAutocomplete.php',
        search: function (data)
        {
            $('#Tipoid').val(0);
            $('#Documento').val('');
            $('#Email').val('');
            $('#Telefono').val('');
        },
        select: function (event, data)
        {
            data = data.item;
            $('#Nombres').val(data.Nombres + ' ' + data.Apellidos);
            $('#Tipoid').val(data.TipoID);
            $('#Documento').val(data.Numero_Id);
            $('#Email').val(data.Email);
            $('#Telefono').val(data.Telefono);
        }
    });
}