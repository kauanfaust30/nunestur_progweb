@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Alunos</h1>
        
    </div>
    <a href="/alunos/create" class="btn-orange">
        <i class="bi bi-plus-lg"></i> Novo aluno
    </a>
</div>

<div class="section-card">

    <div class="section-head">
        <h2>Lista de alunos</h2>
        <form method="GET" action="/alunos" style="margin:0">
            <div class="toolbar">
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input name="busca" placeholder="Buscar aluno..." value="{{ request('busca') }}">
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
                <th>E-mail</th>
                <th>Telefone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($alunos as $aluno)
            <tr>
                <td>
                    <div class="name-cell">
                        <div class="avatar">
                            {{ strtoupper(substr($aluno->nome, 0, 1)) }}{{ strtoupper(substr(strrchr($aluno->nome, ' '), 1, 1)) }}
                        </div>
                        {{ $aluno->nome }}
                    </div>
                </td>
                <td style="color:var(--text-muted)">{{ $aluno->email }}</td>
                <td style="color:var(--text-muted)">{{ $aluno->telefone ?? '—' }}</td>
                <td style="white-space:nowrap">
                    <div class="toolbar" style="justify-content:flex-end; flex-wrap:nowrap">
                        <a href="/alunos/{{ $aluno->id }}/edit" class="btn-outline-custom">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form method="POST" action="/alunos/{{ $aluno->id }}" style="margin:0"
                              onsubmit="return confirmDelete(this, 'Tem certeza que deseja excluir o aluno {{ $aluno->nome }}? Essa ação não pode ser desfeita.')">
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
                <td colspan="4" style="text-align:center; padding:2rem; color:var(--text-muted)">
                    <i class="bi bi-people" style="font-size:2rem; display:block; margin-bottom:.5rem; opacity:.3"></i>
                    Nenhum aluno encontrado.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="table-footer">
        <span>{{ $alunos->total() }} aluno(s) encontrado(s)</span>
        <div class="pagination-btns">
            @if($alunos->onFirstPage())
                <button class="page-btn" disabled><i class="bi bi-chevron-left"></i></button>
            @else
                <a href="{{ $alunos->previousPageUrl() }}" class="page-btn"><i class="bi bi-chevron-left"></i></a>
            @endif

            @foreach($alunos->getUrlRange(1, $alunos->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="page-btn {{ $page == $alunos->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($alunos->hasMorePages())
                <a href="{{ $alunos->nextPageUrl() }}" class="page-btn"><i class="bi bi-chevron-right"></i></a>
            @else
                <button class="page-btn" disabled><i class="bi bi-chevron-right"></i></button>
            @endif
        </div>
    </div>

</div>

@endsection