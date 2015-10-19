<?php

include_once '../Controller/Visual.php';
include_once '../Controller/Servicios.php';
$Render    = new Visual();
$Servicios = new Servicios();
$id_proveedor=$_POST['proveedor'];
$Servicio=$Render->FormatoSelect($Servicios->VerServiciosProveedor($id_proveedor));
echo $Render->Select($Servicio, 'Servicios', '','idServicios','','','','form-control');