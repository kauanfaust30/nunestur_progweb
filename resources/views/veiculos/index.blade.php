@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Veículos</h1>
        
    </div>
    <a href="/veiculos/create" class="btn-orange">
        <i class="bi bi-plus-lg"></i> Novo veículo
    </a>
</div>

<div class="section-card">

    <div class="section-head">
        <h2>Lista de veículos</h2>
        <form method="GET" action="/veiculos" style="margin:0">
            <div class="toolbar">
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input name="busca" placeholder="Buscar veículo..." value="{{ request('busca') }}">
                </div>
                <button type="submit" class="btn-outline-custom">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </div>
        </form>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Placa</th>
                <th>Capacidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($veiculos as $veiculo)
            <tr>
                <td>
                    <div class="name-cell">
                        <div class="avatar" style="background:#eaf3de;color:#3b6d11;border-radius:8px">
                            <i class="bi bi-truck" style="font-size:13px"></i>
                        </div>
                        <span style="font-weight:500">{{ $veiculo->modelo }}</span>
                    </div>
                </td>
                <td>
                    <span class="badge-custom badge-blue">{{ $veiculo->tipo }}</span>
                </td>
                <td style="color:var(--text-muted); font-family:monospace; letter-spacing:.05em">
                    {{ $veiculo->placa }}
                </td>
                <td style="color:var(--text-muted)">
                    <i class="bi bi-people" style="margin-right:4px"></i>{{ $veiculo->capacidade }} lugares
                </td>
                <td style="white-space:nowrap">
                    <div class="toolbar" style="justify-content:flex-end; flex-wrap:nowrap">
                        <a href="/veiculos/{{ $veiculo->id }}/edit" class="btn-outline-custom">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form method="POST" action="/veiculos/{{ $veiculo->id }}" style="margin:0"
                              onsubmit="return confirmDelete(this, 'Tem certeza que deseja excluir o veículo {{ $veiculo->modelo }}? Essa ação não pode ser desfeita.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger-outline">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:2rem; color:var(--text-muted)">
                    <i class="bi bi-truck" style="font-size:2rem; display:block; margin-bottom:.5rem; opacity:.3"></i>
                    Nenhum veículo encontrado.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection