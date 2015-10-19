<?php

include_once '../Controller/Servicios.php';
include_once '../Controller/Proveedor.php';
include_once '../Controller/Reserva.php';
include_once '../Controller/Visual.php';
require_once "../Controller/Nusoap/nusoap.php";

function SiValida($cod_proveedor)
{
    $Validar = new Proveedor();
    $Res     = $Validar->ValidarProveedor($cod_proveedor);
    return json_encode(array ('Activo' => $Res, 'id' => $cod_proveedor));
}

function SiEstaActivoProveedor($cod_proveedor)
{
    $SIValido = SiValida($cod_proveedor);
    $SIValido = json_decode($SIValido);
    return $SIValido->Activo;
}

function VerPaquetes()
{
    $Paquetes = new Servicios();
    return json_encode($Paquetes->VerPaquetes());
}

function VerPaquetesServicios()
{
    $Paquetes = new Servicios();
    return json_encode($Paquetes->VerPaquetesConServicios());
}

function TotalReservaCotizacion($Cod_proveedor, $FechaIncial, $FechaFinal)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Cuentas = new Proveedor();
        $Res     = $Cuentas->TotalReservaCotizacion($Cod_proveedor, $FechaIncial, $FechaFinal);
        return json_encode($Res);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function TotalValorServicios($Cod_proveedor, $id_servicio, $FechaIncial, $FechaFinal)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Cuentas = new Proveedor();
        $Res     = $Cuentas->TotalServiciosReservaCotizacion($Cod_proveedor, $id_servicio, $FechaIncial, $FechaFinal);
        return json_encode($Res);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function CuentasProveedorTotal($Cod_proveedor, $FechaIncial, $FechaFinal)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Cuentas = new Proveedor();
        $Res     = $Cuentas->EstadoCuentaTotal($Cod_proveedor, $FechaIncial, $FechaFinal);
        return json_encode($Res);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function CuentaEstadoPaquete($Cod_proveedor, $FechaIncial, $FechaFinal, $Paquete)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Cuentas = new Proveedor();
        return json_encode($Cuentas->EstadoCuentaPaquete($Cod_proveedor, $FechaIncial, $FechaFinal, $Paquete));
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function GuardarServicios($Cod_proveedor, $nombre_servicio, $valor)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Guardar = new Servicios();
        $id      = $Guardar->NuevoServicio($Cod_proveedor, $nombre_servicio, $valor);
        return $id;
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function VerServiciosProveedor($Cod_proveedor)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Ver = new Servicios();
        $Res = $Ver->VerServiciosProveedorSoap('', $Cod_proveedor);
        return json_encode($Res);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function VerReservasProveedor($Cod_proveedor)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Ver = new Reserva();
        $Res = $Ver->VerReservasProveedor($Cod_proveedor);
        return json_encode($Res);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function VerReservasProveedorPagas($Cod_proveedor)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Ver = new Reserva();
        $Res = $Ver->VerReservasProveedorPagas($Cod_proveedor);
        return json_encode($Res);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function VerReservasProveedorFechas($Cod_proveedor)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Ver = new Reserva();
        $Res = $Ver->VerReservasProveedorFechas($Cod_proveedor);
        return json_encode($Res);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}

function CambiarDisponibilidadServicio($Cod_proveedor, $id_servicio)
{
    if (SiEstaActivoProveedor($Cod_proveedor))
    {
        $Ver = new Servicios();
        return $Ver->CambiarDisponibilidadServicio($Cod_proveedor, $id_servicio);
    }
    else
    {
        return json_encode(array ('Error' => 'Usuario deshabilitado'));
    }
}
/*

  $server = new soap_server();
  $server->register('GuardarServicios');
  $server->register('SiValida');
  $server->register('CambiarDisponibilidadServicio');
  $server->register('VerReservasProveedor');
  $server->register('VerReservasProveedorPagas');
  $server->register('VerReservasProveedorFechas');
  $server->register('VerPaquetes');
  $server->register('VerServiciosProveedor');
  $server->register('VerPaquetesServicios');
  $server->register('CuentaEstadoPaquete');
  $server->register('CuentasProveedorTotal');
  $server->register('TotalReservaCotizacion');
  $server->register('TotalValorServicios');
  @$server->service($HTTP_RAW_POST_DATA);
  ?>
 * 
 */

 


$soap                              = new soap_server;
$soap->configureWSDL('Servicios de turismo', 'http://localhost/turismo/soap/index.php');
$soap->wsdl->schemaTargetNamespace = 'http://soapinterop.org/xsd/';
$soap->register('GuardarServicios',                 array ('Cod_proveedor' => 'xsd:string','nombre_servicio' => 'xsd:string', 'valor' => 'xsd:string'),                                 array ('res_json' => 'xsd:string'), 'GuardarServicios');
$soap->register('SiValida',                         array ('cod_proveedor' => 'xsd:string'),                                                                                            array ('res_json' => 'xsd:string'), 'SiValida');
$soap->register('CambiarDisponibilidadServicio',    array ('Cod_proveedor' => 'xsd:string', 'id_servicio' => 'xsd:string'),                                                             array ('res_json' => 'xsd:string'), 'CambiarDisponibilidadServicio');
$soap->register('VerReservasProveedor',             array ('Cod_proveedor' => 'xsd:string'),                                                                                            array ('res_json' => 'xsd:string'), 'VerReservasProveedor');
$soap->register('VerReservasProveedorPagas',        array ('Cod_proveedor' => 'xsd:string'),                                                                                            array ('res_json' => 'xsd:string'), 'VerReservasProveedorPagas');
$soap->register('VerReservasProveedorFechas',       array ('Cod_proveedor' => 'xsd:string'),                                                                                            array ('res_json' => 'xsd:string'), 'VerReservasProveedorFechas');
$soap->register('VerPaquetes',                      array (),                                                                                                                           array ('res_json' => 'xsd:string'), 'VerPaquetes');
$soap->register('VerServiciosProveedor',            array ('Cod_proveedor' => 'xsd:string'),                                                                                            array ('res_json' => 'xsd:string'), 'VerServiciosProveedor');
$soap->register('VerPaquetesServicios',             array (),                                                                                                                           array ('res_json' => 'xsd:string'), 'VerPaquetesServicios');
$soap->register('CuentaEstadoPaquete',              array ('Cod_proveedor' => 'xsd:string', 'FechaIncial' => 'xsd:string', 'FechaFinal' => 'xsd:string'),                               array ('res_json' => 'xsd:string'), 'CuentaEstadoPaquete');
$soap->register('CuentasProveedorTotal',            array ('Cod_proveedor' => 'xsd:string', 'FechaIncial' => 'xsd:string', 'FechaFinal' => 'xsd:string'),                               array ('res_json' => 'xsd:string'), 'CuentasProveedorTotal');
$soap->register('TotalReservaCotizacion',           array ('Cod_proveedor'=> 'xsd:string', 'FechaIncial'=> 'xsd:string', 'FechaFinal'=> 'xsd:string'),                                  array ('res_json' => 'xsd:string'), 'TotalReservaCotizacion');
$soap->register('TotalValorServicios',              array ('Cod_proveedor'=> 'xsd:string', 'id_servicio'=> 'xsd:string', 'FechaIncial'=> 'xsd:string', 'FechaFinal'=> 'xsd:string'),    array ('res_json' => 'xsd:string'), 'TotalValorServicios');
$soap->service(isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '');