<!DOCTYPE html>

<html>

    <head>

        <title></title>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link  rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

        <link  rel="stylesheet" type="text/css" href="./css/jquery-ui.css">

        <script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript" src="./js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="./js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="./js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./js/functions.js"></script>
        <script type="text/javascript" src="./js/FormRegistrocliente.js"></script>
        <!--Codigojs-->



    </head>

    <body>



        <div class="container-fluid">
            <div id="Log"></div>
            <div class="panel panel-primary">

                <!-- Default panel contents -->

                <div class="panel-heading">Datos personales</div>

                <div class="panel-body">
                    <div id="Log"></div>
                    <form action="./Ajax/AjaxGuardarRegistrocliente.php" id="FormRegistrocliente" method="POST">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Paquete</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" readonly="true" value="abc" />
                                <input type="hidden" id="Paquete" name="Paquete" value="<?php echo $_GET['paquete'] ?>" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Precio</label>
                                <input type="text" id="Precio" name="Precio" class="form-control" readonly="true" value="" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Numero</label>
                                <input type="text" id="Numero_Id" name="Numero_Id" class="form-control" required />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tipo de identificación</label>
                                <select name="TipoID" id="TipoID" class="form-control" />
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="Tarjeta de indentidad">Tarjeta de identidad</option>
                                <option value="Cedula de ciudadania">Cédula de ciudadanía</option>
                                <option value="Cedula de extranjeria">Cédula de extranjería</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-3">
                                <input type=button class="btn btn-success" id="ValidarUsuario" value="Validar">
                            </div>
                            <div id="Datos">
                                <div class="form-group col-md-6">
                                    <label>Nombres</label>
                                    <input type="text" id="Nombres" name="Nombres" class="form-control" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Apellidos</label>
                                    <input type="text" id="Apellidos" name="Apellidos" class="form-control" required />
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" id="Email" name="Email" class="form-control" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Telefono</label>
                                    <input type="text" id="Telefono" name="Telefono" class="form-control" required />
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <input type="submit" value="Comprar" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </body>

</html>

