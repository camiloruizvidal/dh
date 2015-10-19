<?php

class Visual
{

    public function GenerarLinkRegistro($Datos, $id, $img, $url)
    {
        $Res = array ();
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Dato  = $Datos[$i];
            $Temp2 = array ();
            foreach ($Dato as $key => $Temp)
            {
                if ($key == $id)
                {
                    $Temp2[$key] = '<a href="' . $url . '=' . $Temp . '"><img src="' . $img . '"></a>';
                }
                else
                {
                    $Temp2[$key] = $Temp;
                }
            }
            $Res[] = $Temp2;
        }
        return $Res;
    }

    public function EliminarRegistro($Datos, $id)
    {
        $Res = array ();

        for ($i = 0; $i < count($Datos); $i++)
        {
            $Dato  = $Datos[$i];
            $Temp2 = array ();
            foreach ($Dato as $key => $Temp)
            {
                if ($key != $id)
                {
                    $Temp2[] = $Dato[$key];
                }
            }
            $Res[] = $Temp2;
        }
        return $Res;
    }

    public function FormatoNumerico($ArrayDatos, $indice, $Signo = '', $Precicion = 2, $Miles = '.', $Decimal = ',')//Primero debe ser pasado a formatoselect
    {
        if (count($ArrayDatos) > 0)
        {
            $Res = array ();
            foreach ($ArrayDatos as $Datos)
            {
                $Number         = $Datos[$indice];
                $Datos[$indice] = $Signo . number_format($Number, $Precicion, $Miles, $Decimal);
                $Res[]          = $Datos;
            }
            return $Res;
        }
    }

    public function FunctionTable($Datos, $id, $function, $image)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<a href="javascript:' . $function . '(' . $Temp . ')"><img src="' . $image . '"></a>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function FunctionTable2($Datos, $id, $function, $arrayimage)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    $D               = explode(',', $Temp);
                    if($D[1]=="'S'")
                    {
                        $image=$arrayimage['S'];
                    }
                    else
                    {
                        $image=$arrayimage['N'];
                    }
                    @$html            = '<a href="javascript:' . $function . '(' . $Temp . ')"><img src="' . $image . '"></a>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function FunctionRecortarTexto($Datos, $id, $Cantidad, $Relleno = '...')
    {
        error_reporting(0);
        for ($i = 0; $i < count($Datos); $i++)
        {
            for ($j = 0; $j < count($Datos[$i]); $j++)
            {
                if ($j == $id)
                {
                    if (strlen($Datos[$i][$j]) > $Cantidad)
                    {
                        $Text          = substr($Datos[$i][$j], 0, $Cantidad) . $Relleno;
                        $Datos[$i][$j] = $Text;
                    }
                }
            }
        }
        return $Datos;
    }

    public function FormatoTable($Datos)
    {
        $Res = array ();
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Temp2 = array ();
            foreach ($Datos[$i] as $Temp)
            {
                $Temp2[] = $Temp;
            }
            $Res[] = $Temp2;
        }
        return $Res;
    }

    public function img($ArrayDatos, $indice, $Class = '', $href = '')
    {
        $Res = array ();
        if ($Class != '')
        {
            $Class = " class='{$Class}' ";
        }
        foreach ($ArrayDatos as $Datos)
        {
            $Temp           = $Datos[$indice];
            $Datos[$indice] = '<img src="' . $Temp . '"' . $Class . '/>';
            if ($href != '')
            {
                $Datos[$indice] = '<a href="' . $href . '">' . $Datos[$indice] . '</a>';
            }
            $Res[] = $Datos;
        }
        return $Res;
    }

    public function FormatoSelect($Datos)
    {
        $Res = array ();
        foreach ($Datos as $Temp)
        {
            $Temp2 = array ();
            foreach ($Temp as $Temp1)
            {
                $Temp2[] = $Temp1;
            }
            $Res[] = $Temp2;
        }
        return $Res;
    }

    public function Paginar($Tabla = '', $PaginaActual = '1', $NumeroPaginas = '0', $function = '', $Clase = 'pagination')
    {
        $Datos = '<nav align="center"><ul class="' . $Clase . '"><li>';
        if ($PaginaActual > 1)
            $Datos.='<a href="javascript:' . $function . '(' . ($PaginaActual - 1) . ')" aria-label="Previous">';
        $Datos.='<span aria-hidden="true">&laquo;</span></a></li>';
        for ($i = 0; $i < $NumeroPaginas; $i++)
        {
            $Class = '';
            $p     = $i + 1;
            if ($p == $PaginaActual)
                $Class = ' Class="active" ';
            $Datos .= '<li' . $Class . '><a href="javascript:' . $function . '(' . $p . ')">' . $p . '</a></li>';
        }
        $Datos .= '<li>';
        if (($PaginaActual) < $NumeroPaginas)
        {
            $Datos.='<a href="javascript:' . $function . '(' . ($PaginaActual + 1) . ')" aria-label="Next">';
        }
        $Datos.='<span aria-hidden="true">&raquo;</span></a></li></ul></nav>';
        return $Tabla . $Datos;
    }

    public function GenerardorLink($Url, $Click = '', $image = '', $texto = '')
    {
        $Script = '';
        if ($Click != '')
        {
            $Script = '<input src="' . $image . '" type="image" onclick="' . $Click . ';">';
        }
        else
        {
            if ($image != '')
                $Script = "<a href=\"$Url\"><img src=\"$image\"></a>";
            else
                $Script = "<a href=\"$Url\">$texto</a>";
        }
        return $Script;
    }

    public function Panel($datos, $class = '')
    {

        $Res = '<ul class="' . $class . '">';
        foreach ($datos as $Temp)
        {
            $Res.='<li><a href="' . $Temp['url'] . '">' . $Temp['Text'] . '</a></li>';
        }
        $Res.='</ul>';
        return $Res;
    }

    public function CambiarDatos($Datos, $Valores)
    {
        $Valor = "<table border=1>\n";
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Valor.="<tr>";
            $Valor.="<td>$Datos[$i]</td><td>$Valores[$i]</td>\n";
            $Valor.="</tr>";
        }
        $Valor.="</table>\n";
        return $Valor;
    }

    public function TextBox($nombre, $Valor, $id)
    {
        if ($id != '')
        {
            $id = "id=\"$id\"";
        }
        if ($Valor != '')
        {
            $Valor = " value=\"$Valor\" ";
        }
        return "<input name=\"$nombre\"	$id $Valor type=\"text\" />";
    }

    private function CombinarColumnas($Datos, $ColumnasCombinar)//No usar, no esta funcionando como se debe
    {

        $tabla        = '';
        $Duplicado    = '';
        $DatosFinales = '';
        $Nombre       = array ();
        $Cant         = array ();
        $Anterior     = '';
        if ($ColumnasCombinar !== NULL && $ColumnasCombinar !== '')
        {
            foreach ($Datos as $Temp1)
            {
                $Temp2 = '';
                for ($i = 0; !empty($Temp1[$i]); $i++)
                {
                    if (in_array($i, $ColumnasCombinar))
                    {
                        $Temp2[$i] = $Temp1[$i];
                        $Cant[$i]  = 1;
                    }
                }
                $Nombre[] = $Temp2;
            }
        }
        for ($j = 0; $j < count($Datos); $j++)
        {
            $Temp3 = $Datos[$j];
            $tabla.='<tr>';
            for ($i = 0; !empty($Temp3[$i]); $i++)
            {
                if ($ColumnasCombinar !== NULL && $ColumnasCombinar !== '')
                {

                    if (in_array($i, $ColumnasCombinar))
                    {
                        if ($j == 0)
                        {
                            $Anterior[$i] = $Nombre[$j][$i];
                        }
                        if (!empty($Anterior[$i]) && $Anterior[$i] == $Nombre[$j][$i])
                        {
                            $Cant[$i]      = $Cant[$i] + 1;
                            $Duplicado[$i] = '<td   rowspan="' . $Cant[$i] . '" VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                        }
                        else
                        {
                            $Anterior[$i]  = $Nombre[$j][$i];
                            $Cant[$i]      = 1;
                            $tabla.=$Duplicado[$i];
                            $Duplicado[$i] = '<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                        }
                    }
                    else
                    {
                        $tabla.='<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                    }
                }
                else
                {
                    $tabla.='<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                }
            }
            $tabla.='</tr>';
        }
        $tabla.="</table>";
        return $tabla;
    }

    public function Tabla($Datos, $Border = '', $Encabezado = '', $Class = '', $Id = '', $Contar = FALSE, $ColumnasCombinar = '', $Paginas = '', $NumPag = '', $color = '')
    {
        if ((count($Datos) > 0 && $Datos[0] !== '' && $Datos !== NULL))
        {

            $count = 0;
            if ($Id != '')
            {
                $Id = " id=\"$Id\" ";
            }
            if ($Class != "")
            {
                $Class = " class=\"$Class\" ";
            }
            if ($Border != '')
            {
                $Border = " border=\"$Border\" ";
            }
            $tabla = "<table$Border$Id$Class>\n";
            if ($Encabezado != '')
            {
                foreach ($Encabezado as $Temp)
                {
                    $tabla.="<th><center>$Temp</center></th>";
                }
            }
            foreach ($Datos as $Temp1)
            {
                $colores = '';
                if ($color != '')
                {

                    $colores = ' style="background-color: ' . $Temp1[$color] . ';" ';
                }
                $tabla.='<tr valign="top"' . $colores . '>';

                if ($Contar)
                {
                    $count++;
                    $tabla.="<td valign=top align=\"center\">$count</td>";
                }
                foreach ($Temp1 as $key => $Temp2)
                {
                    if (is_null($Temp2))
                    {
                        $Temp1[$key] = '';
                    }
                }
                for ($i = 0; isset($Temp1[$i]); $i++)
                {

                    if ($color !== $i)
                    {
                        $tabla.="<td valign=top align=\"center\">$Temp1[$i]</td>";
                    }
                }
                $tabla.='</tr>';
            }
            $tabla.="</table>";
            return $tabla;
        }
    }

    private function Inciar($Datos, $Value, $Valueid = '')
    {
        if ($Value == NULL && $Valueid == NULL)
        {
            $Valores   = array ();
            $temp      = array (0 => '0', 1 => 'SELECCIONE');
            $Valores[] = $temp;
            for ($i = 0; $i < count($Datos); $i++)
            {
                $Valores[] = $Datos[$i];
            }
            $Datos = $Valores;
        }
        return $Datos;
    }

    public function Select($Datos, $Nombre = '', $Value = '', $id = '', $onchange = '', $Valueid = '', $Style = '', $class = '')
    {
        error_reporting(0);
        $Nombre = "name=\"$Nombre\"";
        if ($id != '' && $id != NULL)
        {
            $id = "id=\"$id\"";
        }
        if ($class != '')
        {
            $class = "class=\"$class\"";
        }
        if ($Style != '')
        {
            $Style = "style=\"$Style\"";
        }
        if ($onchange != '')
        {
            $onchange = " onchange=\"$onchange\"";
        }
        $Select = "<select $Nombre$id$onchange$class $Style>\n";
        $total  = count($Datos);
        $Datos  = $this->Inciar($Datos, $Value, $Valueid);
        if ($total > 0 && $Datos != '')
        {
            foreach ($Datos as $Temp)
            {
                if ($Value == $Temp[0] || $Valueid == $Temp[1])
                {
                    $Select.="	<option SELECTED value=\"$Temp[0]\">$Temp[1]</option>\n";
                }
                else
                {
                    $Select.="	<option value=\"$Temp[0]\">$Temp[1]</option>\n";
                }
            }
        }
        $Select.='</select>';
        return $Select;
    }

    public function VerDatos($Datos)
    {
        $Res = '';
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Res.="'$Datos[$i]'";
            if ($i < count($Datos) - 1)
            {
                $Res.=',';
            }
        }
        return $Res;
    }

}

?>