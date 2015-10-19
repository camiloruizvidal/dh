$(document).ready(function ()
{
    var paquete = getUrlVars()['paquete'];
    ValidarForm();
    EnviarForm();
    ValidarCliente();
    Ocultar();
    Validar(paquete);
});
function Ocultar()
{
    $('#Datos').hide();
}
function ValidarCliente()
{
    $("#ValidarUsuario").click(function (e)
    {
        $.ajax({
            type: 'POST',
            url: "Ajax/AjaxBuscarUsuario.php",
            data: {id_usuario: $('#Numero_Id').val()},
            success: function (Resultado)
            {
                Resultado = JSON.parse(Resultado);
                if (Resultado.Valida)
                {
                    $('#Nombres').val(Resultado.Datos.Nombres);
                    $('#Apellidos').val(Resultado.Datos.Apellidos);
                    $('#Email').val(Resultado.Datos.Email);
                    $('#Telefono').val(Resultado.Datos.Telefono);
                    $('#TipoID').val(Resultado.Datos.TipoID);
                }
                $('#Datos').show("slow");
            }
        });
    });
}
function Validar(id)
{
    $.ajax({
        url: 'Ajax/AjaxBuscarPaquete.php',
        type: 'POST',
        data: {paquete: id},
        success: function (Data)
        {
            Data = JSON.parse(Data);
            $('#nombre').val(Data.Nombre);
            $('#Precio').val('$'+Data.Valor);
        }
    });

}
function EnviarForm()
{
    $("#FormRegistrocliente").submit(function (e) {
        if ($("#FormRegistrocliente").validate().form())
        {
            e.preventDefault();
            $.ajax({
                type: $('#FormRegistrocliente').attr('method'),
                url: $('#FormRegistrocliente').attr('action'),
                data: $('#FormRegistrocliente').serialize(),
                success: function (Data)
                {
                    $('.panel').hide('slow');
                    $("#Log").html('<center><h1>Su código de compra es '+Data);
                }
            });
        }

    });
}
function ValidarForm()
{
    $('form button').on("click", function (e) {
        e.preventDefault;
    });
}
