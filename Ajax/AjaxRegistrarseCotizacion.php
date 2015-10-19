<?php
include_once '../Controller/Cotizar.php';
include_once '../Controller/Visual.php';
$Render = new Visual();
$coti=new Cotizar();
$FechaInicio=$_POST['FechaInicio'];
$descripcion_cotizacion=$_POST['descripcion_cotizacion'];
$codusuario=$_POST['codusuario'];
$id = $coti->CabCotizacion($FechaInicio, $descripcion_cotizacion, $codusuario);
echo $id;