function generarelpago()
{
    var cod = $('#cod').val();
    $('#myModal').modal('hide');
    $.ajax({
        url: 'Ajax/AjaxPagarCliente.php',
        type: 'post',
        data: {id: cod},
        success: function (data)
        {
            $('#Reservas').html(data);
            Cargar();
        }
    });
}
function Pagar(cod)
{
    $('#myModal').modal('show');
}
function editar(cod)
{
    $.ajax({
        url: 'Ajax/AjaxVerServiciosReservaCliente.php',
        type: 'post',
        data: {id: cod},
        success: function (data)
        {
            $('#Reservas').html(data);
        }
    });
}
function Cargar()
{
    $('#Reservas').load('Ajax/AjaxVerReservasClientes.php');
}
$(function ()
{
    Cargar();
});
$('#confirm-delete').on('show.bs.modal', function (e) {
    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
});