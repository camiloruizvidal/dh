<?php

include_once '../Controller/Reserva.php';
include_once '../Controller/Visual.php';
$Render  = new Visual();
$Reserva = new Reserva();
$Datos   = $Reserva->VerReservasHechas();
$Datos   = $Render->FunctionTable($Datos, '', 'editar', 'images/lapiz.png');
$Datos   = $Render->FormatoNumerico($Datos, 4, '$', 0);
echo $Render->Tabla($Datos, '', array('#', 'Ver', 'Cliente', 'Email', 'Telefono', 'Precio', 'Fecha', 'Estado', 'Pago', 'Tipo'), 'table table-hover', '', 1);
