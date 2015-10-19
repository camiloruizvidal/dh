function validar()
{
    var Login=$('#usuario').val();
    var Pass=$('#clave').val();
    var res = $.ajax
    ({
        type: "POST",
        async: false,
        url: "./Codigo/AjaxValidarUsuario.php",
        data:
        {
            Login: Login,
            Pass: Pass
        }
    });
    return JSON.parse(res.responseText);
}
function ruta(url)
{
    $("#login_form").attr("action", url);
}
function alerta()
{
    $('#Error').html('<p style="color: red;">El nombre de usuario o contraseña no coinciden</p>');
}
$(document).ready(function ()
{
    $("#login_form").submit(function ()
    {
        var URL = validar();
        if(URL ==false)
        {
            alerta();
            return false;
        }
        else
        {
            ruta(URL);
            return true;
        }
    });
});