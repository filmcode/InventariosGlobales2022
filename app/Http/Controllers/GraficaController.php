<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class GraficaController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver-tabla')->only('index');
    }
    
    public function index()
    {
        return view('grafica.index');
    }
    public function ajaxGrafica(Request $request)
    {
        // estadisticas de usuarios
        if ($request->status == 'searchCarros') {
            $users = DB::table('users')->get();
            $labels = [];
            $datos = [];
            foreach ($users as $user) {
                $label = DB::table('productos')->where('user_id', $user->id)->count();
                $labels[] = $user->name;
                $datos[] = $label;
            }
            return json_encode([
                "labels" => $labels,
                "datos" => $datos,
                "bg" => ['#007bff']
            ]);
        } else if($request->status == 'status') {
            $estados = ['pendiente', 'buscando', 'encontrado','incompleta'];
            $labels = [];
            $datos = [];
            foreach ($estados as $estado) {
                $label = DB::table('productos')->where('estatus', $estado)->count();
                $labels[] = $estado;
                $datos[] = $label;
            }
            return json_encode([
                "labels" => $labels,
                "datos" => $datos,
                "bg" => ['#E03C32','#FFD301','#7BB662', '#7BB662']
            ]);
        }else if ($request->status == 'intercambio') {
            $products = DB::table('productos')->select('id', 'linea','intercambio', 'created_at')->whereNotNull('intercambio')->get();
            return view('grafica.intercambio',compact('products'));
        }else if ($request->status == 'filterSearch') {
            $products = DB::table('productos')->whereBetween('created_at', [$request->dateDe, $request->dateA])->whereNotNull('intercambio')->get();
            return $products;
        }
    }
}