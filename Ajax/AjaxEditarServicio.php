<?php

include_once '../Controller/Servicios.php';
$servi               = new Servicios();
$id_paquete          = $_POST['Paquetes'];
$estado              = $_POST['estado'];
$id_servicio_paquete = $_POST['id_servicio'];
echo $servi->QuitarServiciosPaquete($id_servicio_paquete);
