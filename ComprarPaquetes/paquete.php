<!DOCTYPE html>
<html>
    <head>
        <title>SIIT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--  css-->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/jquery-ui.css"/>
        <link rel="stylesheet" href="css/inicio.css"/>
        <!-- !css-->

        <!--  js-->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/comprarpaquetes.js"></script>
        <!-- !js-->

    </head>
    <body>
        <div class="container-fluid" id="contenido">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-3">
                        <img class="img-thumbnail" src="images/Logo.png" />
                    </div>
                    <div class="col-lg-9">
                        <h1 class="titulo">Sistema Integrado de Información Turística</h1>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-default">
                <div class="navbar-default" >
                    <ul class="nav navbar-default" id="menu_header">
                        <li><a href="#">SIIT</a></li>
                        <li><a href="paquetes.html">PAQUETES</a></li>
                        <li class="active"><a href="com_paquete.html">SERVICIOS</a></li>
                        <li><a href="Cotice.html">COTICE</a></li>
                        <li><a href="login.html">FUNCIONARIOS</a></li>
                    </ul>
                </div>
            </nav>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="Formulario" action="paquete.php"> 
                        <div class="col-md-3">
                            <label>Seleccione el proveedor</label>
                            <select id="proveedor" name="proveedor" class="form-control">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Seleccione el servicio</label>
                            <select id="servicio" name="servicio" class="form-control">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Seleccione cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control">

                        </div>
                        <div class="col-md-3">
                            <label>Fecha de reserva</label>
                            <input type="text" id="fecha" name="fecha" class="form-control fecha">

                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success" id="Buscar">Reservar</button>
                        </div>
                        <div id="Datos">
                            <div class="col-md-12">
                                <label>
                                    Nombres
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="Nombres" name="Nombres" class="form-control ui-autocomplete-input" autocomplete="off">
                            </div>
                            <div id="datos_cliente">
                                <div class="col-md-12">
                                    <label>
                                        Tipo de documento
                                    </label>
                                    <select type="text" id="Tipoid" name="Tipoid" class="form-control">
                                        <option value="Tarjeta de indentidad">Tarjeta de indentidad</option>
                                        <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                        <option value="Cedula de extranjeria">Cedula de extranjeria</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        Numero de documento
                                    </label>
                                    <input type="text" id="Documento" name="Documento" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label>
                                        Email
                                    </label>
                                    <input type="text" id="Email" name="Email" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        Telefono
                                    </label>
                                    <input type="text" id="Telefono" name="Telefono" class="form-control">
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button onclick="enviar()" class="btn btn-success">Enviar reserva</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="footer">
                <div class="container-fluid">
                    <div class="container-footer">
                        <div class="row">
                            <div class="col-lg-4"><img class="logo_footer" src="images/logo-autonoma.png"></div>
                            <div class="col-lg-4"><img class="logo_footer" src="images/Logo.png"></div>
                            <div class="col-lg-4"><img class="logo_footer" src="images/logo_gobernacion.png"></div>
                        </div>

























                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" style="color: black">Numero de recibo</h4>
                                    </div>
                                    <div class="modal-body" >
                                        <p style="color: black">Su compra se registro con éxito. Su numero de validacion es el <span id="Numeroval" style="color: green;font-size: -webkit-xxx-large;"></span> por un valor de <span id="Preciostotal" style="color: red;font-size: -webkit-xxx-large;"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
