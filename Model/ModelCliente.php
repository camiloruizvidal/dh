<?php

include_once 'BaseDatos/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class ModelCliente
{

    public function BuscarUsuarioNombreDocumento($NombreoDocumento)
    {
        $con = App::$base;
        $sql = "SELECT 
                `cliente`.`id_cliente` AS `id`,
                UPPER(CONCAT(`cliente`.`Nombres`, ' ', `cliente`.`Apellidos`)) AS `value`,
                `cliente`.`Nombres`,
                `cliente`.`Apellidos`,
                `cliente`.`TipoID`,
                `cliente`.`Numero_Id`,
                `cliente`.`Email`,
                `cliente`.`Telefono`
              FROM
                `cliente`
              WHERE
                `cliente`.`Numero_Id` LIKE '%$NombreoDocumento%' or 
                `cliente`.`Nombres` LIKE '%$NombreoDocumento%' or 
                `cliente`.`Apellidos` LIKE '%$NombreoDocumento%'"
                . "order by `cliente`.`Nombres`";
        $res = $con->Records($sql, array ());
        return $res;
    }

    public function RegistrarClientes($Nombres, $Apellidos, $TipoID, $Numero_Id, $Email, $Telefono)
    {
        $C            = atable::Make('cliente');
        $C->Load("Numero_Id = $Numero_Id");
        $C->nombres   = $Nombres;
        $C->apellidos = $Apellidos;
        $C->tipoid    = $TipoID;
        $C->numero_id = $Numero_Id;
        $C->email     = $Email;
        $C->telefono  = $Telefono;
        $C->Save();
        return $C->id_cliente;
    }

    public function buscarusuariodocumento2($Documento)
    {
        $Datos = NULL;
        $C     = atable::Make('cliente');
        $C->Load("numero_id = $Documento");
        if (!is_null($C->id_cliente))
        {
            $Datos['id_cliente'] = $C->id_cliente;
            $Datos['nombres']    = $C->nombres;
            $Datos['apellidos']  = $C->apellidos;
            $Datos['tipoid']     = $C->tipoid;
            $Datos['numero_id']  = $C->numero_id;
            $Datos['email']      = $C->email;
        }
        return $Datos;
    }

    public function buscarusuariodocumento($Documento, $Nombres, $Tipoid, $Email, $Telefono)
    {
        $Datos = NULL;
        $C     = atable::Make('cliente');
        $C->Load("numero_id = $Documento");
        if (!is_null($C->id_cliente))
        {
            $Datos['id_cliente'] = $C->id_cliente;
            $Datos['nombres']    = $C->nombres;
            $Datos['apellidos']  = $C->apellidos;
            $Datos['tipoid']     = $C->tipoid;
            $Datos['numero_id']  = $C->numero_id;
            $Datos['email']      = $C->email;
        }
        else
        {
            $C->nombres   = $Nombres;
            $C->apellidos = '';
            $C->tipoid    = $Tipoid;
            $C->numero_id = $Documento;
            $C->email     = $Email;
            $C->telefono  = $Telefono;
            $C->Save();
            $Datos        = $this->buscarusuariodocumento($Documento, $Nombres, $Tipoid, $Email, $Telefono);
        }
        return $Datos;
    }

}
