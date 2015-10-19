function Bloquear(id, Estado)
{
    $.ajax({
        url: "Ajax/AjaxBloquearPaquetes.php",
        type: 'POST',
        data: {
            id: id,
            Estado: Estado
        },
        success: function ()
        {
            Lista();
        }
    });
}
function Lista()
{
    $.ajax({
        url: "Ajax/AjaxVerPaquetes.php",
        success: function (Resultado)
        {
            $('#contenido').html(Resultado);
        }
    });
}
function CargarFoto(id)
{
    var form = '#img_' + id;
    var url = 'Ajax/AjaxCargarFotos.php?id='.$id;
    var data = new FormData();
    data.append('file', $(form)[0].files);

    $.ajax({
        url: url,
        data: data,
        processData: false,
        type: 'POST',
        success: function (Resultado) {
            alert(Resultado);
        }
    });
}
$(function ()
{
    Lista();
});