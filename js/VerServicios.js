var cod;
function CambiarEstado(est)
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxCambiarEstado.php",
        data:
                {
                    id_servicio: cod,
                    est: est
                },
        success: function (Resultado)
        {
            buscarservicios();
            $('#myModal').modal('hide');
        }
    });
}
function Editar(codigo)
{
    cod=codigo;
    $('#myModal').modal('show');
}
function buscarservicios()
{
    var id = $('#id_proveedores').val();
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxVerServiciosAdmin.php",
        data: {id_proveedor: id},
        success: function (Resultado)
        {
            $('#ListServicios').html(Resultado);
        }
    });
}
function CargarProveedor()
{
    $('#Servicios').load('Ajax/AjaxVerServiciosProveedor.php');
}
$(function ()
{
    CargarProveedor();
});