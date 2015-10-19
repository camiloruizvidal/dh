$("Formulario").submit(function (event) {

    return false;
});

function Guardar()
{
    var datos = $('#Formulario').serialize();
    console.log(datos);
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxGuardarPaquete.php",
        data: datos,
        success: function (Resultado)
        {
            modal(Resultado);
            CargarPaquetes();
        }
    });
}
function modal(id)
{
    if ($.isNumeric(id))
    {
        var url = './ver_paquetes.html?if=true&id=' + id;
        $('#ifrm').attr('src', url);
        $('#ifrm').attr('height', '450px');
        $('#myModal').modal('show');
    }
}
function CargarPaquetes()
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxVerPaquetes.php",
        success: function (Resultado)
        {
            $('#ListadoPaquetes').html(Resultado);
        }
    });
}
function formatearfechas()
{
    $('#FechaIncio').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
    $('#FechaFin').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
}
function CargarMunicipios()
{
    $('#Municipios').load('Ajax/AjaxSelectMunicipios.php');
}
$(function ()
{
    formatearfechas();
    CargarPaquetes();
    CargarMunicipios();
    $("#Formulario").submit(function ()
    {
        return false;
    });
});