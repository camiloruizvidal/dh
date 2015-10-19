<?php
if(isset($_POST['Paquetes']))
{
include_once '../Controller/Servicios.php';
include_once '../Controller/Visual.php';
$Render     = new Visual();
$Servicios  = new Servicios();
$id_paquete = $_POST['Paquetes'];
echo'<pre>';
$Datos=$Render->FormatoSelect($Servicios->VerServiciosEditDelete($id_paquete));
$En=array('#','Editar','Eliminar','Servicio','Precio','Proveedor','Dirección','Telefono','Correo','Cantidad<br/>por paquete','Valor');
echo $Render->Tabla($Datos,'',$En,'table','',TRUE);
}