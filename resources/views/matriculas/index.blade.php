@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Matrículas</h1>
        
    </div>
    <a href="/matriculas/create" class="btn-orange">
        <i class="bi bi-plus-lg"></i> Nova matrícula
    </a>
</div>

<div class="section-card">

    <div class="section-head">
        <h2>Lista de matrículas</h2>
        <span class="badge-custom badge-blue">{{ count($matriculas) }} cadastradas</span>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Instituição</th>
                <th>Veículo</th>
                <th>Turno</th>
                <th>Valor subsídio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($matriculas as $m)
            <tr>
                <td>
                    <div class="name-cell">
                        <div class="avatar">
                            {{ strtoupper(substr($m->aluno->nome, 0, 1)) }}{{ strtoupper(substr(strrchr($m->aluno->nome, ' '), 1, 1)) }}
                        </div>
                        {{ $m->aluno->nome }}
                    </div>
                </td>
                <td style="color:var(--text-muted)">{{ $m->instituicao->nome }}</td>
                <td style="color:var(--text-muted)">{{ $m->veiculo->modelo }}</td>
                <td>
                    @if($m->turno === 'Matutino')
                        <span class="badge-custom badge-amber">{{ $m->turno }}</span>
                    @elseif($m->turno === 'Vespertino')
                        <span class="badge-custom badge-blue">{{ $m->turno }}</span>
                    @else
                        <span class="badge-custom badge-gray">{{ $m->turno }}</span>
                    @endif
                </td>
                <td style="font-weight:500">
                    R$ {{ number_format($m->valor_subsidio, 2, ',', '.') }}
                </td>
                <td style="white-space:nowrap">
                    <div class="toolbar" style="justify-content:flex-end; flex-wrap:nowrap">
                        <a href="{{ route('matriculas.edit', $m) }}" class="btn-outline-custom">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form method="POST" action="{{ route('matriculas.destroy', $m) }}" style="margin:0" onsubmit="return confirm('Excluir matrícula de {{ $m->aluno->nome }}?')">
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
                <td colspan="6" style="text-align:center; padding:2rem; color:var(--text-muted)">
                    <i class="bi bi-clipboard-x" style="font-size:2rem; display:block; margin-bottom:.5rem; opacity:.3"></i>
                    Nenhuma matrícula cadastrada.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
