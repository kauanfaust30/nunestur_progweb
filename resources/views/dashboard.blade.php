@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        
    </div>
</div>


<div class="stats-grid">

    <div class="stat-card">
        <div class="label"><i class="bi bi-people"></i> Total de Alunos</div>
        <div class="value">{{ $totalAlunos }}</div>
        <div class="note">cadastrados</div>
    </div>

    <div class="stat-card">
        <div class="label"><i class="bi bi-clipboard-check"></i> Matrículas Ativas</div>
        <div class="value">{{ $totalMatriculasAtivas }}</div>
        <div class="note">de {{ $totalMatriculas }} matrículas</div>
    </div>

    <div class="stat-card">
        <div class="label"><i class="bi bi-cash-stack"></i> Valor Total / Mês</div>
        <div class="value" style="font-size:1.4rem">R$ {{ number_format($valorTotalMensal, 2, ',', '.') }}</div>
        <div class="note">subsídio ativo</div>
    </div>

    <div class="stat-card">
        <div class="label"><i class="bi bi-truck"></i> Veículos</div>
        <div class="value">{{ $totalVeiculos }}</div>
        <div class="note">na frota</div>
    </div>

    <div class="stat-card">
        <div class="label"><i class="bi bi-building"></i> Instituições</div>
        <div class="value">{{ $totalInstituicoes }}</div>
        <div class="note">atendidas</div>
    </div>

</div>


<div class="section-card">
    <div class="section-head">
        <h2>Matrículas de Transporte</h2>
        <a href="{{ route('relatorio.pdf') }}" class="btn-orange" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i>
            Gerar Relatório PDF
        </a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Instituição</th>
                <th>Turno</th>
                <th>Dias da Semana</th>
                <th>Freq. Semanal</th>
                <th>Valor Subsídio</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matriculas as $m)
            <tr>
                <td>
                    <div class="name-cell">
                        <span class="avatar">
                            {{ strtoupper(substr($m->aluno->nome, 0, 1)) }}{{ strtoupper(substr(strstr($m->aluno->nome, ' '), 1, 1)) }}
                        </span>
                        <strong>{{ $m->aluno->nome }}</strong>
                    </div>
                </td>
                <td>{{ $m->instituicao->nome }}</td>
                <td><span class="badge-custom badge-blue">{{ ucfirst($m->turno) }}</span></td>
                <td>{{ $m->dias_semana }}</td>
                <td>{{ $m->frequencia_semanal }}x por semana</td>
                <td><strong>R$ {{ number_format($m->valor_subsidio, 2, ',', '.') }}</strong></td>
                <td>
                    @if($m->status)
                        <span class="badge-custom badge-green">Ativo</span>
                    @else
                        <span class="badge-custom badge-red">Inativo</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:3rem; color: var(--text-muted);">
                    Nenhuma matrícula cadastrada ainda.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection