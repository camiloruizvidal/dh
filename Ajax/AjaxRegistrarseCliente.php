<?php
include_once '../Controller/Cliente.php';
$Cliente = new Cliente();
$Nombre=$_POST['Nombre'];
$Apellidos=$_POST['Apellidos'];
$tipoid=$_POST['tipoid'];
$Numeroid=$_POST['Numeroid'];
$email=$_POST['email'];
$Telefono=$_POST['Telefono'];
$id=$Cliente->RegistrarClientes($Nombre, $Apellidos, $tipoid, $Numeroid, $email,$Telefono);
$Datos = $Cliente->validarusuario2($Numeroid);
if(!is_null($Datos))
{
    $valida=true;
    $Datos=  json_encode($Datos);
}
echo json_encode(array('sivalido'=>$valida,'id'=>$Datos));