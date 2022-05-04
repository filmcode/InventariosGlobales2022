<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\ProductImage;

// Emails
use App\Mail\NotificationCars;
use Illuminate\Support\Facades\Mail;

class ProductoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-busqueda|crear-busqueda|editar-busqueda|borrar-busqueda')->only('index');
        $this->middleware('permission:crear-busqueda', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-busqueda', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-busqueda', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->has('dateDe') && $request->has('dateA') && 
        !empty($request->dateDe) && !empty($request->dateA)) {
            $products = DB::table('productos')->whereBetween('created_at', [$request->dateDe, $request->dateA])->whereNotNull('intercambio')->paginate(5);
            $productsImages = DB::table('product_images')->get();
            $date = [
                "dateDe" => $request->dateDe,
                "dateA" => $request->dateA,
            ];
            return view('productos.index',compact('products','productsImages', 'date'));
        } else {
            
            $products = DB::table('productos')->paginate(5);
            $productsImages = DB::table('product_images')->get();
            $date = [
                "dateDe" => "",
                "dateA" => "",
            ];
            return view('productos.index',compact('products','productsImages', 'date'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.crear');                                                                                                                                                                     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataCars = $request->validate([
            'linea' => 'required', 'intercambio' => ' ', 'catalogo' => 'required', 'modelo' => 'required', 'serie' => 'required', 'color' => 'required', 'ubicacion' => 'required', 'costo' => 'required', 'estatus' => ' ', 'observaciones' => ' ','apartado' => ' ' 
        ]);
        
        if ($request->file('files')) {
            $user_id = Auth::id();
            $request->merge(['user_id' => $user_id]);
            $product = Producto::create($request->all());
        }else {
            $product = false;
        }
        if ($product) {
            $max_size = (int)ini_get('upload_max_filesize') * 10240;
            $files = $request->file('files');
            foreach ($files as $file) {
                $uuid = Str::uuid()->toString();
                $imageName = $uuid . "." . $file->getClientOriginalExtension();
                if ($file->move('img/', $imageName)) {
                    ProductImage::create([
                        'name' => $imageName,
                        'product_id' => $product->id
                    ]);
                }
            }
            $correo = new NotificationCars($product);
            Mail::to('gustavojaimes1993@gmail.com')->queue($correo);
            return redirect()->route('productos.index');
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $productsImages = DB::table('product_images')->where('product_id','=', $producto['id'])->get();
        return view('productos.editar', compact('producto', 'productsImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'linea' => 'required', 'intercambio' => ' ', 'catalogo' => 'required', 'modelo' => 'required', 'serie' => 'required', 'color' => 'required', 'ubicacion' => 'required', 'costo' => 'required', 'estatus' => ' ', 'observaciones' => ' ', 'apartado' => ' '
        ]);
        $product = $producto->update($request->all());
        if ($request->file('files')) {
            $productsImages = DB::table('product_images')->where('product_id','=', $producto['id'])->get();
            foreach ($productsImages as $image => $value) {
                unlink("img/" . $value->name);
            }
            $delImages = DB::table('product_images')->where('product_id','=', $producto['id'])->delete();
            if ($delImages) {
                $max_size = (int)ini_get('upload_max_filesize') * 10240;
                $files = $request->file('files');
                foreach ($files as $file) {
                    $uuid = Str::uuid()->toString();
                    $imageName = $uuid . "." . $file->getClientOriginalExtension();
                    if ($file->move('img/', $imageName)) {
                        ProductImage::create([
                            'name' => $imageName,
                            'product_id' => $producto->id
                        ]);
                    }
                }
            }
        }
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $productsImages = DB::table('product_images')->where('product_id','=', $producto['id'])->get();
        foreach ($productsImages as $image => $value) {
            unlink("img/" . $value->name);
        }
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
