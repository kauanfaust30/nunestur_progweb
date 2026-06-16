@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Editar matrícula</h1>
        
    </div>
    <a href="/matriculas" class="btn-outline-custom">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="section-card" style="max-width:560px">
    <div class="section-head">
        <h2><i class="bi bi-clipboard-check" style="margin-right:6px;color:var(--orange)"></i>Dados da matrícula</h2>
    </div>

    <div class="section-body">

        @if($errors->any())
            <div class="alert-custom alert-danger-custom" style="margin-bottom:1.25rem">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('matriculas.update', $matricula) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Aluno</label>
                <select name="aluno_id" class="form-control" required>
                    <option value="">Selecione um aluno...</option>
                    @foreach($alunos as $a)
                        <option value="{{ $a->id }}" {{ old('aluno_id', $matricula->aluno_id) == $a->id ? 'selected' : '' }}>
                            {{ $a->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Instituição</label>
                <select name="instituicao_id" class="form-control" required>
                    <option value="">Selecione uma instituição...</option>
                    @foreach($instituicoes as $i)
                        <option value="{{ $i->id }}" {{ old('instituicao_id', $matricula->instituicao_id) == $i->id ? 'selected' : '' }}>
                            {{ $i->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Veículo</label>
                <select name="veiculo_id" class="form-control" required>
                    <option value="">Selecione um veículo...</option>
                    @foreach($veiculos as $v)
                        <option value="{{ $v->id }}" {{ old('veiculo_id', $matricula->veiculo_id) == $v->id ? 'selected' : '' }}>
                            {{ $v->modelo }} — {{ $v->placa }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Turno</label>
                <select name="turno" class="form-control" required>
                    <option value="">Selecione um turno...</option>
                    <option value="Matutino" {{ old('turno', $matricula->turno) == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                    <option value="Vespertino" {{ old('turno', $matricula->turno) == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                    <option value="Noturno" {{ old('turno', $matricula->turno) == 'Noturno' ? 'selected' : '' }}>Noturno</option>
                </select>
            </div>

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Frequência semanal (dias)</label>
                <input
                    class="form-control"
                    name="frequencia_semanal"
                    type="number"
                    min="1"
                    max="7"
                    placeholder="Ex: 5"
                    value="{{ old('frequencia_semanal', $matricula->frequencia_semanal) }}">
            </div>

            <div style="margin-bottom:1.5rem">
                <label class="form-label-custom">Dias da semana</label>
                <input
                    class="form-control"
                    name="dias_semana"
                    placeholder="Ex: Segunda, Quarta, Sexta"
                    value="{{ old('dias_semana', $matricula->dias_semana) }}">
            </div>

            <div style="display:flex; gap:8px;">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-check-lg"></i> Atualizar matrícula
                </button>
                <a href="/matriculas" class="btn-outline-custom">Cancelar</a>
            </div>

        </form>
    </div>
</div>

@endsection
