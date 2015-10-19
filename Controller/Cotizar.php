<?php

include_once '../Model/ModelCotizar.php';
include_once '../Controller/Correo.php';

class Cotizar
{   
    public function VerCabCotizaciones($id_cotizacion)
    {
        $Cotizaion = new ModelCotizar();
        $Res = $Cotizaion->VerCabCotizaciones($id_cotizacion);
        return $Res;
    }
    public function GenerarReservaCotizacion($id_cotizacion)
    {
        
    }
    public function EliminarCotizacion($id_cotizacion)
    {
        $Cotizaion = new ModelCotizar();
        $Cotizaion->DeleteCotizacion($id_cotizacion);
    }
    public function VerCabCotizacionClienteAprobadas($id_cliente)
    {
        $Cotizacion = new ModelCotizar();
        $Res        = $Cotizacion->VerCabCotizacionClienteAprobadas($id_cliente);
        return $Res;
    }
    public function VerTotal($id_cotizacion)
    {
        $Cotizacion = new ModelCotizar();
        $Res        = $Cotizacion->VerTotalCotizacion($id_cotizacion);
        return $Res;
    }

    public function ActualizarCotizaciones($Datos)
    {
        $Correo     = new Correo();
        $Cotizacion = new ModelCotizar();
        $Total      = 0;
        foreach ($Datos['ids'] as $Temp)
        {
            $cant = ($Datos['cantidad'][$Temp]);
            $Res  = $Cotizacion->ActualizarDetalleCotizacion($Temp, $cant, $Datos['Valor'][$Temp]);
        }
        $Total   = $this->VerTotal($Res);
        $Cotizacion->actualizarEstadoCotizacion($Res, $Total);
        $Cliente = $Cotizacion->UsuarioCotizacion($Res);
        $Tabla=$Cotizacion->VerCotizacion($Res);
        $Correo->EnviarCorreo($Cliente['Email'], $Cliente['Nombres'], $Cliente['Apellidos'], $Cliente['Fecha_cotizacion'], $Total,$Tabla);
    }

    public function VerCabCotizacion()
    {
        $Cotizacion = new ModelCotizar();
        $Res        = $Cotizacion->VerCabCotizacion();
        return $Res;
    }

    public function Total($idcotizacion)
    {
        $Cotizacion = new ModelCotizar();
        $Total      = $Cotizacion->TotalCotizacion($idcotizacion);
        return $Total['Total'];
    }

    public function actualizarPrecio($idcotizacion)
    {
        $Cotizacion = new ModelCotizar();
        $Total      = $this->Total($idcotizacion);
        $Cotizacion->ActualizarPrecio($idcotizacion, $Total);
    }

    public function CabCotizacion($FechaInicio, $descripcion_cotizacion, $codusuario, $FechaActual = '')
    {
        $Cab = new ModelCotizar();
        $id  = $Cab->CabCotizacion($FechaInicio, $descripcion_cotizacion, $codusuario, $FechaActual);
        return $id;
    }

    public function DetalleCotizacion($id_servicio, $cantidad, $id_cotizacion,$Precio=NULL)
    {
        $Cab = new ModelCotizar();
        $id  = $Cab->DetalleCotizacion($id_servicio, $cantidad, $id_cotizacion,$Precio);
        $this->actualizarPrecio($id_cotizacion);
        return $id;
    }

    public function VerCotizacionEdit($id_cotizacion)
    {
        $Datos = new ModelCotizar();
        $Res   = $Datos->VerCotizacionEdit($id_cotizacion);
        return $Res;
    }

    public function VerCotizacion($id_cotizacion)
    {
        $Datos = new ModelCotizar();
        $Res   = $Datos->VerCotizacion($id_cotizacion);
        return $Res;
    }
    public function VerCotizacionAprobadas($id_cotizacion)
    {
        $Datos = new ModelCotizar();
        $Res   = $Datos->VerCotizacionAprobadas($id_cotizacion);
        return $Res;
    }

}
