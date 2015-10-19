<?php

class ModelAdmin
{

    public function RegistrosVentasPaquetes($FechaInicio, $FechaFin)
    {
        $sql = 'SELECT 
                count(`paquete`.`id_paquete`) AS `cantidad`,
                `paquete`.`Nombre`,
                `paquete`.`Valor`
              FROM
                `reserva`
                INNER JOIN `paquete` ON (`reserva`.`Fk_paquete` = `paquete`.`id_paquete`)
                INNER JOIN `servicios_paquete` ON (`paquete`.`id_paquete` = `servicios_paquete`.`fk_paquete`)
              WHERE
                `reserva`.`Estado` = "Confirmado" AND 
                `reserva`.`Fecha_reserva` BETWEEN ? AND ?
              GROUP BY
                `paquete`.`Nombre`,
                `paquete`.`Valor`';
        $Res = $this->con->Records($sql, array($FechaInicio, $FechaFin));
        return $Res;
    }
    public function RegistrosVentasServicios($FechaInicio, $FechaFin)
    {
        $sql = 'SELECT 
                count(`servicios`.`id_servicios`) AS `cantidad`,
                `servicios`.`Nombre`,
                `proveedor`.`Nombre` AS `proveedor`,
                `proveedor`.`Nit`
              FROM
                `reserva`
                INNER JOIN `paquete` ON (`reserva`.`Fk_paquete` = `paquete`.`id_paquete`)
                INNER JOIN `servicios_paquete` ON (`paquete`.`id_paquete` = `servicios_paquete`.`fk_paquete`)
                INNER JOIN `servicios` ON (`servicios_paquete`.`fk_servicio` = `servicios`.`id_servicios`)
                INNER JOIN `proveedor` ON (`servicios`.`fk_Proveedor` = `proveedor`.`id_proveedor`)
              WHERE
                `reserva`.`Estado` = "Confirmado" AND 
                `reserva`.`Fecha_reserva` BETWEEN ? AND ?
              GROUP BY
            `servicios`.`Nombre`,
            `proveedor`.`Nit`';
        $Res = $this->con->Records($sql, array($FechaInicio, $FechaFin));
        return $Res;
    }
}
