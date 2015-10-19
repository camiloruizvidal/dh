<?php

include_once '../Controller/Servicios.php';
$Paquetes = new Servicios();
$Datos    = $Paquetes->VerPaquetesActivos();
$Res      = array();
for ($i = 0; $i < 3 && isset($Datos[$i]); $i++)
{
    $Res[] = $Datos[$i];
}
foreach ($Res as $Temp)
{
    $url='#';
    echo    '<div class="col-md-4">
                <a href="'.$url.'">
                    <div class="thumbnail">
                        <div class="caption">
                            <h2>' . $Temp['Nombre'] . '</h2>
                        </div>
                        <img src="' . $Temp['urlFoto'] . '" alt="...">
                        <div>
                            <h4 class="price">
                            $' . number_format($Temp['Valor'], 0,'.',',') . 
                            '</h4>
                        </div>        
                    </div>
                </a>
            </div>';
}