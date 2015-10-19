<?php

date_default_timezone_set('America/Bogota');
include_once "../Model/ModellGenerarReserva.php";
include_once "../Model/ModelReserva.php";

class GenerarReserva
{

    private function GuardarPaquete($fk_paquete)
    {
        $Ver       = new ModelReserva();
        $Paquetes  = $Ver->VerPaquete($fk_paquete);
        $Servicios = $Ver->VerServiciosPaquete($fk_paquete);
        $id        = $Ver->Guardar_paquete_reservado($Paquetes);
        foreach ($Servicios as $temp)
        {
            $Ver->Guardar_paquete_reservado_servicios($id,$temp);
        }
        return $id;
    }

    public function GenerarReserva_Agregar_Registrocliente($arrayGenerarReserva_Agregar_Registrocliente)
    {
        extract($arrayGenerarReserva_Agregar_Registrocliente);
        $Precio       = str_replace(',', '', $Precio);
        $Precio       = str_replace('$', '', $Precio);
        $Agregar      = new ModellGenerarReserva();
        $Reservar     = new ModelReserva();
        $fecha_actual = date("Y-m-d");
        $fk_cliente   = $Agregar->GenerarReserva_Agregar_Registrocliente($arrayGenerarReserva_Agregar_Registrocliente);
        $Paquete      = $this->GuardarPaquete($Paquete);
        $id           = $Reservar->Reserva($Paquete, $fk_cliente, $Precio, $fecha_actual, $fecha_actual, 'Confirmado', 'S', NULL);
        return $id;
    }

    public function BuscarCliente($NumeroDocumento)
    {
        $Agregar = new ModellGenerarReserva();
        return $Agregar->BuscarCliente($NumeroDocumento);
    }

    function __construct()
    {
        
    }

}
