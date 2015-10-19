<?php
include_once '../Controller/Cotizar.php';
$Update = new Cotizar();
$Update->ActualizarCotizaciones($_POST);
echo '<h1>Se ha guardado la cotizacion</h1>';