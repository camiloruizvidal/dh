<?php

include_once '../Controller/Reserva.php';
include_once '../Controller/Visual.php';
$Reserva = new Reserva();
$Render  = new Visual();
$Datos   = $Reserva->VerReservaHecha($_POST['id']);
$Detalle = ($Datos['Detalle']);

$Cab = ($Datos['Cab']);
echo '<strong>Nombre</strong>:' . $Cab['Nombre'] . '<br>';
echo '<strong>Email</strong>:' . $Cab['Email'] . '<br>';
echo '<strong>Telefono</strong>:' . $Cab['Telefono'] . '<br>';
echo '<strong>valor</strong>:$' . number_format($Cab['valor'], 0, '.', ',') . '<br>';
echo '<strong>Tipo de pago</strong>:<select name="tipopago" id="tipopago"><option value="efectivo">Efectivo</option><option value="Tarjetadebido">Tarjeta de debito</option><option value="credito">Tarjeta de crédito</option><option value="cheque">cheque</option><option value="transferencia">Transferencia bancaria</option></select><br>';
echo '<div class="modal-footer">';
echo '<center><button class="btn btn-danger" onclick="Cargar()">Regresar</button>';
if ($Cab['Pago'] != 'Pago')
{
    echo '<button class="btn btn-success" onclick="Pagar()">Confirmar pago</button></center>';
}
echo '</div>';
echo '<input type="hidden" value="' . $_POST['id'] . '" id="cod" name="cod">';
echo $Render->Tabla($Detalle, '', array ('#', 'Servicio', 'Proveedor', 'Direccion', 'Telefono', 'Cantidad', 'Valor unitario'), 'table table-hover', '', 1);
