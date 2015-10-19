<?php
@include_once 'Visual.php';
class Correo
{   
    private function EnviarMensaje($Asunto,$Destino,$origen,$mensaje)
    {
        
    }
    public function EnviarCorreo($Email,$Nombre,$Apellido,$Fecha, $Precio,$TablaDatos)
    {
        $Render = new Visual();
        $Mensaje="<p><center><strong>Cordial saludo $Nombre $Apellido</center></strong></p>

            <p>Debido a la cotización que realizo el $Fecha hemos establecido una 
            tarifa que le puede agradar $($Precio). Cualquier duda cuente
            con nosotros.</p><br/>";
        $Tabla = $Render->Tabla($TablaDatos);
        $Mensaje.=$Tabla;
        echo $Mensaje;
    }
}
