<?php
include_once '../Controller/Servicios.php';
$ser = new Servicios();
$est = '';
$servicio=$_POST['id_servicio'];
switch ($_POST['est'])
{
    case 'Auto':$est = 'S';
        break;
    case 'Cancel':$est = 'N';
        break;
}
$ser->CambiarEstadoServicio($est,$servicio);
