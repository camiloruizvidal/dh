<?php

include_once 'BaseDatos/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class ModelCotizar
{

    public function VerCabCotizaciones($id_cotizacion)
    {
        $Datos=array();
        $C = atable::Make('cotizacion');
        $C->Load("id_cotizacion = $id_cotizacion");
        $Datos['id_cotizacion']=$C->id_cotizacion;
        $Datos['fecha_inicio']=$C->fecha_inicio;
        $Datos['fecha_cotizacion']=$C->fecha_cotizacion;
        $Datos['id_cliente']=$C->id_cliente;
        $Datos['precio']=$C->precio;
        return $Datos;
    }

    public function VerCabCotizacionClienteAprobadas($id_cliente)
    {
        $con   = App::$base;
        $sql   = 'SELECT 
            `cotizacion`.`id_cotizacion`,
            `cotizacion`.`Fecha_cotizacion`,
            `cotizacion`.`Fecha_inicio`,
            `cotizacion`.`Descripcion`,
            FORMAT(`cotizacion`.`precio`,0) as `precio`
          FROM
            `cotizacion`
          WHERE
            `cotizacion`.`Estado` = ?
              and
              `cotizacion`.`id_cliente`=?';
        $Datos = $con->TablaDatos($sql, array('A', $id_cliente));
        return $Datos;
    }

    public function VerTotalCotizacion($id_cotizacion)
    {
        $con = App::$base;
        $sql = 'SELECT SUM((
                `cotizacion_servicio`.`Precio`*`cotizacion_servicio`.`cantidad`)) as "Total"
              FROM
                `cotizacion_servicio`
              WHERE
                `cotizacion_servicio`.`id_cotizacion` = ?';
        $Res = $con->Record($sql, array($id_cotizacion));
        return $Res['Total'];
    }

    public function VerTotalCotizacionAprobada($id_cotizacion)
    {
        $con = App::$base;
        $sql = 'SELECT SUM((
                `cotizacion_servicio`.`Precio`*`cotizacion_servicio`.`cantidad`)) as "Total"
              FROM
                `cotizacion_servicio`
              WHERE
                `cotizacion_servicio`.`id_cotizacion` = ?';
        $Res = $con->Record($sql, array($id_cotizacion));
        return $Res['Total'];
    }

    public function TotalCotizacion($id_cotizacion)
    {
        $con   = App::$base;
        $sql   = 'SELECT 
                SUM((`cotizacion_servicio`.`cantidad` * `servicios`.`Valor`)) AS `Total`
              FROM
                `cotizacion_servicio`
                INNER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
              WHERE
                `cotizacion_servicio`.`id_cotizacion`=?';
        $Datos = $con->Record($sql, array($id_cotizacion));
        return $Datos;
    }

    public function ActualizarPrecio($id_cotizacion, $precio)
    {
        $P         = atable::Make('cotizacion');
        $P->Load("id_cotizacion = $id_cotizacion");
        $P->precio = $precio;
        $P->Save();
    }

    public function DetalleCotizacion($id_servicio, $cantidad, $id_cotizacion, $Precio = NULL)
    {

        $P                = atable::Make('cotizacion_servicio');
        $P->id_cotizacion = $id_cotizacion;
        $P->id_servicio   = $id_servicio;
        $P->cantidad      = $cantidad;
        $P->precio        = $Precio;
        $P->Save();
        return $P->id_cotizacion_servicio;
    }
    public function DeleteCotizacion($id_cotizacion)
    {
        $P         = atable::Make('cotizacion');
        $P->Load("id_cotizacion=$id_cotizacion");
        $P->estado = 'R';
        $P->Save();
    }

    public function actualizarEstadoCotizacion($id_cotizacion, $Precio)
    {
        $P         = atable::Make('cotizacion');
        $P->Load("id_cotizacion=$id_cotizacion");
        $P->estado = 'A';
        $P->precio = $Precio;
        $P->Save();
    }

    public function ActualizarDetalleCotizacion($id_cotizacion_servicio, $cantidad, $precio)
    {
        $P           = atable::Make('cotizacion_servicio');
        $P->Load('id_cotizacion_servicio=' . $id_cotizacion_servicio);
        $P->cantidad = $cantidad;
        $P->precio   = $precio;
        $P->Save();
        return $P->id_cotizacion;
    }

    public function CabCotizacion($fecha_inicio, $descripcion, $id_cliente, $fecha_cotizacion = '')
    {
        $fecha_cotizacion    = date("Y-m-d");
        $P                   = atable::Make('cotizacion');
        $P->id_cliente       = $id_cliente;
        $P->fecha_cotizacion = $fecha_cotizacion;
        $P->fecha_inicio     = $fecha_inicio;
        $P->descripcion      = $descripcion;
        $P->estado           = 'P';
        $P->Save();
        return $P->id_cotizacion;
    }

    public function VerCabCotizacion()
    {
        $con   = App::$base;
        $sql   = 'SELECT 
                `cotizacion`.`id_cotizacion`,
                  `cliente`.`Nombres`,
                  `cliente`.`Apellidos`,
                  `cliente`.`Email`,
                  `cliente`.`Telefono`,
                  `cotizacion`.`Fecha_cotizacion`,
                  `cotizacion`.`Fecha_inicio`,
                  `cotizacion`.`Descripcion`,
                  Format(`cotizacion`.`precio`,0) as "precio"
                FROM
                  `cotizacion`
                  INNER JOIN `cliente` ON (`cotizacion`.`id_cliente` = `cliente`.`id_cliente`)
                WHERE
                  `cotizacion`.`Estado` = ?                    
                order by `cotizacion`.`id_cotizacion` DESC';
        $Datos = $con->TablaDatos($sql, array('P'));
        return $Datos;
    }

    public function VerCotizacion($id_cotizacion)
    {
        $con   = App::$base;
        $sql   = 'SELECT 
                `proveedor`.`Nombre` as "Proveedor",
                `servicios`.`Nombre` as "Servicio",
                `cotizacion_servicio`.`cantidad`,
                `servicios`.`Valor`,
                ( `cotizacion_servicio`.`cantidad`*
                `servicios`.`Valor`) as "total"
              FROM
                `cotizacion_servicio`
                INNER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
                INNER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
              WHERE
                `cotizacion_servicio`.`id_cotizacion` = ?';
        $Datos = $con->TablaDatos($sql, array($id_cotizacion));
        return $Datos;
    }

    public function VerCotizacionAprobadas($id_cotizacion)
    {
        $con   = App::$base;
        $sql   = 'SELECT 
                `proveedor`.`Nombre` as "Proveedor",
                `servicios`.`Nombre` as "Servicio",
                FORMAT(`cotizacion_servicio`.`cantidad`,0),
                FORMAT(`cotizacion_servicio`.`Precio`,0),
                FORMAT(( `cotizacion_servicio`.`cantidad`*
                `cotizacion_servicio`.`Precio`),0) as "total"
              FROM
                `cotizacion_servicio`
                INNER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
                INNER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
              WHERE
                `cotizacion_servicio`.`id_cotizacion` = ?';
        $Datos = $con->TablaDatos($sql, array($id_cotizacion));
        return $Datos;
    }

    public function VerCotizacionEdit($id_cotizacion)
    {
        $con   = App::$base;
        $sql   = 'SELECT 
                `proveedor`.`Nombre` as "Proveedor",
                concat(\'<input type="hidden" name="ids[]" value="\', `cotizacion_servicio`.`id_cotizacion_servicio`, \'">\',
                `servicios`.`Nombre`) AS `Servicio`,
                
                concat(\'<input type="text"  required="required" class="form-control money" name="cantidad[\', `cotizacion_servicio`.`id_cotizacion_servicio`, \']" value="\', FORMAT(`cotizacion_servicio`.`cantidad`,0), \'">\') AS `cantidad`,
                concat(\'<input type="text"  required="required" class="form-control money" name="Valor[\', `cotizacion_servicio`.`id_cotizacion_servicio`, \']" value="\', TRUNCATE(`servicios`.`Valor`,0), \'">\') AS `Valor`,
                (`cotizacion_servicio`.`cantidad` * `servicios`.`Valor`) AS `total`
              FROM
                `cotizacion_servicio`
                INNER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
                INNER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
                INNER JOIN `cotizacion` ON (`cotizacion_servicio`.`id_cotizacion` = `cotizacion`.`id_cotizacion`)
              WHERE
                `cotizacion_servicio`.`id_cotizacion` = ? ';
        $Datos = $con->TablaDatos($sql, array($id_cotizacion));
        return $Datos;
    }

    public function UsuarioCotizacion($id_cotizacion)
    {
        $con = App::$base;
        $sql = 'SELECT 
                `cliente`.`id_cliente`,
                `cliente`.`Nombres`,
                `cliente`.`Apellidos`,
                `cliente`.`TipoID`,
                `cliente`.`Numero_Id`,
                `cliente`.`Email`,
                `cliente`.`Telefono`,
                `cotizacion`.`Fecha_cotizacion`,
                `cotizacion`.`precio`
          FROM
            `cotizacion`
            INNER JOIN `cliente` ON (`cotizacion`.`id_cliente` = `cliente`.`id_cliente`)
          WHERE
            `cotizacion`.`id_cotizacion` = ?';
        $Res = $con->Record($sql, array($id_cotizacion));
        return $Res;
    }

}
