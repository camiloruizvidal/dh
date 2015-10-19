<?php
include_once '../Controller/Cotizar.php';

$id_cotizacion=$_POST['id_cotizacion'];
$Cot=new Cotizar();
$Cot->EliminarCotizacion($id_cotizacion);