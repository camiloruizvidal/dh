<?php

include_once '../Controller/Cotizar.php';
include_once '../Controller/Visual.php';
$Render = new Visual();
$cot = new Cotizar();
$Servicios=$_POST["Servicios"];
$cantidad=$_POST["cantida"];
$CodCabCotizacion=$_POST["CodCabCotizacion"];
$id=$cot->DetalleCotizacion($Servicios, $cantidad, $CodCabCotizacion);
$Res = $cot->VerCotizacion($CodCabCotizacion);
echo '<h1 align="center">Precio $'. number_format($cot->Total($CodCabCotizacion),0,',','.').'</h1><br/>';
$Res = $Render->FormatoNumerico($Res, 3,'$',0);
$Res = $Render->FormatoNumerico($Res, 4,'$',0);
echo $Render->Tabla($Res,'',array('#','Proveedor','Servicio','Cantidad','Valor unitario','Valor total'),'table','',TRUE);