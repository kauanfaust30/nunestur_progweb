@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Cadastrar veículo</h1>
        
    </div>
    <a href="/veiculos" class="btn-outline-custom">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="section-card" style="max-width:560px">
    <div class="section-head">
        <h2><i class="bi bi-truck" style="margin-right:6px;color:var(--orange)"></i>Dados do veículo</h2>
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

        <form method="POST" action="/veiculos">
            @csrf

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Modelo</label>
                <input
                    class="form-control"
                    name="modelo"
                    placeholder="Ex: Mercedes Sprinter"
                    value="{{ old('modelo') }}"
                    required>
            </div>

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Tipo</label>
                <input
                    class="form-control"
                    name="tipo"
                    placeholder="Ex: Van, Ônibus, Micro-ônibus"
                    value="{{ old('tipo') }}"
                    required>
            </div>

            <div style="margin-bottom:1rem">
                <label class="form-label-custom">Placa</label>
                <input
                    class="form-control"
                    name="placa"
                    placeholder="Ex: ABC-1234"
                    value="{{ old('placa') }}"
                    required>
            </div>

            <div style="margin-bottom:1.5rem">
                <label class="form-label-custom">Capacidade (lugares)</label>
                <input
                    class="form-control"
                    name="capacidade"
                    type="number"
                    min="1"
                    placeholder="Ex: 15"
                    value="{{ old('capacidade') }}"
                    required>
            </div>

            <div style="display:flex; gap:8px;">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-check-lg"></i> Salvar veículo
                </button>
                <a href="/veiculos" class="btn-outline-custom">Cancelar</a>
            </div>

        </form>
    </div>
</div>

@endsection
