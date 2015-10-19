<?php
include_once '../Controller/Visual.php';
include_once '../Controller/Servicios.php';
$Render = new Visual();
$Proveedor = new Servicios();
$id_proveedor='';
if($_GET)
{
    $id_proveedor=$_GET['id'];
}
$Datos=$Proveedor->VerTodosServiciosActivos($id_proveedor);
echo $Render->Select($Datos);