<?php

namespace App\Http\Controllers;
use App\Barrio;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;


class BarrioController extends Controller
{
    //
    public function buscarJson(Request $request)
    {
        $search = $_GET['search'];

        $barrios = Barrio::select()
                ->where('nombre_barrio', 'LIKE', '%'.$search.'%')
                ->get();

        return response()->json($barrios);

    }
}
