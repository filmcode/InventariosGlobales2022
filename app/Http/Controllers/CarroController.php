<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Carro;
use  GuzzleHttp\Client;

use App\Models\Estado;



class CarroController extends Controller
{
    private $client;
    private $token;

    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client(['base_uri' => 'https://isapi.intelisis-solutions.com']);
        $this->token = $this->getTokenApi();
    }
    
    public function getTokenApi(){

        $response = $this->client->request('POST', '/auth/', [
            'form_params' => [
                'username' => 'TEST001',
                'password' => 'intelisis'
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        return $result['token'];
    }

    public function index()
    {
        $response = $this->client->request('POST', '/api/VehicleInv/', [
            'headers' => [
                'Authorization' => 'Token ' . $this->token
            ],
            'form_params' => [
                'dealerid' => '31',
                'condicion' => 'Todos'
            ]
        ]);

        $carros = json_decode($response->getBody(), true);
        // $carros = $carrosJson['data'];
        $estados = DB::table('estados')->orderBy('id','DESC')->get();
        $observaciones = DB::table('observaciones')->orderBy('id','DESC')->get();
        return view('carro.index', compact('estados','observaciones','carros'))->with('CarroController', $this);
        // return '<pre>'.
        //         print_r($carros['data']).
        //         '</pre>';
    }

    public function Horas($date_start, $options = 0) {
        $date_final = date_create_from_format('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        // $date_final = date_create_from_format('Y-m-d H:i:s', '2022-05-01 2:09:00');
        $interval = (array) date_diff($date_start, $date_final);
    
        // extraer datos de interval
        $date_y = $interval['y'];
        $date_m = $interval['m'];
        $date_d = ($interval['d'] * 1440);
        $date_h = ($interval['h'] * 60);
        $date_i = $interval['i'];
        $date_s = ($interval['s'] / 60);
        // echo '<pre>';
        // print_r($interval);
        // echo '</pre>';
        $tiempo = ($date_d+$date_h+$date_i+$date_s);
        
        // options
        if($options == 2) {
            return floor($tiempo / 60);
        }else {
            if ($tiempo >= 4320) {
                return 0;
            } elseif ($date_y > 0 || $date_m > 0) {
                 return 0;
            } else {
                 return 1;
            }
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'hola';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxEstado(Request $request)
    {
        $result =  Estado::create($request->all());
        if ($result) {
            return 1;
        } else {
            return 0;
        }
        
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
