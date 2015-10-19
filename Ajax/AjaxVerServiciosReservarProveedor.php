<?php

include_once '../Controller/Servicios.php';
include_once '../Controller/Visual.php';
$servicios = new Servicios();
$Render    = new Visual();
if ($_POST['idPaquetes'] != "0")
{
    $id_paquete = $_POST['idPaquetes'];
    $Res        = $servicios->VerDescripcionPaquete($id_paquete);
    $Ser        = $servicios->ServiciosXPaquete($id_paquete);
    $Ser        = $Render->FormatoTable($Ser);
    $Ser        = $Render->FormatoNumerico($Ser, '1', '$');
    $Ser        = $Render->FormatoNumerico($Ser, '7', '$');
    echo
    '<div class="row">
        <div class="col-lg-12" id="reserva">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>' . $Res['Nombre'] . '</h4>
                </div>
            <div class="panel-body">
                Precio: <strong>$' . $Res["Valor"] . '</strong> <br/>
                Fecha de inicio: <strong>' . $Res["Fecha_inicio"] . '</strong> <br/>
                Fecha de fin: <strong>' . $Res["Fecha_fin"] . '</strong> <br/>
                Municipio: <strong>' . $Res["nombreMunicipio"] . '</strong> <br/>
                <h3>' . $Res["Descripcion"] . '</h3> <br/>
                <button class="btn btn-primary" onclick="Reservar()">Reservar</button>
            </div>
        </div>
    <div class="row">
    <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Servicios y proveedores</h4>
                </div>
    <div class="panel-body">';
    echo $Render->Tabla($Ser, '1', array('#', 'servicio', 'Precio unitario', 'Proveedor', 'Direccion', 'Telefono', 'Email', 'Cantidad', 'Precio paquete'), 'table table-hover', '', 1);
    echo '</div>';
    echo '</div>';
    echo '</div>';
}