<?php

include_once '../Controller/Cliente.php';
include '../Controller/Reserva.php';
$Cliente = new Cliente();
$Reserva = new Reserva();
$Nombres       = $_POST["Nombres"];
$Numero_Id     = $_POST["Documento"];
$TipoID        = $_POST["Tipoid"];
$Email         = $_POST["Email"];
$Telefono      = $_POST["Telefono"];
$id_paquete    = $_POST["Paquetes"];
$Fecha_reserva = $_POST["Fecha"];
$Pago          = $_POST["pago"];
$id_cliente    = $Cliente->RegistrarClientes($Nombres, '', $TipoID, $Numero_Id, $Email, $Telefono);
$id=$Reserva->ReservarPaquete($id_paquete, $id_cliente, $Fecha_reserva, $Pago);

echo 'Se ha registrado con éxito';
echo $id;