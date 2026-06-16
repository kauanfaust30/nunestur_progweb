@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Cadastrar aluno</h1>
        
    </div>
    <a href="/alunos" class="btn-outline-custom">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="section-card" style="max-width: 560px;">
    <div class="section-head">
        <h2><i class="bi bi-person-plus" style="margin-right:6px;color:var(--orange)"></i>Dados do aluno</h2>
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

        <form method="POST" action="/alunos">
            @csrf

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Nome completo</label>
                <input
                    class="form-control"
                    name="nome"
                    placeholder="Ex: Ana Silva"
                    value="{{ old('nome') }}"
                    required>
            </div>

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Telefone</label>
                <input
                    class="form-control"
                    name="telefone"
                    placeholder="Ex: (47) 99999-0000"
                    value="{{ old('telefone') }}">
            </div>

            <div style="margin-bottom:1.5rem">
                <label class="form-label-custom">E-mail</label>
                <input
                    class="form-control"
                    name="email"
                    type="email"
                    placeholder="Ex: ana@email.com"
                    value="{{ old('email') }}">
            </div>

            <div style="display:flex; gap:8px;">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-check-lg"></i> Salvar aluno
                </button>
                <a href="/alunos" class="btn-outline-custom">Cancelar</a>
            </div>

        </form>
    </div>
</div>

@endsection
