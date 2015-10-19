<?php
include_once '../Controller/Reserva.php';
$id=$_POST['id'];
$Reserva= new Reserva();
$Reserva->PagarReserva($id);