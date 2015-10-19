<?php
include_once '../Controller/Proveedor.php';
$Proveedor = new Proveedor();
extract($_POST);
echo $Proveedor->BloquearProveedor($id);