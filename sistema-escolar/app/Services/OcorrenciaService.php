<?php 

namespace App\Services;
 
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
 
class OcorrenciaService
{
    public function __construct(private NotificacaoService $notificacaoService)
    {
    }
 
    /**
     * Registra uma nova ocorrência
     */
    public function registrar(array $dados): Ocorrencia
    {
        return DB::transaction(function () use ($dados) {
            $horario = $dados['horario'];
            unset($dados['horario']);

            $teraFalta = filter_var($dados['tera_falta'], FILTER_VALIDATE_BOOLEAN);
            $dados['tera_falta'] = $teraFalta;
            $dados['aulas_falta'] = $teraFalta ? $dados['aulas_falta'] : null;

            $ocorrencia = Ocorrencia::create([
                ...$dados,
                'aqv_id'           => Auth::id(),
                'data_ocorrencia'  => Carbon::today()->setTimeFromTimeString($horario),
                'status'           => 'pendente',
            ]);
 
            return $ocorrencia;
        });
    }
 
    /**
     * Aprova uma ocorrência e envia notificações
     */
    public function aprovar(Ocorrencia $ocorrencia): void
    {
        DB::transaction(function () use ($ocorrencia) {
            $ocorrencia->update([
                'status'           => 'aprovado',
                'data_autorizacao' => now(),
            ]);
 
            // Notifica portaria
            /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $portarias */
            $portarias = User::where('role', 'portaria')->get();
            foreach ($portarias as $portaria) {
                $this->notificacaoService->enviar(
                    ocorrencia: $ocorrencia,
                    usuario: $portaria,
                    titulo: "Nova autorização: {$ocorrencia->aluno->nome}",
                    mensagem: "O aluno {$ocorrencia->aluno->nome} (RM: {$ocorrencia->aluno->rm}) teve sua {$ocorrencia->tipoLabel()} autorizada."
                );
            }
 
            if ($ocorrencia->professor) {
                $falta = $ocorrencia->tera_falta
                    ? "O aluno terá falta em {$ocorrencia->aulas_falta} aula(s)."
                    : 'O aluno não terá falta registrada.';

                $this->notificacaoService->enviar(
                    ocorrencia: $ocorrencia,
                    usuario: $ocorrencia->professor,
                    titulo: "Aluno com {$ocorrencia->tipoLabel()}: {$ocorrencia->aluno->nome}",
                    mensagem: "O aluno {$ocorrencia->aluno->nome} (Turma: {$ocorrencia->aluno->turma}) teve {$ocorrencia->tipoLabel()} autorizada. {$falta} Motivo: {$ocorrencia->motivo}"
                );
            }
        });
    }
 
    /**
     * Nega uma ocorrência
     */
    public function negar(Ocorrencia $ocorrencia): void
    {
        $ocorrencia->update([
            'status'           => 'negado',
            'data_autorizacao' => now(),
        ]);
    }
 
    /**
     * Portaria confirma a entrada/saída física
     */
    public function confirmarPortaria(Ocorrencia $ocorrencia): void
    {
        $ocorrencia->update([
            'confirmacao_portaria' => now(),
            'portaria_id'          => Auth::id(),
        ]);
    }
}
