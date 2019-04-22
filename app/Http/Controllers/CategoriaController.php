<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Categoria;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Si no es un request de ajax no hacemos nada por seguridad
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar=='') {
            //Creando un array de tipo Categoria(model)
            $categorias = Categoria::orderBy('id', 'desc')->paginate(4);
        }
        else {
            $categorias = Categoria::where($criterio, 'like', '%' . $buscar . '%' )->orderBy('id', 'desc')->paginate(4);
        }

        return[
            'pagination' => [
                'total'        => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page'     => $categorias->perPage(),
                'last_page'    => $categorias->lastPage(),
                'from'         => $categorias->firstItem(),
                'to'           => $categorias->lastItem(),
            ],
            'categorias' => $categorias
        ];
    }


    public function selectCategoria(Request $request){
        if(!$request->ajax()) return redirect('/');
        $categorias = Categoria::where('condicion', '=', '1')
        ->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return ['categorias' => $categorias];   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Si no es un request de ajax no hacemos nada por seguridad
        if(!$request->ajax()) return redirect('/');
        //Creando un objeto de tipo categoria(model)
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Si no es un request de ajax no hacemos nada por seguridad
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        //Si no es un request de ajax no hacemos nada por seguridad
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function activar(Request $request)
    {
        //Si no es un request de ajax no hacemos nada por seguridad
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '1';
        $categoria->save();
    }



}
