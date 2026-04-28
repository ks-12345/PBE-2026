<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarvelController extends Controller
{
    public function index()
    {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,flags,population,region,capital,languages');

        if ($response->successful()) {
            $paises = $response->json();
            $dados = [$paises[array_rand($paises)]];
            return view('paises', compact('dados'));
        }

        return response()->json(['error' => 'Erro na API'], 500);
    }
}