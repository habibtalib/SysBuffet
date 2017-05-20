<?php

namespace App\Models;
use App\Models\DetalleEgreso;
use App\Models\DetalleIngreso;


class Balanceador 
{

	public $fechaInicio = null;
	public $fechaFin = null;

	public function __construct($fechaCom, $fechaF)
	{
		$this->fechaInicio = $fechaCom;
		$this->fechaFin = $fechaF;
	}

	public function balancearPorFechas()
	{
		$gastosPorFecha = DetalleEgreso::recuperarGastosPorFecha($this->fechaInicio, $this->fechaFin);
		$ventasPorFecha = DetalleIngreso::recuperarVentasPorFecha($this->fechaInicio, $this->fechaFin);
		return $balancePorFecha = $this->calcularBalancePorFechas($gastosPorFecha, $ventasPorFecha);
	}

	public function balancearPorProductos()
	{
		return $ventasPorProducto = DetalleIngreso::recuperarVentasPorProducto($this->fechaInicio, $this->fechaFin);
	}

	public function calcularBalancePorFechas($gastosTotales, $ventasTotales)
	{
		$gastosTotalesPl = $gastosTotales->pluck('sum(precio_total)', 'fecha');
		$balances = collect([]);
		foreach($ventasTotales as $venta){
			if($gastosTotalesPl->has($venta->fecha)){
				$venta['sum(precio_total)'] = $venta['sum(precio_total)'] - $gastosTotalesPl[$venta->fecha];
			}
			$balances[$venta->fecha] = $venta['sum(precio_total)'];
		}
		foreach($gastosTotales as $gasto){
			if(!$balances->has($gasto->fecha)) $balances[$gasto->fecha] = 0 - $gasto['sum(precio_total)'];
		}
		return $balances;
	}
}