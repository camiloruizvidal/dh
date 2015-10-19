<?php
include_once '../Controller/Cliente.php';
$clien= new Cliente();
$id=$_GET['term'];
$datos=$clien->BuscarUsuarioNombreDocumento($id); 
echo json_encode($datos);