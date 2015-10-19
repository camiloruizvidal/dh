<?php

include_once '../Controller/Reserva.php';
include_once '../Controller/Visual.php';
$Render = new Visual();
$reservas = new Reserva();
$id     = $_POST['id'];
$Datos = $reservas->VerdetalleReserva($id);
$Datos=$Render->FormatoNumerico($Datos, 4, '$', 0);
$Datos=$Render->FormatoNumerico($Datos, 5, '$', 0);
$Cab=$reservas->DatosReserva($id);
echo '<a href="javascript:imprimir(1)"><img src="images/imp.gif"/></a><br/>';
echo '<strong>Valor:</strong>$'.number_format($Cab['valor']).'<br>';
echo '<strong>Proveedor:</strong>'.$Cab['Nombre'].'<br>';
echo $Render->Tabla($Datos,'',array('#','Descripcion','Servicio','Fecha de reserva','Cantidad','Valor unitario','Valor total'),'table table-hover','',1);