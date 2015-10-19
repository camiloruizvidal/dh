<?php
include_once '../Controller/Servicios.php';
include_once '../Controller/Visual.php';
$Number              = new Visual();
$id_servicio_paquete = $_POST['id_servicio'];
$Servicio            = new Servicios();
$Datos               = $Servicio->Servicio_Paquete($id_servicio_paquete);

$Datos['cantidad_servicios']      = number_format($Datos['cantidad_servicios']);
$Datos['valor_unitario_servicio'] = number_format($Datos['valor_unitario_servicio'], 0);
$Datos['porcentaje_admin']        = number_format($Datos['porcentaje_admin'], 2, '.', ',');
?>
<div class = "container-fluid">
    <div class = "panel panel-primary">
        <div class = "panel-heading">
            Editar servicio
        </div>
        <div class = "panel-body">
            <div id = "Armar-Paquetes">
                <input type="hidden" id="id_servicio_paquete" value="<?php echo $id_servicio_paquete; ?>"/>
                <div class = "row">
                    <div class = "col-lg-3"><label for = "Paquete" >Paquete</label></div>
                </div>

                <div class = "row">
                    <div class = "col-lg-3"><label for = "Proveedor" >Proveedor</label></div>
                    <div class = "col-lg-9"><input type="text" readonly="true" class="form-control" value="<?php echo $Datos['Proveedor'] ?>"/></div>
                </div>

                <div class = "row">
                    <div class = "col-lg-3"><label for = "Servicio" >Servicio</label></div>
                    <div class = "col-lg-9"><input type="text" readonly="true" class="form-control"  value="<?php echo $Datos['Servicio'] ?>"/></div>
                </div>

                <div class = "row">
                    <div class = "col-lg-3"><label for = "Precio" >Indique el precio dentro del paquete</label></div>
                    <div class = "col-lg-9">
                        <div class = "input-group">
                            <div class = "input-group-addon">$</div>
                            <input type = "number" class = "form-control" id = "edit_ganancia"  value="<?php echo $Datos['valor_unitario_servicio'] ?>" placeholder = "Valor del servicio dentro del paquete">
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-lg-3"><label for = "Cantidad" >Seleccione la cantidad de servicios</label></div>
                    <div class = "col-lg-9"><input id = "edit_cantidad" class = "form-control" placeholder = "Cantidad" value="<?php echo $Datos['cantidad_servicios'] ?>" type = "number"/></div>
                </div>
                <div class = "row">
                    <div class = "col-lg-3"><label for = "Ganancia" >Porcentaje de ganancia</label></div>
                    <div class = "col-lg-9">
                        <div class = "input-group">
                            <div class = "input-group-addon">%</div>
                            <input type = "number" class = "form-control"  value="<?php echo $Datos['porcentaje_admin'] ?>" id = "edit_porcentaje" placeholder = "Porcentaje de venta">
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-lg-12">
                        <center>
                            <button type = "button" onclick = "GuardarEdicion()" class = "btn btn-success">Guardar</button>
                            <button type = "button" onclick = "CargarLista()" class = "btn btn-danger">Cancelar</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>