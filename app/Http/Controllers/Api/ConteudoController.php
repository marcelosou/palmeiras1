<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ConteudoController extends Controller
{
    public function home(): JsonResponse
    {
        return response()->json([
            'destaques' => Conteudo::publicados()->latest('publicado_em')->take(5)->get(),
            'noticias'  => Conteudo::publicados()->where('tipo', 'noticia')->take(10)->get(),
            'eventos'   => Conteudo::publicados()->where('tipo', 'evento')->take(6)->get(),
        ]);
    }

    public function index(Request $request): JsonResponse
    {
        $noticias = Conteudo::with(['autor'])
            ->publicados()
            ->where('tipo', 'noticia')
            ->latest('publicado_em')
            ->paginate(12);

        return response()->json($noticias);
    }

    public function show(string $slug): JsonResponse
    {
        $conteudo = Conteudo::with(['autor', 'blocos'])
            ->where('slug', $slug)
            ->publicados()
            ->firstOrFail();

        $conteudo->increment('visualizacoes');

        return response()->json($conteudo);
    }

    public function eventos(): JsonResponse
    {
        $eventos = Conteudo::publicados()
            ->where('tipo', 'evento')
            ->orderBy('publicado_em')
            ->paginate(12);

        return response()->json($eventos);
    }
}
