<?php
extract($_POST);
include_once '../Controller/Servicios.php';
$Ser = new Servicios();
$Ser->ActualizarServiciosPaquetes($id,$cant,$valor);
        