<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lugar;
use Illuminate\Http\JsonResponse;

class TurismoController extends Controller
{
    public function index(): JsonResponse
    {
        $lugares = Lugar::with('conteudosRelacionados')->get();

        return response()->json($lugares);
    }
}
