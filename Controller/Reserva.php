<?php

include_once '../Model/ModelReserva.php';
include_once '../Controller/Servicios.php';
include_once '../Controller/Cliente.php';

class Reserva
{

    public function ReservarServicios($servicio, $cantidad, $Documento, $fecha,$proveedor,$Nombres,$Tipoid,$Email,$Telefono)
    {
        $Cliente    = new Cliente();
        $Servicios  = new Servicios();
        $Servi      = $Servicios->VerServicio($servicio);
        $Clien      = $Cliente->validarusuario($Documento,$Nombres,$Tipoid,$Email,$Telefono);
        $Reservar   = new ModelReserva();
        $id_cliente = $Clien['id_cliente'];
        $Precio     = $Servi['Valor'] * $cantidad;
        $Precio=  '$'.number_format($Precio,'0',',','.');
        return array('codigo'=>$this->GuardarReservaServicio($Precio, $fecha, $fecha, $cantidad, $servicio, $id_cliente,$Servi['Valor']),'valor'=>$Precio);
    }
    private function QuitarFormato($Precio)
    {
        $Precio=  str_replace('$', '', $Precio);
        $Precio=  str_replace('.', '', $Precio);
        $Precio=  str_replace(',', '.', $Precio);
        return $Precio;
    }
    private function GuardarReservaServicio($Precio, $fechaincio, $fechafin, $cantidad, $servicio, $id_cliente, $valorUnitarioServicio)
    {
        $Reservar = new ModelReserva();
        $Precio=  $this->QuitarFormato($Precio);
        $id       = $Reservar->GenerarReservaServicio($Precio, $fechaincio, $fechafin);
        $id2      = $Reservar->GenerarServicioReserva($id, $servicio, $cantidad, $valorUnitarioServicio, 0);
        $Reservar->Reserva($id, $id_cliente, $Precio, $fechaincio, $fechafin, 'Confirmado', 'N');
        return $id;
    }

    public function VerReservasHechas()
    {
        $Reservar = new ModelReserva();
        return $Reservar->VerReservasHechas();
    }

    public function PagarReserva($id_reserva)
    {
        $Reservar = new ModelReserva();
        $id       = $Reservar->Pagar($id_reserva);
    }

    private function GuardarReservarPaqueteServicios($id_paquete)
    {
        $Reservar  = new ModelReserva();
        $Servicios = new Servicios();
        $id        = $Reservar->GuardarReservarPaqueteServicios($id_paquete);
        return $id;
    }

    public function ReservarPaquete($id_paquete, $id_cliente, $Fecha_reserva, $Pago)
    {

        $Reservar   = new ModelReserva();
        $Servicios  = new Servicios();
        $Datos      = $Servicios->VerDescripcionPaquete($id_paquete);
        $id_paquete = $this->GuardarReservarPaqueteServicios($id_paquete);
        $id         = $Reservar->ReservarPaquete($id_paquete, $id_cliente, $Datos['Valor'], date("Y-m-d"), $Fecha_reserva, 'Confirmado', $Pago);
        return $id;
    }

    public function Reservar($id_paquete, $id_cliente, $valor, $Fecha_pedido, $Fecha_reserva, $Estado, $Pago, $cab_cotizacion = NULL)
    {
        $Reservar = new ModelReserva();
        $id       = $Reservar->Reserva($id_paquete, $id_cliente, $valor, $Fecha_pedido, $Fecha_reserva, $Estado, $Pago, $cab_cotizacion);
        return $id;
    }

    public function VerCotizacion($id_cotizacion)
    {
        $Ser   = new Servicios();
        $Cot   = new ModelReserva();
        $Datos = $Cot->VerCotizacion($id_cotizacion);
        $Res   = array ();
        foreach ($Datos as $Temp)
        {
            $Res              = $Temp;
            $Res['Servicios'] = $Ser->ServiciosXPaquete($Temp['Paquete']);
        }
        return $Res;
    }

