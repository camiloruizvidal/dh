<?php
include_once '../Controller/Servicios.php';
$ser = new Servicios();
$Nombre=$_POST['Nombre'];
$Finicio=$_POST['FechaIncio'];
$FFin=$_POST['FechaFin'];
$Descripcion=$_POST['Descripcion'];
$Municipio=$_POST['id_municipios'];
$Imagen='';//$_POST['imagen'];
echo $ser->OfertarPaquete($Nombre, 0, $Finicio, $FFin, 'S', 'S',$Descripcion,$Imagen,$Municipio);
