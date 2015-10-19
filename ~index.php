<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema Turismo</title>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/jquery-ui.css"/>

    </head>
    <body>
        <div class="container-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Modulos
                </div>
                <div class="panel-body"><?php
                    echo "\n";
                    $i=0;
                    $directorio = opendir('.'); //ruta actual
                    while ($archivo    = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                    {
                        if (is_dir($archivo) && ($archivo != '.' && $archivo != '..' && $archivo != '.git' && $archivo != 'Ajax' && $archivo != 'Controller' && $archivo != 'css' && $archivo != 'fonts' && $archivo != 'images' && $archivo != 'js' && $archivo != 'Model' && $archivo != 'nbproject' && $archivo != 'Proveedor' && $archivo != 'Soap' && $archivo != 'WebServices'))
                        {
                            $i++;
                            echo '                      <div class="col-lg-12">' . "\n";
                            echo '                          <a class="btn btn-primary btn-lg" href="' . $archivo . '">'.$i.') Ir a: ' . $archivo . '</a>' . "\n";
                            echo '                      </div>' . "\n";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
