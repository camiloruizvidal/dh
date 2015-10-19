<?php
include_once 'Controller/Servicios.php';
$Ser        = new Servicios();
$id         = $_GET['id'];
$nombre     = $id . '-' . basename($_FILES['image']['name']);
$uploaddir  = 'images/other/';
$uploadfile = $uploaddir . $nombre;



if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile))
{
    echo $Ser->CambiarImagen($id, $uploadfile);


    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    echo '<script>history.back()</script>';
}
else
{
    echo 'error';
}