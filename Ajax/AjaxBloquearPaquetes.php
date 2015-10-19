<?php
include_once '../Controller/Servicios.php';
$paquete = new Servicios();
extract($_POST);
echo $paquete->AutorizarPaquetes($id, $Estado);