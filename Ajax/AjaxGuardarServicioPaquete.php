<?php

if (isset($_POST['Servicio']))
{
    include_once '../Controller/Servicios.php';
    $Servicios  = new Servicios();
    $Paquetes   = $_POST['Paquetes'];
    $Servicio   = $_POST['Servicio'];
    $Cantidad   = $_POST['Cantidad'];
    $Precio     = $_POST['Precio'];
    $Porcentaje = $_POST['Porcentaje'];
    if ($Paquetes == 0)
    {
        echo '<p class="bg-danger"><h1 align="center">Por favor seleccione todas las opciones<h1></p>';
        exit();
    }
    if ($Servicios == '0')
    {
        echo '<p class="bg-danger"><h1 align="center">Por favor seleccione todas las opciones<h1></p>';
        exit();
    }
    if ($Cantidad == 0)
    {
        echo '<p class="bg-danger"><h1 align="center">Por favor seleccione todas las opciones<h1></p>';
        exit();
    }
    $Servicios->ArmarPaquetes($Paquetes, $Servicio, $Cantidad, $Precio, $Porcentaje);
    echo '<h1 align="center"><p class="alert alert-danger"  role="alert">Por favor seleccione todas las opciones</p></h1>';
}
else
{
    echo '<h1 align="center"><p class="alert alert-danger"  role="alert">Por favor seleccione todas las opciones</p></h1>';
}