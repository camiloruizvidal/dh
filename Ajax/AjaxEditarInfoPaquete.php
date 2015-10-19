<?php
include_once '../Controller/Servicios.php';
$ser = new Servicios();
$FechaInicio=$_POST['FechaInicio'];
$FechaFin=$_POST['FechaFin'];
$Paquetes=$_POST['Paquetes'];
$Nombre=$_POST['Nombre'];
$Descripcion=$_POST['Descripcion'];
$Municipios=$_POST['Municipios'];
$ser->EditarPaquete($Paquetes,$Nombre,$Descripcion,$Municipios,$FechaInicio,$FechaFin);
echo 'Se ha realizado el cambio';