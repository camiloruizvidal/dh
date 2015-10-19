<?php

include_once '../Model/ModelAdmin.php';
include_once '../Model/ModelServicios.php';

class Administrador
{

    public function InformesEstadoPaquetes($FechaInicio, $FechaFin)
    {
        $Ventas = new ModelAdmin();
        $Res    = $Ventas->RegistrosVentasPaquetes($FechaInicio, $FechaFin);
        return $Res;
    }

    public function InformesEstadoServicios($FechaInicio, $FechaFin)
    {
        $Ventas = new ModelAdmin();
        $Res    = $Ventas->RegistrosVentasServicios($FechaInicio, $FechaFin);
        return $Res;
    }

    public function Modificar_Paquete($id_paquete)
    {
        $admin = new ModelAdmin();
        $Res   = $admin->RegistrosVentasServicios($FechaInicio, $FechaFin);
        return $admin;
    }

    public function Retirar_Producto($id_producto)
    {
        $admin = new ModelServicios();
        $Res = $admin->EditarDisponibilidadServicios($id_producto, 'N');
        return $Res;
    }

    public function Retirar_Proveedor($id_Proveedor)
    {
        $admin = new ModelAdmin();
        $Res   = $admin->Retirar_Producto($id_Proveedor);
        return $Res;
    }

}
