<?php
include_once '../Controller/Cotizar.php';
include_once '../Controller/Visual.php';
$cotizar = new Cotizar();
$Render = new Visual();
$id_cotizacion=$_POST['id'];
$Res = $cotizar->VerCotizacionEdit($id_cotizacion);
$Res =$Render->FormatoNumerico($Res,4,'$',0,'.',',');
$Total=$cotizar->Total($id_cotizacion);

$Datos=$Render->Tabla($Res,'',array('#','Proveedor','Servicio','Cantidad','Valor','Valor total'),'table','',true);
echo json_encode(array('Datos'=>$Datos,'Total'=>'Precio estimado $'.number_format($Total,0,'.',',')));