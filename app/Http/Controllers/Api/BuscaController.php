<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BuscaController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $request->validate(['q' => 'required|string|min:2']);

        $resultados = Conteudo::publicados()
            ->where('titulo', 'like', '%' . $request->q . '%')
            ->orWhere('resumo', 'like', '%' . $request->q . '%')
            ->take(20)
            ->get();

        return response()->json($resultados);
    }
}
