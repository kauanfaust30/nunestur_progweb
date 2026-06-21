@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Instituições</h1>
        
    </div>
    <a href="/instituicoes/create" class="btn-orange">
        <i class="bi bi-plus-lg"></i> Nova instituição
    </a>
</div>

<div class="section-card">

    <div class="section-head">
        <h2>Lista de instituições</h2>
        <form method="GET" action="/instituicoes" style="margin:0">
            <div class="toolbar">
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input name="busca" placeholder="Buscar instituição..." value="{{ request('busca') }}">
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
                <th>Nome</th>
                <th>Endereço</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($instituicoes as $i)
            <tr>
                <td>
                    <div class="name-cell">
                        <div class="avatar" style="background:#e6f1fb;color:#185fa5;border-radius:8px">
                            <i class="bi bi-building" style="font-size:13px"></i>
                        </div>
                        <span style="font-weight:500">{{ $i->nome }}</span>
                    </div>
                </td>
                <td style="color:var(--text-muted)">{{ $i->endereco ?? '—' }}</td>
                <td style="white-space:nowrap">
                    <div class="toolbar" style="justify-content:flex-end; flex-wrap:nowrap">
                        <a href="/instituicoes/{{ $i->id }}/edit" class="btn-outline-custom">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form method="POST" action="/instituicoes/{{ $i->id }}" style="margin:0"
                              onsubmit="return confirmDelete(this, 'Tem certeza que deseja excluir a instituição {{ $i->nome }}? Essa ação não pode ser desfeita.')">
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
                <td colspan="3" style="text-align:center; padding:2rem; color:var(--text-muted)">
                    <i class="bi bi-building" style="font-size:2rem; display:block; margin-bottom:.5rem; opacity:.3"></i>
                    Nenhuma instituição encontrada.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection