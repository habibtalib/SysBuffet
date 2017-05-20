<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BalanceRequest;
use App\Models\Balanceador;

class BalanceController extends Controller
{
   	
	public function __construct()
	{
		$this->middleware('administrador');
	}

	public function mostrarFechas()
	{
		return view('balance.lista-fechas');
	}

	public function entregarBalance(BalanceRequest $request)
	{
		$balances = collect([]);
		$balanceador = new Balanceador($request['fecha_inicio'], $request['fecha_fin']);
		$balances['fechas'] = $balanceador->balancearPorFechas('2017-05-01','2017-05-30');
		$balances['productos'] = $balanceador->balancearPorProductos('2017-05-01','2017-05-30');
		return view('balance.mostrar-balance', ['balances' => $balances, 'fecha_inicio' => $request['fecha_inicio'], 'fecha_fin' => $request['fecha_fin']]);
	}

}
