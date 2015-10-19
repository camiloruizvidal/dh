<?php

if (isset($_POST['Paquetes'])&&$_POST['Paquetes']!='0')
{
    include_once '../Controller/Servicios.php';
    include_once '../Controller/Visual.php';
    $Descripcion  = new Servicios();
    $Render       = new Visual();
    $Municipios=$Descripcion->VerMunicipios();
    $Municipios=$Render->FormatoSelect($Municipios);
    $id_paquete   = $_POST['Paquetes'];
    $Datos        = $Descripcion->VerDescripcionPaquete($id_paquete);
    $Nombre       = $Datos['Nombre'];
    $Valor        = $Datos['Valor'];
    $Fecha_inicio = $Datos['Fecha_inicio'];
    $Fecha_fin    = $Datos['Fecha_fin'];
    $id_Muncipio    = $Datos['id_Muncipio'];
    $Descripciones  = $Datos['Descripcion'];
    echo '<div class="row"><div class="col-lg-12"><label from="Nombre">Nombre:</label><input type="text" value="'.$Nombre.'" name="Nombre" class="form-control"></div></div>';
    echo '<div class="row"><div class="col-lg-12"><h5>Valor: $'.number_format($Valor, 0, ',', '.').'</h5>';
    echo '<div class="row"><div class="col-lg-12"><label from="Descripcion">Descripcion:</label><textarea rows="5" name="Descripcion" value="s" class="form-control">'.$Descripciones.'</textarea></div></div>';
    echo '<div class="row"><div class="col-lg-12"><label from="FechaInicio">Fecha de inicio:</label><input type="text" value="'.$Fecha_inicio.'" name="FechaInicio" id="FechaInicio" class="form-control"></div></div>';
    echo '<div class="row"><div class="col-lg-12"><label from="FechaFin">Fecha de fin:</label><input type="text" value="'.$Fecha_fin.'" name="FechaFin"  id="FechaFin" class="form-control"></div></div>';

    echo '<div class="row"><div class="col-lg-12"><label from="Municipio">Municipio</label>'.
            ($Render->Select($Municipios,'Municipios',$id_Muncipio,'id_Muncipio','','','','form-control'))
            .'</div></div>';
    echo '<button class="btn btn-success" onclick="GuardarPaquetes()">Guardar</button>';
    
    
    echo ' <script>
        $("#FechaInicio").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, yearRange: \'-100:+0\'});
        $("#FechaFin").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, yearRange: \'-100:+0\'});
        </script>';
    
}
else
{
    echo null;
}