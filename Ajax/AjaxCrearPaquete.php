<?php
include_once '../Controller/Visual.php';
include_once '../Controller/Servicios.php';
$Render = new Visual();
$Insertar = new Servicios();
$id_paquete=$_POST['paquete'];
$id_servicio=$_POST['Servicio'];
$cantidad_servicios=$_POST['Cantidad'];
$valor_unitario_servicio=$_POST['Precio'];
$id=$Insertar->ArmarPaquetes($id_paquete, $id_servicio, $cantidad_servicios, $valor_unitario_servicio);
echo $id;