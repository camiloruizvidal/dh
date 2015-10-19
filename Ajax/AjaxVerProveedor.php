<?php
include_once '../Controller/Proveedor.php';
$Ver = new Proveedor();
$id=$_POST['id'];
echo json_encode($Ver->BuscarProveedor($id));
