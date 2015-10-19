<?php

include_once "../Model/BaseDatos/conexion.php";
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class ModellGenerarReserva
{

    public function GenerarReserva_Agregar_Registrocliente($arrayGenerarReserva_Agregar_Registrocliente)
    {
        extract($arrayGenerarReserva_Agregar_Registrocliente);
        $Guardar = atable::Make('cliente');
        $Guardar->Load("Numero_Id=$Numero_Id");
        if (is_null($Guardar->id_cliente))
        {
            $Guardar->nombres   = $Nombres;
            $Guardar->apellidos = $Apellidos;
            $Guardar->tipoid    = $TipoID;
            $Guardar->numero_id = $Numero_Id;
            $Guardar->email     = $Email;
            $Guardar->telefono  = $Telefono;
            $Guardar->Save();
        }
        return $Guardar->id_cliente;
    }

    public function BuscarCliente($NumeroDocumento)
    {
        $Datos  = array ();
        $Buscar = atable::Make('cliente');
        $Buscar->Load("Numero_Id=$NumeroDocumento");

        if (!is_null($Buscar->id_cliente))
        {
            $Datos['Nombres']   = $Buscar->nombres;
            $Datos['Apellidos'] = $Buscar->apellidos;
            $Datos['TipoID']    = $Buscar->tipoid;
            $Datos['Numero_Id'] = $Buscar->numero_id;
            $Datos['Email']     = $Buscar->email;
            $Datos['Telefono']  = $Buscar->telefono;
            return $Datos;
        }
        else
        {
            return false;
        }
    }

    function __construct()
    {
        
    }

}
