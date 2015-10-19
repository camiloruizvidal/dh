<?php
include_once '../Controller/Cotizar.php';
include_once '../Controller/Reserva.php';
$id_cotizacion=$_POST['id_cotizacion'];
$Cot=new Cotizar();
$Reserva=new Reserva();
$Datos = $Cot->VerCabCotizaciones($id_cotizacion);
$id=$Reserva->Reservar(NULL, $Datos['id_cliente'], $Datos['precio'], $Datos['fecha_cotizacion'], $Datos['fecha_inicio'], 'Cotizacion', 'N',$id_cotizacion);