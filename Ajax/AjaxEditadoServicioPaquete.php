<?php
include_once '../Controller/Servicios.php';
$Servicios = new Servicios();
$id_servicio_paquete=$_POST['id_servicio_paquete'];
$edit_ganancia=$_POST['edit_ganancia'];
$edit_cantidad=$_POST['edit_cantidad'];
$edit_porcentaje=$_POST['edit_porcentaje'];
$Servicios->EditarServiciosPaquete($id_servicio_paquete, $edit_cantidad, $edit_ganancia, $edit_porcentaje);