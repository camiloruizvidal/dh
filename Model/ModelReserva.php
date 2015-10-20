<?php

include_once 'BaseDatos/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class ModelReserva
{

    public function GenerarServicioReserva($paquete, $servicio, $cantidad, $valorUnitarioServicio, $por_admin)
    {
        $R                          = atable::Make('paquete_reservado_servicios');
        $R->fk_paquete              = $paquete;
        $R->fk_servicio             = $servicio;
        $R->cantidad_servicios      = $cantidad;
        $R->valor_unitario_servicio = $valorUnitarioServicio;
        $R->porcentaje_admin        = $por_admin;
        $R->Save();
        return $R->id_paquete_reservados_servicios;
    }

    public function GenerarReservaServicio($valor, $fecha_inicio, $fecha_fin)
    {
        $R               = atable::Make('paquete_reservado');
        $R->valor        = $valor;
        $R->nombre       = 'Reserva servicio';
        $R->fecha_inicio = $fecha_inicio;
        $R->fecha_fin    = $fecha_fin;
        $R->Save();
        return $R->id_paquete_reservado;
    }

    public function ReservasPaquetes($id_reserva)
    {
        $con = App::$base;
        $sql = 'SELECT 
                `servicios`.`Nombre` AS `servicio`,
                `proveedor`.`Nombre` AS `proveedor`,
                `proveedor`.`Direccion`,
                `proveedor`.`Telefono`,
                `paquete_reservado_servicios`.`cantidad_servicios` AS `cantidad`,
                `paquete_reservado_servicios`.`valor_unitario_servicio` AS `valor`
              FROM
                `servicios`
                INNER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
                INNER JOIN `paquete_reservado_servicios` ON (`paquete_reservado_servicios`.`fk_servicio` = `servicios`.`id_servicios`)
                INNER JOIN `paquete_reservado` ON (`paquete_reservado_servicios`.`fk_paquete` = `paquete_reservado`.`id_paquete_reservado`)
                INNER JOIN `reserva` ON (`paquete_reservado`.`id_paquete_reservado` = `reserva`.`Fk_paquete`)
                where 
                `reserva`.`Id_reserva`=?';
        $Res = $con->TablaDatos($sql, array ($id_reserva));
        return $Res;
    }

    function ReservaHecha($id_reserva)
    {
        $con = App::$base;
        $sql = 'SELECT 
                    `servicios`.`Nombre` as servicio,
                      `proveedor`.`Nombre` as proveedor,
                      `proveedor`.`Direccion`,
                      `proveedor`.`Telefono`,
                      `cotizacion_servicio`.`cantidad` as cantidad,
                      `cotizacion_servicio`.`Precio` as valor

                    FROM
                      `cotizacion_servicio`
                      INNER JOIN `cotizacion` ON (`cotizacion_servicio`.`id_cotizacion` = `cotizacion`.`id_cotizacion`)
                      INNER JOIN `reserva` ON (`cotizacion`.`id_cotizacion` = `reserva`.`fk_cab_cotizacion`)
                      INNER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
                      INNER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
                where 
                `reserva`.`Id_reserva`=?';
        $Res = $con->Records($sql, array ($id_reserva));
        return $Res;
    }

    public function ReservasCotizacion($id_reserva)
    {
        $con = App::$base;
        $sql = 'SELECT 
                    `servicios`.`Nombre` as servicio,
                      `proveedor`.`Nombre` as proveedor,
                      `proveedor`.`Direccion`,
                      `proveedor`.`Telefono`,
                      `cotizacion_servicio`.`cantidad` as cantidad,
                      `cotizacion_servicio`.`Precio` as valor

                    FROM
                      `cotizacion_servicio`
                      INNER JOIN `cotizacion` ON (`cotizacion_servicio`.`id_cotizacion` = `cotizacion`.`id_cotizacion`)
                      INNER JOIN `reserva` ON (`cotizacion`.`id_cotizacion` = `reserva`.`fk_cab_cotizacion`)
                      INNER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
                      INNER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
                where 
                `reserva`.`Id_reserva`=?';
        $Res = $con->TablaDatos($sql, array ($id_reserva));
        return $Res;
    }

    public function VerReservasHechas()
    {
        $con = App::$base;
        $sql = 'SELECT 
                `reserva`.`Id_reserva`,
                CONCAT(`cliente`.`Nombres`," ", `cliente`.`Apellidos`) AS `Nombre`,
                `cliente`.`Email`,
                `cliente`.`Telefono`,
                `reserva`.`valor`,
                date(`reserva`.`Fecha_reserva`),
                `reserva`.`Estado`,
                (
                      case `reserva`.`Pago` 
                  when "N" THEN "No ha cancelado"
                  when "S" THEN "Pago"
                  end
                ) as Pago,
                (
                      case `reserva`.`tipo` 
                  when "P" THEN "Paquete"
                  when "C" THEN "Cotizacion"
                  end
                ) as Tipo  

              FROM
                `reserva`
                INNER JOIN `cliente` ON (`reserva`.`fk_cliente` = `cliente`.`id_cliente`)
                 order BY `reserva`.`Fecha_reserva` ASC, Pago ASC, `reserva`.`valor` DESC';
        $Res = $con->TablaDatos($sql, array ());
        return $Res;
    }

    public function VerReservasHecha($id_reserva)
    {
        $con = App::$base;
        $sql = 'SELECT 
                `reserva`.`Id_reserva`,
                CONCAT(`cliente`.`Nombres`," ", `cliente`.`Apellidos`) AS `Nombre`,
                `cliente`.`Email`,
                `cliente`.`Telefono`,
                `reserva`.`valor`,
                `reserva`.`Fecha_reserva`,
                `reserva`.`Estado`,
                (
                      case `reserva`.`Pago` 
                  when "N" THEN "No ha cancelado"
                  when "S" THEN "Pago"
                  end
                ) as Pago,
                (
                      case `reserva`.`tipo` 
                  when "P" THEN "Paquete"
                  when "C" THEN "Cotizacion"
                  end
                ) as Tipo  

              FROM
                `reserva`
                INNER JOIN `cliente` ON (`reserva`.`fk_cliente` = `cliente`.`id_cliente`)
                where `reserva`.`Id_reserva`=?';
        $Res = $con->Record($sql, array ($id_reserva));
        return $Res;
    }

    private function Guardarpaquete_reservado($nombre, $valor, $fecha_inicio, $fecha_fin, $descripcion, $urlfoto, $id_muncipio)
    {
        $R               = atable::Make('paquete_reservado');
        $R->nombre       = $nombre;
        $R->valor        = $valor;
        $R->fecha_inicio = $fecha_inicio;
        $R->fecha_fin    = $fecha_fin;
        $R->descripcion  = $descripcion;
        $R->urlfoto      = $urlfoto;
        $R->id_muncipio  = $id_muncipio;
        $R->Save();
        return $R->id_paquete_reservado;
    }

    private function guardar_Guardarpaquete_reservado_servicios($fk_servicio, $cantidad_servicios, $valor_unitario_servicio, $porcentaje_admin, $id_paquete)
    {
        $R                          = atable::Make('paquete_reservado_servicios');
        $R->fk_servicio             = $fk_servicio;
        $R->cantidad_servicios      = $cantidad_servicios;
        $R->valor_unitario_servicio = $valor_unitario_servicio;
        $R->porcentaje_admin        = $porcentaje_admin;
        $R->fk_paquete              = $id_paquete;
        $R->Save();
        return $R->id_paquete_reservados_servicios;
    }

    private function GuardarServicios($fk_servicio, $cantidad_servicios, $valor_unitario_servicio, $porcentaje_admin, $id_paquete)
    {
        $id = $this->guardar_Guardarpaquete_reservado_servicios($fk_servicio, $cantidad_servicios, $valor_unitario_servicio, $porcentaje_admin, $id_paquete);
        return $id;
    }

    private function Guardarpaquete_reservado_servicios($id_paquete, $id_paquete_reserva)
    {
        $con = App::$base;
        $sql = 'SELECT 
                `servicios_paquete`.`fk_servicio`,
                `servicios_paquete`.`cantidad_servicios`,
                `servicios_paquete`.`valor_unitario_servicio`,
                `servicios_paquete`.`porcentaje_admin`
              FROM
                `servicios_paquete`
              WHERE
                `servicios_paquete`.`fk_paquete` = ?';
        $Res = $con->Records($sql, array ($id_paquete));
        foreach ($Res as $R)
        {

            $this->GuardarServicios($R['fk_servicio'], $R['cantidad_servicios'], $R['valor_unitario_servicio'], $R['porcentaje_admin'], $id_paquete_reserva);
        }
    }

    public function GuardarReservarPaqueteServicios($id_paquete)
    {
        $R    = atable::Make('paquete');
        $R->Load('id_paquete=' . $id_paquete);
        $id   = $this->Guardarpaquete_reservado($R->nombre, $R->valor, $R->fecha_inicio, $R->fecha_fin, $R->descripcion, $R->urlfoto, $R->id_muncipio);
        $data = $this->Guardarpaquete_reservado_servicios($id_paquete, $id);
        return $id;
    }

    public function ReservarPaquete($Fk_paquete, $fk_cliente, $valor, $Fecha_pedido, $Fecha_reserva, $Estado, $Pago)
    {
        $R                = atable::Make('reserva');
        $R->fk_paquete    = $Fk_paquete;
        $R->fk_cliente    = $fk_cliente;
        $R->valor         = $valor;
        $R->fecha_pedido  = $Fecha_pedido;
        $R->fecha_reserva = $Fecha_reserva;
        $R->estado        = $Estado;
        $R->pago          = $Pago;
        $R->tipo          = 'P';
        $R->Save();
        return $R->id_reserva;
    }

    public function Reserva($Fk_paquete, $fk_cliente, $valor, $Fecha_pedido, $Fecha_reserva, $Estado, $Pago, $cab_cotizacion = NULL)
    {
        $tipo = 'P';
        if (!is_null($cab_cotizacion))
        {
            $tipo = 'C';
        }
        $R                    = atable::Make('reserva');
        $R->fk_paquete        = $Fk_paquete;
        $R->fk_cliente        = $fk_cliente;
        $R->valor             = $valor;
        $R->fecha_pedido      = $Fecha_pedido;
        $R->fecha_reserva     = $Fecha_reserva;
        $R->estado            = $Estado;
        $R->pago              = $Pago;
        $R->fk_cab_cotizacion = $cab_cotizacion;
        $R->tipo              = $tipo;
        $R->Save();
        return $R->id_reserva;
    }

    public function Pagar($Id_reserva)
    {
        $R = atable::Make('reserva');
        $R->Load('Id_reserva=' . $Id_reserva);
        if (!is_null($R->id_reserva))
        {
            $R->pago   = 'S';
            $R->estado = 'Confirmado';
            $R->Save();
        }
        return $R->id_reserva;
    }

    public function ReservaPaga($Id_reserva)
    {
        $con = App::$base;
        $sql = 'SELECT 
  `reserva`.`Id_reserva`,
  `reserva`.`Fk_paquete` AS `Paquete`,
  `reserva`.`valor` AS `valor_reserva`,
  `reserva`.`Fecha_pedido`,
  `reserva`.`Fecha_reserva`,
  `reserva`.`Estado`,
  `reserva`.`Pago`,
  `paquete_reservado`.`Nombre`,
  `paquete_reservado`.`Valor`,
  `paquete_reservado`.`Fecha_inicio`,
  `paquete_reservado`.`Fecha_fin`
FROM
  `reserva`
  INNER JOIN `paquete_reservado` ON (`reserva`.`Fk_paquete` = `paquete_reservado`.`id_paquete_reservado`)
            where `reserva`.`Id_reserva`=?
            and `reserva`.`Pago`=?';
        $Res = $con->Records($sql, array ($Id_reserva, 'S'));
        return $Res;
    }

    public function VerCotizacion($id_cotizacion)
    {
        $con = App::$base;
        $sql = 'SELECT 
                `reserva`.`Id_reserva`,
                `reserva`.`valor` AS `valor_reserva`,
                `reserva`.`Fk_paquete` AS `Paquete`,
                `reserva`.`Fecha_pedido`,
                `reserva`.`Fecha_reserva`,
                `reserva`.`Pago`,
                `paquete_reservado`.`Nombre`,
                `paquete_reservado`.`Valor`,
                `paquete_reservado`.`Fecha_inicio`,
                `paquete_reservado`.`Fecha_fin`
              FROM
                `reserva`
                INNER JOIN `paquete_reservado` ON (`reserva`.`Fk_paquete` = `paquete_reservado`.`id_paquete_reservado`)
                WHERE
                  `reserva`.`Id_reserva`=? AND 
                  `reserva`.`Estado` = ?';
        $Res = $con->Records($sql, array ($id_cotizacion, 'cotizacion'));
        return $Res;
    }

##Revisar de aqui para abajo

    public function VerReservasProveedor($cod_proveedor)
    {
        $con = App::$base;
        $sql = "SELECT 
  CONCAT(IFNULL(`servicios`.`Nombre`, ''), IFNULL(`servicios1`.`Nombre`, '')) AS `nombre`,
  CONCAT(IFNULL(`servicios`.`id_servicios`, ''), IFNULL(`servicios1`.`id_servicios`, '')) AS `id_servicios`,
  `reserva`.`Fecha_reserva`,
  `reserva`.`Fecha_reserva`,
  concat(`cliente`.`Nombres`, `cliente`.`Apellidos`) AS `cliente`,
  `cliente`.`Numero_Id`,
  `cliente`.`Email`,
  `cliente`.`Telefono`
FROM
  `reserva`
  LEFT OUTER JOIN `cotizacion` ON (`reserva`.`fk_cab_cotizacion` = `cotizacion`.`id_cotizacion`)
  LEFT OUTER JOIN `cotizacion_servicio` ON (`cotizacion`.`id_cotizacion` = `cotizacion_servicio`.`id_cotizacion`)
  LEFT OUTER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
  LEFT OUTER JOIN `proveedor` `proveedor1` ON (`servicios`.`fk_Proveedor` = `proveedor1`.`id_proveedor`)
  INNER JOIN `cliente` ON (`reserva`.`fk_cliente` = `cliente`.`id_cliente`)
  INNER JOIN `paquete_reservado` ON (`reserva`.`Fk_paquete` = `paquete_reservado`.`id_paquete_reservado`)
  INNER JOIN `paquete_reservado_servicios` ON (`paquete_reservado`.`id_paquete_reservado` = `paquete_reservado_servicios`.`fk_paquete`)
  INNER JOIN `servicios` `servicios1` ON (`paquete_reservado_servicios`.`fk_servicio` = `servicios1`.`id_servicios`)
  LEFT OUTER JOIN `proveedor` ON (`servicios1`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
      WHERE
            `proveedor1`.`Codigo`=? or  `proveedor`.`Codigo`=?
            order by
            cliente,`reserva`.`Fecha_reserva`,`servicios`.`Nombre`,`servicios1`.`Nombre` ";
        $Res = $con->Records($sql, array ($cod_proveedor, $cod_proveedor));
        return $Res;
    }

    public function VerReservasProveedorPagas($cod_proveedor)
    {
        $con = App::$base;
        $sql = "SELECT 
  COALESCE(`servicios`.`Nombre`, `servicios1`.`Nombre`) AS `nombre`,
  COALESCE(`servicios1`.`id_servicios`, `servicios`.`id_servicios`) AS `id_servicios`,
  COALESCE(`cotizacion_servicio`.`cantidad`, `paquete_reservado_servicios`.`cantidad_servicios`) AS `cantidad`,
  concat('$',Format(COALESCE(`paquete_reservado_servicios`.`valor_unitario_servicio`, `cotizacion_servicio`.`Precio`),0)) AS `valor`,
  `reserva`.`Fecha_pedido`,
  CONCAT_WS(' ', `cliente`.`Nombres`, `cliente`.`Apellidos`) AS `cliente`,
  `cliente`.`Numero_Id`,
  `cliente`.`Email`,
  `cliente`.`Telefono`
FROM
  `reserva`
  LEFT OUTER JOIN `cotizacion` ON (`reserva`.`fk_cab_cotizacion` = `cotizacion`.`id_cotizacion`)
  LEFT OUTER JOIN `paquete_reservado` ON (`reserva`.`Fk_paquete` = `paquete_reservado`.`id_paquete_reservado`)
  LEFT OUTER JOIN `cotizacion_servicio` ON (`cotizacion`.`id_cotizacion` = `cotizacion_servicio`.`id_cotizacion`)
  LEFT OUTER JOIN `paquete_reservado_servicios` ON (`paquete_reservado`.`id_paquete_reservado` = `paquete_reservado_servicios`.`fk_paquete`)
  LEFT OUTER JOIN `servicios` ON (`paquete_reservado_servicios`.`fk_servicio` = `servicios`.`id_servicios`)
  LEFT OUTER JOIN `servicios` `servicios1` ON (`cotizacion_servicio`.`id_servicio` = `servicios1`.`id_servicios`)
  LEFT OUTER JOIN `cliente` ON (`reserva`.`fk_cliente` = `cliente`.`id_cliente`)
  LEFT OUTER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
  LEFT OUTER JOIN `proveedor` `proveedor1` ON (`servicios1`.`fk_Proveedor` = `proveedor1`.`id_proveedor`)
WHERE
  `reserva`.`Pago` = 'S' AND
   ( `proveedor1`.`Codigo`=? OR
  `proveedor`.`Codigo`=?)
ORDER BY
  `cliente`,
  `reserva`.`Fecha_reserva`,
  `servicios`.`Nombre`,
  `servicios1`.`Nombre`";
        $Res = $con->Records($sql, array ($cod_proveedor, $cod_proveedor));
        return $Res;
    }

    public function VerReservasProveedorFechas($cod_proveedor)
    {
        $sql = "SELECT 
  CONCAT(IFNULL(`servicios`.`id_servicios`, ''), IFNULL(`servicios1`.`id_servicios`, '')) AS `id_servicios`,
  CONCAT(IFNULL(`servicios`.`Nombre`, ''), IFNULL(`servicios1`.`Nombre`, '')) AS `nombre`,
  CONCAT(IFNULL(`cotizacion_servicio`.`Precio`, ''), IFNULL(`paquete_reservado_servicios`.`valor_unitario_servicio`, '')) AS `valor`,
  `reserva`.`Fecha_reserva` AS `comprado`,
  `reserva`.`Fecha_pedido`,
  COALESCE(`servicios`.`Disponibilidad`, `servicios1`.`Disponibilidad`) AS `Disponibilidad`,
  COALESCE(`servicios1`.`Estado`, `servicios`.`Estado`) AS `Estado`
FROM
  `reserva`
  LEFT OUTER JOIN `cotizacion` ON (`reserva`.`fk_cab_cotizacion` = `cotizacion`.`id_cotizacion`)
  LEFT OUTER JOIN `cotizacion_servicio` ON (`cotizacion`.`id_cotizacion` = `cotizacion_servicio`.`id_cotizacion`)
  LEFT OUTER JOIN `servicios` ON (`cotizacion_servicio`.`id_servicio` = `servicios`.`id_servicios`)
  LEFT OUTER JOIN `proveedor` `proveedor1` ON (`servicios`.`fk_Proveedor` = `proveedor1`.`id_proveedor`)
  INNER JOIN `paquete_reservado` ON (`reserva`.`Fk_paquete` = `paquete_reservado`.`id_paquete_reservado`)
  INNER JOIN `paquete_reservado_servicios` ON (`paquete_reservado`.`id_paquete_reservado` = `paquete_reservado_servicios`.`fk_paquete`)
  INNER JOIN `servicios` `servicios1` ON (`paquete_reservado_servicios`.`id_paquete_reservados_servicios` = `servicios1`.`id_servicios`)
  LEFT OUTER JOIN `proveedor` ON (`servicios1`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
  WHERE
      `proveedor1`.`Codigo`=? or  `proveedor`.`Codigo`=?";
        $con = App::$base;
        $Res = $con->Records($sql, array ($cod_proveedor, $cod_proveedor));
        return $Res;
    }

    public function VerServiciosPaquete($paquete)
    {
        $sql = 'SELECT 
                `servicios_paquete`.`id_servicios_paquete`,
                `servicios_paquete`.`fk_paquete`,
                `servicios_paquete`.`fk_servicio`,
                `servicios_paquete`.`cantidad_servicios`,
                `servicios_paquete`.`valor_unitario_servicio`,
                `servicios_paquete`.`porcentaje_admin`,
                `servicios_paquete`.`Disponible`
              FROM
                `servicios_paquete`
              WHERE
                `servicios_paquete`.`fk_paquete`=?';
        $con = App::$base;
        $Res = $con->Records($sql, array ($paquete));
        return $Res;
    }

    public function VerPaquete($paquete)
    {
        $sql = 'SELECT 
  `paquete`.`id_paquete`,
  `paquete`.`Nombre`,
  `paquete`.`Valor`,
  `paquete`.`Fecha_inicio`,
  `paquete`.`Fecha_fin`,
  `paquete`.`Disponible`,
  `paquete`.`Estado`,
  `paquete`.`Descripcion`,
  `paquete`.`urlFoto`,
  `paquete`.`id_Muncipio`
FROM
  `paquete`
WHERE
  `paquete`.`id_paquete`=?';
        $con = App::$base;
        $Res = $con->Record($sql, array ($paquete));
        return $Res;
    }

    public function Guardar_paquete_reservado($paquete)
    {
        extract($paquete);
        $P               = atable::Make('paquete_reservado');
        $P->nombre       = $Nombre;
        $P->valor        = $Valor;
        $P->fecha_inicio = $Fecha_inicio;
        $P->fecha_fin    = $Fecha_fin;
        $P->descripcion  = $Descripcion;
        $P->urlfoto      = $urlFoto;
        $P->id_muncipio  = $id_Muncipio;
        $P->Save();
        return $P->id_paquete_reservado;
    }

    public function Guardar_paquete_reservado_servicios($id, $Servicios)
    {
        extract($Servicios);        
        $P                          = atable::Make('paquete_reservado_servicios');
        $P->fk_paquete              = $id;
        $P->fk_servicio             = $fk_servicio;
        $P->cantidad_servicios      = $cantidad_servicios;
        $P->valor_unitario_servicio = $valor_unitario_servicio;
        $P->porcentaje_admin        = $porcentaje_admin;
        $P->Save();
    }

}
