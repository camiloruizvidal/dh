<?php
include_once '../Controller/Cotizar.php';
include_once '../Controller/Visual.php';
$Cotizar = new Cotizar();
$render = new Visual();
$id_cliente=$_POST['id'];
$Datos=$Cotizar->VerCabCotizacionClienteAprobadas($id_cliente);
$Datos=$render->FunctionTable($Datos, 0, 'Editar', 'images/lapiz.png');
echo $render->Tabla($Datos,'',array('Ver','Fecha cotizacion','Fecha de paquete','Descripcion','Valor aprobado'),'table');