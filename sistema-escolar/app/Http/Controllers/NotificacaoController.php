<?php

namespace App\Http\Controllers;
 
use App\Models\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class NotificacaoController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
 
        $notificacoes = $user->notificacoes()
            ->with('ocorrencia.aluno')
            ->latest()
            ->paginate(20);
 
        // Marca todas como lidas ao acessar a página
        $user->notificacoesNaoLidas()->update([
            'lida'    => true,
            'lida_em' => now(),
        ]);
 
        return view('notificacoes.index', compact('notificacoes'));
    }
 
    public function marcarLida(Notificacao $notificacao)
    {
        if ($notificacao->usuario_id !== Auth::id()) {
            abort(403);
        }
 
        $notificacao->marcarComoLida();
 
        return response()->json(['success' => true]);
    }
 
    public function contarNaoLidas()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $count = $user->notificacoesNaoLidas()->count();
 
        return response()->json(['count' => $count]);
    }
}