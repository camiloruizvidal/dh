<?php

include_once '../../../Controller/Nusoap/nusoap.php';

class WebService
{

    private $Con;
    public $GetError;

    public function __construct()
    {
        $URL       = 'http://localhost/turismo/Soap/index.php?WSDL';
        $this->Con = new nusoap_client($URL); //conexion
        $err       = $this->Con->getError(); //valida
        if ($err)
        {
            $this->Con = FALSE;
        }
    }

    private function Call($Funtion, $Param)
    {
        $this->GetError = TRUE;
        $result         = $this->Con->call($Funtion, $Param);
        if ($this->Con->fault)
        {
            $this->GetError = $result;
        }
        else
        {
            $err = $this->Con->getError();
            if ($err)
            {
                $this->GetError = $err;
            }
            else
            {
                return $result;
            }
        }
        return $this->GetError;
    }

    private function Values($Values)
    {
        $Datos  = array();
        $Values = json_decode($Values);
        foreach ($Values as $value)
        {
            $Temp    = array($value[0], $value[1]);
            $Datos[] = $Temp;
        }
        return $Datos;
    }

    public function VerMunicipios()
    {
        $Param    = array();
        $Function = 'Municipios';
        $Res      = $this->Call($Function, $Param);
        $Res      = $this->Values($Res);
        return $Res;
    }

    public function VerIndicadores()
    {
        $Param    = array();
        $Function = 'Indicadores';
        $Res      = $this->Call($Function, $Param);
        $Res      = $this->Values($Res);
        return $Res;
    }

    public function DatosHtml($id_indicador, $Municipio)
    {
        $Param    = array('id_indicador' => $id_indicador, 'Municipio' => $Municipio);
        $Function = 'DatosTangaraHTML';
        $Res      = $this->Call($Function, $Param);
        return json_decode($Res);
    }

    public function DatosTangara($id_indicador, $Municipio)
    {
        $Param    = array('id_indicador' => $id_indicador, 'Municipio' => $Municipio);
        $Function = 'DatosTangara';
        $Res      = $this->Call($Function, $Param);
        return $Res;
    }

}
