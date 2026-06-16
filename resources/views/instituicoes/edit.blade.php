@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Editar instituição</h1>
        
    </div>
    <a href="/instituicoes" class="btn-outline-custom">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="section-card" style="max-width:560px">
    <div class="section-head">
        <h2><i class="bi bi-building-gear" style="margin-right:6px;color:var(--orange)"></i>Dados da instituição</h2>
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

        <form method="POST" action="{{ route('instituicoes.update', $instituicao) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Nome</label>
                <input
                    class="form-control"
                    name="nome"
                    placeholder="Ex: E.E. Castro Alves"
                    value="{{ old('nome', $instituicao->nome) }}"
                    required>
            </div>

            <div style="margin-bottom:1.5rem">
                <label class="form-label-custom">Endereço</label>
                <input
                    class="form-control"
                    name="endereco"
                    placeholder="Ex: Rua das Flores, 123 — Ituporanga"
                    value="{{ old('endereco', $instituicao->endereco) }}">
            </div>

            <div style="display:flex; gap:8px;">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-check-lg"></i> Atualizar instituição
                </button>
                <a href="/instituicoes" class="btn-outline-custom">Cancelar</a>
            </div>

        </form>
    </div>
</div>

@endsection
