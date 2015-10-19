<?php

include_once '../Controller/Visual.php';
include_once '../Controller/Proveedor.php';
include_once '../Controller/Servicios.php';
$id='';
if(isset($_POST['id']))
{
    $id=$_POST['id'];
}

$Render         = new Visual();
$Proveedor      = new Proveedor();
$Paquetes       = new Servicios();
$DatosPaquete   = ($Render->FormatoSelect($Paquetes->VerPaquetes()));
$DatosServicios = ($Render->FormatoSelect($Proveedor->VerProveedores()));
$Paquete        = $Render->Select($DatosPaquete, 'Paquetes', $id, 'idPaquetes', 'CargarLista()', '', '', 'form-control');
$Proveedores    =$Render->Select($DatosServicios, 'Proveedores', '', 'idProveedores', 'CargarServicios()', '', '', 'form-control');
echo json_encode(array('Paquetes'=>$Paquete,'Proveedores'=>$Proveedores));