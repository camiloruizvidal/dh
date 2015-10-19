function carousel()
{
    $('.carousel').carousel({
        interval: 10000
    })
}
function VerPaquetes()
{
    $.ajax({
        type: 'POST',
        url: "Ajax/AjaxListadoPaquetes.php",
        success: function (Resultado)
        {
            $('#ListaPaquetes').html(Resultado);
        }
    });
}
$(function () {
    carousel();
    VerPaquetes();
});