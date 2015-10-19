<?php
include_once '../Controller/Cliente.php';
$Cliente = new Cliente();
$Documento=$_POST['Numero_cedula'];
$valida=false;
$Datos = $Cliente->validarusuario($Documento);
if(!is_null($Datos))
{
    $valida=true;
    $Datos=  json_encode($Datos);
}
echo json_encode(array('sivalido'=>$valida,'id'=>$Datos));