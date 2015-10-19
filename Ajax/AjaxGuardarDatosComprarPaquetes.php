<?php

include_once '../Controller/Reserva.php';
$Reservar = new Reserva();
extract($_POST);
echo json_encode($Reservar->ReservarServicios($servicio, $cantidad, $Documento,$fecha,$proveedor,$Nombres,$Tipoid,$Email,$Telefono));
