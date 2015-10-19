<?php
include_once '../Controller/Visual.php';
include_once '../Controller/Servicios.php';
$Render = new Visual();
$Proveedor = new Servicios();
$Proveedores = $Proveedor->VerProveedoresActivos();
echo '<div="row">';
echo '<div class="col-lg-2"><label from ="Proveedor">Proveedor</label></div><div class="col-lg-10">'.$Render->Select($Proveedores,'id_proveedores','','id_proveedores','buscarservicios()','','','form-control').'</div>';
echo '</div>';