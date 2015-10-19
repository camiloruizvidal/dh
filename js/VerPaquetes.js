function ComprarPaquete(id)
{
    var url = "./Comprar?paquete=" + id;
    $('#Contenido').html(' ');
    $('#Botones').html(' ');
    $('#iframe').attr('src', url);
    $('#iframe').show('slow');
}
function VerModal(id)
{
    $('#iframe').hide();
    $.ajax({
        type: "POST",
        url: "./Ajax/AjaxVerPaquete.php",
        data: {
            id: id
        },
        success: function (Datos)
        {
            Datos = JSON.parse(Datos);
            $('#titulo_modal').html(Datos.Titulo);
            $('#Contenido').html(Datos.Contenido);
            $('#Botones').html(Datos.Botones);
            $('#myModal').modal('show');
        }
    });
}
function VerListado(Pagina)
{
    var municipio = $('#id_municipios').val();
    var FechaInicion = $('#FechaIncio').val();
    var FechaFin = $('#FechaFin').val();
    var n_pagina = Pagina;
    var cantidad_registros_pagina = 24;
    $.ajax({
        type: "POST",
        url: "./Ajax/AjaxVerListadoPaquetes.php",
        data: {
            municipio: municipio,
            FechaInicion: FechaInicion,
            FechaFin: FechaFin,
            n_pagina: n_pagina,
            cantidad_registros_pagina: cantidad_registros_pagina
        },
        success: function (Res)
        {
            $('#listado').html(Res);
        }
    });
}
function Buscar()
{

    VerListado(1);
}
function Iniciar()
{
    $('#FechaIncio').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
    $('#FechaFin').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
    $('#selectMunicipios').load('Ajax/AjaxSelectMunicipios.php');
}
$(function ()
{
    $('#iframe').hide();
    Iniciar();
    VerListado(1);
});