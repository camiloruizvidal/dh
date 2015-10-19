<?php
include_once '../Controller/Cotizar.php';
include_once '../Controller/Visual.php';
$Cotizar = new Cotizar();
$Render = new Visual();
$Res = $Cotizar->VerCabCotizacion();
$Res=$Render->FunctionTable($Res,0,'VerDetalle','images/lapiz.png');
echo $Render->Tabla($Res,'',array('#','Ver','Nombre','Apellido','Email','Telefono','Fecha de pedido','Fecha para viaje','Descripción','Valor estimado'),'table','',TRUE);