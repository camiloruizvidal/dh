<?php

include_once '../Controller/Cotizar.php';
include_once '../Controller/Visual.php';
$Render        = new Visual();
$Cot           = new Cotizar();
$id_cotizacion = $_POST['id'];
$Datos         = $Cot->VerCotizacionAprobadas($id_cotizacion);
$Precio        = $Cot->VerTotal($id_cotizacion);
echo '<center><button class="btn btn-primary" onclick="Recargar()">Cancelar</button><button class="btn btn-success" onclick="AprobarCotizacion('.$id_cotizacion.')">Generar reserva</button><button onclick="EliminarCotizacion('.$id_cotizacion.')" class="btn btn-danger">Eliminar reserva</button></center><br/>';
$Form          = '<div class="panel panel-primary">
    <div class="panel-heading">
        <h1> Precio total $' . number_format($Precio, '0', ',', '.') . '</h1>
    </div>
    <div class="panel-body">
    <form id="ArmarCotizaciones" type="post">
    <div class="row">
        <div id="proveedor">
        </div>
    </div>

    <div class="row">

        <div class="col-lg-2">
            <label>Servicio</label>
        </div>
        <div class="col-lg-10">
            <div id="servicios">

                <select class="form-control"></select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <label from="Proveedor">Seleccione una cantidad</label>
        </div>
        <div class="col-lg-10">
            <input type="number" class="form-control" required="required" id="cantidad" name="cantida" placeholder="que cantidad desea cotizar"/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <label from="Precio">Ingrese el precio autorizado</label>
        </div>
        <div class="col-lg-10">
            <input type="number" class="form-control" required="required" id="precio" name="precio" placeholder="Ingrese el precio autorizado"/>
        </div>
    </div>
    <input type="hidden" name="CodCabCotizacion" id="CodCabCotizacion" value="' . $id_cotizacion . '"/>
    <div class="row">
        <div class="col-lg-12">
            <center><button class="btn btn-success" onclick="GuardarCotizacion(' . $id_cotizacion . ')">Agregar</button></center>
        </div>
    </div>
</form>
</div>
</div>
<script>$("#ArmarCotizaciones").submit(false);</script>';
echo $Form;
echo $Render->Tabla($Datos, '', array('#', 'Proveedor', 'Servicio', 'Cantidad', 'Precio unitario', 'Precio Total'), 'table table-hover', '', 1);
