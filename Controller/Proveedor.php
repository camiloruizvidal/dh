<?php

include_once '../Model/ModelProveedor.php';

class Proveedor
{

    public function BloquearProveedor($id_proveedor)
    {
        $Res   = new ModelProveedor();
        $Datos = $Res->Retirar_Proveedor($id_proveedor);
        return $Datos;
    }

    public function ActivarProveedor($id_proveedor)
    {
        $Res   = new ModelProveedor();
        $Datos = $Res->ActivarProveedor($id_proveedor);
        return $Datos;
    }

    public function TotalServiciosReservaCotizacion($Cod_proveedor, $id_servicio, $FechaIncial, $FechaFinal)
    {
        $Ver   = new ModelServicios();
        $Datos = $Ver->ValorTotalVentaServicio($Cod_proveedor, $FechaIncial, $FechaFinal);
        return $Datos;
    }

    public function VerProveedores()
    {
        $Res   = new ModelProveedor();
        $Datos = $Res->VerProveedores();
        return $Datos;
    }

    public function VerProveedoresActivosInactivos()
    {
        $Res   = new ModelProveedor();
        $Datos = $Res->VerProveedoresActivosInactivos();
        return $Datos;
    }

    private function CodigoProveedor($id_proveedor)
    {
        $letra     = 'PSIIT';
        $digitos   = 7;
        $cant      = (int) $id_proveedor;
        $nletra    = strlen($letra);
        $ncant     = strlen($cant);
        $str_ceros = '';
        $ceros     = $digitos - $nletra + $ncant; // cantidad de ceros para adicionar
        for ($i = 1; $i <= $ceros; $i++)
        {
            $str_ceros .= "0";
        }
        $cant++;
        $codigo = $letra . $str_ceros . $cant;

        return $codigo;
    }

    public function RegistrarProveedor($Nombre, $Telefono, $Email, $Nit, $Direccion = '', $Descripcion = '')
    {
        $Registrar    = new ModelProveedor();
        $id_proveedor = $Registrar->RegistrarProveedor($Nombre, $Telefono, $Email, $Nit, $Direccion, $Descripcion);
        $Codigo       = $this->CodigoProveedor($id_proveedor);
        $Registrar->RegistrarCodigoProveedor($id_proveedor, $Codigo);
        return $Codigo;
    }

    public function ActualizarProveedor($id, $Nombre, $Telefono, $Email, $Nit, $Direccion, $Descripcion)
    {
        $Registrar    = new ModelProveedor();
        $id_proveedor = $Registrar->ActualizarProveedor($id, $Nombre, $Telefono, $Email, $Nit, $Direccion, $Descripcion);
        return $id_proveedor;
    }

    public function BuscarProveedor($id_proveedor)
    {
        $Ver   = new ModelProveedor();
        $Datos = $Ver->VerProveedor($id_proveedor);
        return $Datos;
    }

    public function InfoProveedor($Cod_proveedor)
    {

        $Ver   = new ModelProveedor();
        $Datos = $Ver->VerProveedorCod($Cod_proveedor);
        return $Datos;
    }

    private function Total($Datos)
    {
        $Total = 0;
        foreach ($Datos as $Temp)
        {
            $Total = $Total + ($Temp['valor_neto'] * $Temp['cantidad_servicios']);
        }
        return $Total;
    }

    public function TotalReservaCotizacion($Cod_proveedor, $FechaIncial, $FechaFinal)
    {
        $validar = new Cliente();
        $Ver     = new ModelServicios();
        $Datos   = $Ver->ValorTotalVentaPaqueteCotizacion($Cod_proveedor, $FechaIncial, $FechaFinal);
        return $Datos;
    }

    public function EstadoCuentaTotal($Cod_proveedor, $FechaIncial, $FechaFinal)
    {
        $Ver   = new ModelProveedor();
        $Total = $Ver->ValorTotalEstadoCuenta($Cod_proveedor, $FechaIncial, $FechaFinal); //Generar revision
        $Datos = $Ver->EstadoCuentaTotal($Cod_proveedor, $FechaIncial, $FechaFinal);
        $Res   = array ('Datos' => $Datos, 'Total' => $Total['valor']);
        return $Res;
    }

    public function EstadoCuentaPaquete($Cod_proveedor, $FechaIncial, $FechaFinal, $id_paquete)
    {
        $Ver   = new ModelProveedor();
        $Datos = $Ver->EstadoCuentaPaquete($Cod_proveedor, $FechaIncial, $FechaFinal, $id_paquete);
        return $Datos;
    }

    public function ValidarProveedor($CodProveedor)
    {
        $Ver = new ModelProveedor();
        $Res = $Ver->ValidarProveedor($CodProveedor);
        if (is_null($Res))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}