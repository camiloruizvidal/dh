<?php

include_once '../Controller/GenerarReserva.php';
if (!is_numeric($_POST['id_usuario']) || $_POST['id_usuario'] == '')
{
    echo json_encode(array ('Valida' => false));
}
else
{
    $Buscar = new GenerarReserva();
    $Datos  = $Buscar->BuscarCliente($_POST['id_usuario']);
    if ($Datos)
    {
        echo json_encode(array ('Valida' => true, 'Datos' => $Datos));
    }
    else
    {
        echo json_encode(array ('Valida' => false));
    }
}