<?php
include_once '../Controller/Servicios.php';
$Ser = new Servicios();
extract($_POST);
echo '<pre>';
$Datos = $Ser->Servicio_Paquete($id);
echo '<label>Cantidad</label><input id="CantServicio" value="'.$Datos['cantidad_servicios'].'" class="form-control"/>
<label>Precio</label><input id="PrecioServicio" value="'.number_format($Datos['valor_unitario_servicio'],0,'.','').'" class="form-control"/>
        <input type="hidden" id="id_servicio_paquete" value="'.$id.'">';