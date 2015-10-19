<?php
include_once '../Controller/Proveedor.php';
$Registro  = new Proveedor();
$Nombre    = $_POST['Nombre'];
$Telefono  = $_POST['Telefono'];
$Email     = $_POST['Email'];
$Nit       = $_POST['Nit'];
$Direccion = $_POST['Direccion'];
$Descripcion = $_POST['Descripcion'];
$id        = $Registro->RegistrarProveedor($Nombre, $Telefono, $Email, $Nit, $Direccion,$Descripcion);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SIIT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--  css-->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/jquery-ui.css"/>
        <link rel="stylesheet" href="css/admin.css"/>

        <!-- !css-->

        <!--  js-->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/MenuAdmin.js"></script>
        <!-- !js-->

    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div id="MenuAdmin">

                    </div>
                </nav>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Titulo
                </div>
                <div class="panel-body">
                    <p><h1>Registro exitoso</h1>
                    El proveedor <?php echo $Nombre; ?> ha sido registrado exitosamente.<br/>
                    <h3>Código de registro <strong><?php echo $id; ?></strong></h3></p>
                </div>
            </div>
        </div>
    </body>
</html>
