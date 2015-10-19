<?php

include_once("../controller/GenerarReserva.php");
$Guardar  = new GenerarReserva();
echo $Guardar->GenerarReserva_Agregar_Registrocliente($_POST);