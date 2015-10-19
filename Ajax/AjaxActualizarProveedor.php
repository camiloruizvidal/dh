<?php
include_once '../Controller/Proveedor.php';
$Update = new Proveedor();
$Nombre    = $_POST['Nombre'];
$Telefono  = $_POST['Telefono'];
$Email     = $_POST['Email'];
$Nit       = $_POST['Nit'];
$Direccion = $_POST['Direccion'];
$Descripcion = $_POST['Descripcion'];
$id = $_POST['id'];
$Update->ActualizarProveedor($id,$Nombre, $Telefono, $Email, $Nit,$Direccion,$Descripcion);
echo '<div class="alert alert-info" role="alert">El proveedor '.$Nombre.' fue editado</div>';