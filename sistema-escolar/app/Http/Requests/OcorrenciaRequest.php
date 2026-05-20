<?php
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
 
class OcorrenciaRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        return $user?->isAqv() ?? false;
    }
 
    public function rules(): array
    {
        return [
            'aluno_id'    => 'required|exists:alunos,id',
            'professor_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'professor'),
            ],
            'tipo'        => 'required|in:entrada_atrasada,saida_antecipada',
            'horario'     => 'required|date_format:H:i',
            'tera_falta'  => 'required|boolean',
            'aulas_falta' => 'nullable|required_if:tera_falta,1|integer|min:1|max:12',
            'motivo'      => 'required|string|max:1000',
            'observacao'  => 'nullable|string|max:1000',
        ];
    }
 
    public function messages(): array
    {
        return [
            'aluno_id.required' => 'Selecione o aluno.',
            'aluno_id.exists'   => 'Aluno não encontrado.',
            'professor_id.required' => 'Selecione o professor que receberá a notificação.',
            'professor_id.exists' => 'Professor não encontrado.',
            'tipo.required'     => 'Selecione o tipo de ocorrência.',
            'tipo.in'           => 'Tipo inválido.',
            'horario.required'  => 'Informe o horário.',
            'horario.date_format' => 'Informe um horário válido.',
            'tera_falta.required' => 'Informe se o aluno terá falta.',
            'aulas_falta.required_if' => 'Informe quantas aulas o aluno terá falta.',
            'aulas_falta.integer' => 'A quantidade de aulas deve ser um número.',
            'aulas_falta.min' => 'Informe pelo menos 1 aula.',
            'aulas_falta.max' => 'Informe no máximo 12 aulas.',
            'motivo.required'   => 'Informe o motivo.',
        ];
    }
}
