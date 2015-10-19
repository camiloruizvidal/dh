<?php
include_once '../Controller/Servicios.php';
$id_servicio_paquete=$_POST['id'];
$id_Paquetes=$_POST['Paquetes'];
$Ser = new Servicios();
$Datos=$Ser->VerServicioPaquete($id_servicio_paquete);
$Ser->Eliminar($id_servicio_paquete);
$Ser->ActualiarPaquete($id_Paquetes);
echo     '<div class="row">'
. '<div class="col-lg-12">'
        .'<h1>Se elimino el servicio "'.strtoupper($Datos['servicio'])
        .'" del proveedor "'.strtoupper($Datos['proveedor']).'", '
        .'Cantidad "'.$Datos['cantidad_servicios'].'"</h1>'
        . '</div></div>';