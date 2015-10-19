<?php

@include_once '../Model/ModelServicios.php';
@include_once 'Model/ModelServicios.php';

@include_once '../Controller/Proveedor.php';
@include_once 'Controller/Proveedor.php';

class Servicios
{

    public function VerServicio($id_servicio)
    {
        $Servicios = new ModelServicios();
        return $Servicios->VerServicio($id_servicio);
    }

    public function CambiarDisponibilidadServicio($cod_proveedor, $id_servicio)
    {
        $Paquete = new ModelServicios();
        return $Paquete->CambiarDisponibilidadServicio($cod_proveedor, $id_servicio);
    }

    public function VerTodosServiciosActivos($id_proveedor = '')
    {
        $Datos='';
        $Paquete = new ModelServicios();
        if ($id_proveedor != '')
        {
            $Datos=$Paquete->VerServiciosProveedorSelect($id_proveedor);
        }
        else
        {
            $Datos=$Paquete->VerTodosServiciosActivos($id_proveedor);
        }
        return $Datos;
    }

    public function VerPaquete($id)
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerPaquete($id);
        return $Datos;
    }

    public function CambiarImagen($id_paquete, $urlImagen)
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->CambiarImagen($id_paquete, $urlImagen);
        return $Datos;
    }

    public function ActualizarServiciosPaquetes($id, $cant, $valor)
    {
        $Paquete = new ModelServicios();
        $Paquete->ActualizarServiciosPaquetes($id, $cant, $valor);
    }

    public function CambiarEstadoServicio($est, $servicio)
    {
        $Paquete = new ModelServicios();
        $Paquete->CambiarEstadoServicio($est, $servicio);
    }

    public function Eliminar($id_servicio_paquete)
    {
        $Paquete = new ModelServicios();
        $Paquete->Eliminar($id_servicio_paquete);
    }

    public function VerServicioPaquete($id_servicio_paquete)
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerServicioPaquete($id_servicio_paquete);
        return $Datos;
    }

    public function EditarPaquete($Paquetes, $Nombre, $Descripcion, $Municipios, $Fecha_inicio, $Fecha_fin)
    {
        $Paquete = new ModelServicios();
        $Paquete->EditarPaquete($Paquetes, $Nombre, $Descripcion, $Municipios, $Fecha_inicio, $Fecha_fin);
    }

    public function ActualiarPaquete($id_paquete)
    {
        $Paquete     = new ModelServicios();
        $PrecioTotal = $Paquete->PrecioTotalPaquete($id_paquete);
        if (is_null($PrecioTotal['Total']))
        {
            $PrecioTotal = 0;
        }
        else
        {
            $PrecioTotal = $PrecioTotal['Total'];
        }
        $Paquete->ActualizarPrecioTotalPaquete($id_paquete, $PrecioTotal);
        return $PrecioTotal;
    }

    public function VerProveedores()
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerProveedores();
        return $Datos;
    }

    public function VerProveedoresActivos()
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerProveedoresActivos();
        return $Datos;
    }

    public function VerMunicipios()
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerMunicipios();
        return $Datos;
    }

    public function VerPaquetes()
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerPaquetes();
        return $Datos;
    }

    public function VerPaquetesActivos()
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerPaquetesActivos();
        return $Datos;
    }

    public function VerDescripcionPaquete($id_paquete)
    {
        $Paquete = new ModelServicios();
        $Datos   = $Paquete->VerPaqueteDescripcion($id_paquete);
        return $Datos;
    }

    public function VerServiciosProveedor($id_proveedor, $Cod_proveedor = '')
    {

        $Paquete = new ModelServicios();
        if ($Cod_proveedor != '')
        {

            $Proveedor    = new Proveedor();
            $Res          = $Proveedor->InfoProveedor($Cod_proveedor);
            $id_proveedor = $Res['id_proveedor'];
        }
        $Datos = $Paquete->VerServiciosProveedor($id_proveedor);
        return $Datos;
    }

    public function VerServiciosProveedorSoap($id_proveedor, $Cod_proveedor = '')
    {
        $Paquete = new ModelServicios();
        if ($Cod_proveedor != '')
        {
            $Proveedor    = new Proveedor();
            $Res          = $Proveedor->InfoProveedor($Cod_proveedor);
            $id_proveedor = $Res['id_proveedor'];
        }
        $Datos = $Paquete->VerServiciosProveedorSoap($id_proveedor);
        return $Datos;
    }

    public function VerServiciosProveedorAdmin($id_proveedor, $Cod_proveedor = '')
    {
        $Paquete = new ModelServicios();
        if ($Cod_proveedor != '')
        {
            $Proveedor    = new Proveedor();
            $Res          = $Proveedor->InfoProveedor($Cod_proveedor);
            $id_proveedor = $Res['id_proveedor'];
        }
        $Datos = $Paquete->VerServiciosProveedorAdmin($id_proveedor);
        return $Datos;
    }

    public function ServiciosXPaquete($id_paquete)
    {
        $Servicio = new ModelServicios();
        $Datos    = $Servicio->ServiciosXPaquete($id_paquete);
        return $Datos;
    }

    public function VerPaquetesConServicios()
    {
        $Paquetes = $this->VerPaquetes();
        $Res      = array ();
        foreach ($Paquetes as $Temp)
        {
            $Res[] = array ('Paquete' => $Temp, 'Servicios' => $this->ServiciosXPaquete($Temp['id_paquete']));
        }
        return $Res;
    }

    public function OfertarPaquete($Nombre, $Valor, $Fecha_inicio, $Fecha_fin, $Disponible, $Estado, $Descripcion = '', $imagen = '', $municipio = 1)
    {
        if ($imagen == '')
        {
            $imagen = 'images/other/default.jpg';
        }
        $Ofertar = new ModelServicios();
        $id      = $Ofertar->OfertarPaquete($Nombre, $Valor, $Fecha_inicio, $Fecha_fin, $Disponible, $Estado, $Descripcion, $imagen, $municipio);
        return $id;
    }

    public function OfertarServicio($FK_paquete, $Nombre, $ValorServicio)
    {
        $Ofertar = new ModelServicios();
        $id      = $Ofertar->OfertarServicio($FK_paquete, $Nombre, $ValorServicio);
        return $Ofertar->$id;
    }

    public function EditarDisponibilidadPaquete($id_paquete, $Disponibilidad)
    {
        $Disponible = new ModelServicios();
        $Disponible->EditarDisponibilidadPaquete($id_paquete, $Disponibilidad);
    }

    public function EditarDisponibilidadServicios($id_servicios, $Disponibilidad)
    {
        $Disponible = new ModelServicios();
        $Disponible->EditarDisponibilidadServicios($id_servicios, $Disponibilidad);
    }

    public function ConsultarDisponibilidadServicio($id_servicio)
    {
        $Servicio = new ModelServicios();
        $Datos    = $Servicio->ConsultarDisponibilidadServicio($id_servicio);
        return $Datos;
    }

    public function BuscarPaquetes($municipio, $FechaInicion, $FechaFin, $n_pagina, $cantidad_registros_pagina)
    {
        $cantidad_registros_pagina = (int) $cantidad_registros_pagina;
        $Servicio                  = new ModelServicios();
        $Datos                     = $Servicio->BuscarPaquetes($municipio, $FechaInicion, $FechaFin, $n_pagina, $cantidad_registros_pagina);
        return $Datos;
    }

    public function ArmarPaquetes($id_paquete, $id_servicio, $cantidad_servicios, $valor_unitario_servicio, $porcentaje_admin = 0)
    {
        $Armar = new ModelServicios();
        $id    = $Armar->ArmarPaquetes($id_paquete, $id_servicio, $cantidad_servicios, $valor_unitario_servicio, $porcentaje_admin);
        $this->ActualiarPaquete($id_paquete);
        return $id;
    }

    public function AutorizarPaquetes($id_Paquete, $Estado)
    {
        $auto = new ModelServicios();
        return $auto->AutorizarPaquetes($id_Paquete, $Estado);
    }

    public function QuitarServiciosPaquete($id_servicio_paquete)
    {
        $auto = new ModelServicios();
        return $auto->QuitarServiciosPaquete($id_servicio_paquete);
    }

    public function EditarServiciosPaquete($id_servicios_paquete, $cantidad_servicios, $valor_unitario_servicio, $porcentaje_admin)
    {
        $auto = new ModelServicios();
        return $auto->EditarServiciosPaquete($id_servicios_paquete, $cantidad_servicios, $valor_unitario_servicio, $porcentaje_admin);
    }

    public function VerServiciosEditDelete($id_Paquete)//Administrador
    {
        $Render = new Visual();
        $edit   = new ModelServicios();
        $Datos  = $edit->ServiciosXPaqueteEdit($id_Paquete);
        $Res    = array ();
        foreach ($Datos as $Temp)
        {
            $Temp['Edit']   = $Render->GenerardorLink('', 'Editar(' . $Temp['Edit'] . ')', 'images/lapiz.png');
            $Temp['Delete'] = $Render->GenerardorLink('', 'Eliminar(' . $Temp['Delete'] . ')', 'images/recycle.png');
            $Res[]          = $Temp;
        }
        return ($Res);
    }

    public function Servicio_Paquete($id_servicio_paquete)
    {
        $auto = new ModelServicios();
        return $auto->Servicios_Paquete($id_servicio_paquete);
    }

    public function NuevoServicio($Cod_proveedor, $Nombre_Servicio, $Valor)
    {
        $Proveedor = new Proveedor();
        $Servicios = new ModelServicios();
        $Datos     = $Proveedor->InfoProveedor($Cod_proveedor);
        $id        = $Servicios->NuevoServicio($Nombre_Servicio, $Datos['id_proveedor'], $Valor);
        return $id;
    }

}
