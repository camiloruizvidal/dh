<?php

include_once '../Controller/Servicios.php';
include_once '../Controller/Visual.php';
$Render    = new Visual();
$Paquete   = new Servicios();
$municipio = 0;
if (isset($_POST['municipio']))
{
    $municipio = $_POST['municipio'];
}

$FechaInicion              = $_POST['FechaInicion'];
$FechaFin                  = $_POST['FechaFin'];
$n_pagina                  = $_POST['n_pagina'];
$cantidad_registros_pagina = $_POST['cantidad_registros_pagina'];
$Datos                     = $Paquete->BuscarPaquetes($municipio, $FechaInicion, $FechaFin, $n_pagina, $cantidad_registros_pagina);
$cantidad                  = $Datos['Cantidad'] / $cantidad_registros_pagina;
$col                       = 2;
$count                     = count($Datos['Datos']);
$Res                       = $Datos['Datos'];
if ($count > 0)
{
    echo '<div class="row">';
    for ($i = 0; $i < ($count); $i++)
    {
        $value      = $Res[$i];
        $id_paquete = $value['id_paquete'];
        $Nombre     = $value['Nombre'];
        $Valor      = $value['Valor'];
        $Fecha      = $value['Fecha_inicio'];
        $Image      = $value['foto'];
        $Decripcion = $value['Descripcion'];
        $Datos      = array ('Nombre' => $Nombre, 'Valor' => $Valor, 'Fecha' => $Fecha, 'Image' => $Image, 'Descripcion' => $Decripcion);
        $html       = '<div class="col-md-' . $col . '">' . "\n" .
                '   <a href="javascript:VerModal(' . $id_paquete . ');">' . "\n" .
                '       <div class="panel panel-primary" title="' . $Decripcion . '">' . "\n" .
                '           <div class="panel-heading">' . "\n" .
                '               <h3 class="panel-title">' . strtoupper($Nombre) . '</h3>'
                . '         </div>' . "\n" .
                '           <div class="panel-body">' . "\n" .
                $Image . "\n" .
                '               PRECIO: $' . number_format($Valor, 2, ',', '.') . "\n" .
                '           </div>' . "\n" .
                '       </div>'
                . '</a>' . "\n" .
                '</div>';
        echo $html;
    }
    echo '</div>'
    . '<hr/>';
}
echo '<div class="row">';
echo $Render->Paginar('', $n_pagina, $cantidad, 'VerListado');
echo '</div>';
