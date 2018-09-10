<?php

namespace App\Http\Controllers;
use App\Ciudad;


use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

class CiudadController extends Controller
{
    //

    public function buscarJson(Request $request)
    {
        $search = $_GET['search'];

        $productos = Ciudad::select()
                ->where('nombre_ciudad', 'LIKE', '%'.$search.'%')
                ->get();

        return response()->json($productos);

    }
}
