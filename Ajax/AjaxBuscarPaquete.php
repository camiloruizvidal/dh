<?php
include_once '../Controller/Servicios.php';
$Ver = new Servicios();
$Datos = $Ver->VerPaquete($_POST['paquete']);
$Datos['Valor']=  number_format($Datos['Valor'],2,'.',',');
echo json_encode($Datos);