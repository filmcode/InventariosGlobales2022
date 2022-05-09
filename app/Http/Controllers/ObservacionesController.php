<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Observaciones;


class ObservacionesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver-tabla')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $observacion = DB::table('observaciones')->orderByDesc('id')->where('id_api','=',$id)->first();
        if ($observacion) {
            return view('observaciones.editar', compact('observacion','id'));
        } else {
            return view('observaciones.crear', compact('id'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id_api)
    {
        $request->merge(['id_api'=>$id_api]);
        $observacion = Observaciones::create($request->all());
        return redirect()->route('carros.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //   
    }

    public function update(Request $request, $id_api)
    {
        $observacion = Observaciones::where('id_api', $id_api)
                                    ->update(['descripcion' => $request->input('descripcion')]);
        return redirect()->route('carros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // 
    }
}