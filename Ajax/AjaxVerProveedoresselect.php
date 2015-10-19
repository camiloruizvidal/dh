<?php
include_once '../Controller/Visual.php';
include_once '../Controller/Servicios.php';
$Render = new Visual();
$Proveedor = new Servicios();
$Proveedores = $Proveedor->VerProveedoresActivos();

echo $Render->Select($Proveedores,'id_proveedores','','id_proveedores','buscarservicios()','','','form-control');