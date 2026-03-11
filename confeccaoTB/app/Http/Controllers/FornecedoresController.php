<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    public function index() {
    $Fornecedores = \App\Models\Fornecedores::all();
    return view("Fornecedores.index", compact ('Fornecedores'));
}
}
