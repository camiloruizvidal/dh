<?php

include_once '../Controller/Cotizar.php';
echo '<pre>';
$id_servicio   = $_POST['Servicios'];
$cantidad      = $_POST['cantida'];
$id_cotizacion = $_POST['CodCabCotizacion'];
$Precio        = $_POST['precio'];
$cot           = new Cotizar();
$id            = $cot->DetalleCotizacion($id_servicio, $cantidad, $id_cotizacion, $Precio);
