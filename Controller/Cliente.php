<?php

include_once '../Model/ModelCliente.php';

class Cliente
{

    public function RegistrarClientes($Nombres, $Apellidos, $TipoID, $Numero_Id, $Email, $Telefono)
    {
        $Registro = new ModelCliente();
        $id       = $Registro->RegistrarClientes($Nombres, $Apellidos, $TipoID, $Numero_Id, $Email, $Telefono);
        return $id;
    }

    public function validarusuario($Documento,$Nombres,$Tipoid,$Email,$Telefono)
    {
        $Cliente = new ModelCliente();
        $Datos   = $Cliente->buscarusuariodocumento($Documento,$Nombres,$Tipoid,$Email,$Telefono);
        return $Datos;
    }
    
    public function validarusuario2($Documento)
    {
        $Cliente = new ModelCliente();
        $Datos   = $Cliente->buscarusuariodocumento2($Documento);
        return $Datos;
    }
    
    public function BuscarUsuarioNombreDocumento($NombreoDocumento)
    {
        $Cliente = new ModelCliente();
        $Datos   = $Cliente->BuscarUsuarioNombreDocumento($NombreoDocumento);
        return $Datos;
    }

}
