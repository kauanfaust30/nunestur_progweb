<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #1a1a1a;
            padding: 30px 35px;
            background: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 18px;
            margin-bottom: 20px;
        }

        .brand-name {
            font-size: 23px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #1a1a1a;
        }
        .brand-name span { color: #f97316; }

        .brand-sub {
            font-size: 10.5px;
            color: #999;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .header-meta {
            text-align: right;
            font-size: 11px;
            color: #999;
            line-height: 1.7;
        }
        .header-meta .doc-title {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .resumo {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        .resumo-card {
            flex: 1;
            border: 1px solid #f0f0f0;
            border-top: 3px solid #f97316;
            border-radius: 8px;
            padding: 12px 14px;
            background: #fafafa;
        }
        .resumo-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #999;
            font-weight: 700;
        }
        .resumo-valor {
            font-size: 24px;
            font-weight: 700;
            color: #f97316;
            margin-top: 3px;
        }
        .resumo-sub {
            font-size: 10px;
            color: #bbb;
            margin-top: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        thead tr {
            background: #fff7ed;
            border-bottom: 2px solid #f97316;
        }
        thead th {
            padding: 10px 12px;
            text-align: left;
            color: #c2410c;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 700;
        }
        thead th.right { text-align: right; }

        tbody tr:nth-child(even) { background: #fafafa; }
        tbody tr { border-bottom: 1px solid #f0f0f0; }
        tbody td { padding: 9px 12px; color: #333; }
        tbody td.right { text-align: right; }
        tbody td.center { text-align: center; }

        .nome { font-weight: 600; color: #1a1a1a; }

        tfoot tr { background: #fff7ed; }
        tfoot td {
            padding: 11px 12px;
            font-weight: 700;
            font-size: 13px;
            border-top: 2px solid #f97316;
            color: #1a1a1a;
        }
        tfoot td.right { text-align: right; color: #f97316; }

        
        .footer {
            margin-top: 20px;
            padding-top: 12px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #bbb;
        }

        .assinatura {
            margin-top: 40px;
            text-align: center;
        }
        .assinatura-linha {
            width: 220px;
            border-top: 1px solid #333;
            margin: 0 auto 5px;
        }
        .assinatura-label { font-size: 9px; color: #555; }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <p class="brand-name">NUNES <span>TUR</span></p>
            <p class="brand-sub">Sistema de Transporte Escolar</p>
        </div>
        <div class="header-meta">
            <p class="doc-title">Relatório de Transporte Escolar</p>
            <p>Referência: {{ $mesReferencia }}</p>
            <p>Gerado em: {{ $dataGeracao }}</p>
            <p>Documento para prestação de contas à Prefeitura</p>
        </div>
    </div>

   
    <div class="resumo">
        <div class="resumo-card">
            <p class="resumo-label">Total de Alunos</p>
            <p class="resumo-valor">{{ $totalAlunos }}</p>
            <p class="resumo-sub">matrículas ativas</p>
        </div>
        <div class="resumo-card">
            <p class="resumo-label">Valor Total Mensal</p>
            <p class="resumo-valor">R$ {{ number_format($valorTotal, 2, ',', '.') }}</p>
            <p class="resumo-sub">subsídio total</p>
        </div>
        <div class="resumo-card">
            <p class="resumo-label">Mês de Referência</p>
            <p class="resumo-valor" style="font-size:13px; padding-top:5px">{{ $mesReferencia }}</p>
        </div>
    </div>

    
    <table>
        <thead>
            <tr>
                <th style="width:28px">#</th>
                <th>Aluno</th>
                <th>Instituição</th>
                <th>Turno</th>
                <th>Dias da Semana</th>
                <th class="right">Freq. Semanal</th>
                <th class="right">Valor Subsídio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matriculas as $i => $m)
            <tr>
                <td style="color:#bbb">{{ $i + 1 }}</td>
                <td class="nome">{{ $m->aluno->nome }}</td>
                <td>{{ $m->instituicao->nome }}</td>
                <td>{{ ucfirst($m->turno) }}</td>
                <td>{{ $m->dias_semana }}</td>
                <td class="right">{{ $m->frequencia_semanal }}x / semana</td>
                <td class="right"><strong>R$ {{ number_format($m->valor_subsidio, 2, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><strong>TOTAL GERAL</strong></td>
                <td colspan="3" style="color:#999">{{ $totalAlunos }} aluno(s) ativo(s)</td>
                <td></td>
                <td class="right">R$ {{ number_format($valorTotal, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    
    <div class="footer">
        <span>Nunes Tur — Transporte Escolar Municipal</span>
        <span>Gerado automaticamente em {{ $dataGeracao }}</span>
    </div>

    <div class="assinatura">
        <div class="assinatura-linha"></div>
        <p class="assinatura-label">Responsável pela Secretaria de Educação</p>
    </div>

</body>
</html>