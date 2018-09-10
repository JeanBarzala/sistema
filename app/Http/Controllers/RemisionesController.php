<?php

namespace App\Http\Controllers;

use App\Remision;


use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RemisionesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $remisiones = Remision::orderBy('id_remision', 'DESC')->paginate(15);
        return view('remisiones.index', compact('remisiones'));
    }
}