    public function Factura($Id_reserva)
    {
        $Ser     = new Servicios();
        $Reserva = new ModelReserva();
        $Res     = array ();
        $Datos   = $Reserva->ReservaPaga($Id_reserva);
        foreach ($Datos as $Temp)
        {
            $Res              = $Temp;
            $Res['Servicios'] = $Ser->ServiciosXPaquete($Temp['Paquete']);
        }
        return $Res;
    }

    private function ReservasPaquetes($id_reserva)
    {
        $Reserva = new ModelReserva();
        $Res     = $Reserva->ReservasPaquetes($id_reserva);
        return $Res;
    }

    private function ReservasCotizacion($id_reserva)
    {
        $Reserva = new ModelReserva();
        $Res     = $Reserva->ReservasCotizacion($id_reserva);
        return $Res;
    }

    private function ReservaHecha($id_reserva)
    {
        $Reserva = new ModelReserva();
        $Res     = $Reserva->VerReservasHecha($id_reserva);
        return $Res;
    }

    public function VerReservaHecha($id_reserva)
    {
        $Cab     = $this->ReservaHecha($id_reserva);
        $Detalle = array ();
        if ($Cab['Tipo'] == 'Paquete')
        {
            $Detalle = $this->ReservasPaquetes($id_reserva);
        }
        else
        {
            $Detalle = $this->ReservasCotizacion($id_reserva);
        }
        $Res = (array ('Cab' => $Cab, 'Detalle' => $Detalle));
        return ($Res);
    }

    public function VerReservasPagasProveedores($FechaInicio = '', $FechaFin = '', $Proveedor = '')
    {
        if ($Proveedor == '0')
        {
            $Proveedor = '';
        }
        $Reservas = new ModelServicios();
        $Datos    = $Reservas->VerReservasPagasProveedores($FechaInicio, $FechaFin, $Proveedor);
        $Res      = array ();
        if (!is_null($Datos))
        {
            foreach ($Datos as $Temp)
            {
                if (is_float($Temp[4]))
                {
                    $Temp[4] = number_format($Temp[4], '2', '.', ',');
                }
                else
                {
                    $Temp[4] = number_format($Temp[4], '0');
                }
                $Temp[4] = '$ ' . $Temp[4];
                $Res[]   = $Temp;
            }
        }
        return $Res;
    }

    private function VerDetalleReservaCotizacion($id_reserva)
    {
        $Reservas = new ModelServicios();
        $Datos    = $Reservas->VerDetalleReservaCotizacion($id_reserva);
        return $Datos;
    }

    private function VerDetalleReservaPaquete($id_reserva)
    {
        $Reservas = new ModelServicios();
        $Datos    = $Reservas->VerDetalleReservaPaquete($id_reserva);
        return $Datos;
    }

    private function tipo($id_reserva)
    {
        $Reservas = new ModelServicios();
        $Datos    = $Reservas->tipo($id_reserva);
        return $Datos;
    }

    public function VerdetalleReserva($id_reserva)
    {
        $tipo  = $this->tipo($id_reserva);
        $Datos = '';
        if ($tipo == 'C')
        {
            $Datos = $this->VerDetalleReservaCotizacion($id_reserva);
        }
        else
        {
            $Datos = $this->VerDetalleReservaPaquete($id_reserva);
        }
        return $Datos;
    }

    public function DatosReserva($id_reserva)
    {
        $Reservas = new ModelServicios();
        $Datos    = $Reservas->DatosReserva($id_reserva);
        return $Datos;
    }

    public function VerReservasProveedor($cod_proveedor)
    {
        $Reservas = new ModelReserva();
        $Datos    = $Reservas->VerReservasProveedor($cod_proveedor);
        return $Datos;
    }

    public function VerReservasProveedorPagas($cod_proveedor)
    {
        $Reservas = new ModelReserva();
        $Datos    = $Reservas->VerReservasProveedorPagas($cod_proveedor);
        return $Datos;
    }

    public function VerReservasProveedorFechas($cod_proveedor)
    {
        $Reservas = new ModelReserva();
        $Datos    = $Reservas->VerReservasProveedorFechas($cod_proveedor);
        return $Datos;
    }

}
