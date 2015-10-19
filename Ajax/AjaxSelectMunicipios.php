<?php
include_once '../Controller/Servicios.php';
include_once '../Controller/Visual.php';
$render = new Visual();
$Mun = new Servicios();
$Datos =$render->FormatoSelect($Mun->VerMunicipios());
echo $render->Select($Datos,'id_municipios','','id_municipios','','','','form-control');