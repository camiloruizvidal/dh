<?php

include_once '../Controller/Servicios.php';
include_once '../Controller/Visual.php';
$render      = new Visual();
$Paquete     = new Servicios();
$id_paquete  = $_POST['id'];
$Paqueteinfo = $Paquete->VerDescripcionPaquete($id_paquete);

$Titulo         = strtoupper('<center>' . $Paqueteinfo['Nombre'] . ' - $' . number_format($Paqueteinfo['Valor']) . '</center>');
$Detalle        = $Paqueteinfo['Descripcion'];
$PaqueteDetalle = $Paquete->ServiciosXPaquete($id_paquete);
$PaqueteDetalle = $render->FormatoTable($PaqueteDetalle);
$PaqueteDetalle = $render->Tabla($PaqueteDetalle, '1', array ('Servicio', 'Precio unitario', 'Proveedor', 'Direccion', 'Telefono', 'Email', 'Cantidad', 'Valor con paquete'), 'table');
$Botones        = '<button type="button" class="btn btn-primary" onclick="ComprarPaquete(' . $id_paquete . ');">Comprar</button>';
$Botones.='<button type="button" class="btn btn-success">Cotizar</button>';
$Botones.='<button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>';
$Datos          = array ('Titulo' => $Titulo, 'Contenido' => $Detalle . '<br/><h1>Servicios</h1>' . $PaqueteDetalle . '<br/>', 'Botones' => $Botones);
echo json_encode($Datos);
