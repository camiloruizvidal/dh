<?php
include_once '../Controller/Servicios.php';
include_once '../Controller/Visual.php';
$Render = new Visual();
$Ser = new Servicios();
$id_proveedor=$_POST['id_proveedor'];
$res = $Ser ->VerServiciosProveedorAdmin($id_proveedor);
$res = $Render->FormatoTable($res);
$res = $Render->FunctionTable($res, 0, 'Editar', 'images/lapiz.png');
echo $Render->Tabla($res,'1',array('#','Editar','Servicio','Autorizado','Disponible'),"table table-hover",'',true);