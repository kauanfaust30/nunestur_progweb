<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #1a1a1a;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #ff7300;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .header table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-logo {
            font-size: 20px;
            font-weight: bold;
            color: #ff7300;
        }

        .header-sub {
            font-size: 11px;
            color: #6b6b6b;
            margin-top: 2px;
        }

        .header-info {
            text-align: right;
            color: #6b6b6b;
            font-size: 11px;
        }

        h1 {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .subtitle {
            font-size: 11px;
            color: #6b6b6b;
            margin-bottom: 16px;
        }

        .totais {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin-bottom: 18px;
        }

        .total-box {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 10px 14px;
            width: 50%;
        }

        .total-box .label {
            font-size: 10px;
            color: #6b6b6b;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 4px;
        }

        .total-box .value {
            font-size: 18px;
            font-weight: bold;
            color: #1a1a1a;
        }

        .total-box.destaque {
            border-color: #ff7300;
            background-color: #fff8f2;
        }

        .total-box.destaque .value {
            color: #ff7300;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        table.data thead tr {
            background-color: #ff7300;
            color: white;
        }

        table.data thead th {
            padding: 7px 8px;
            text-align: left;
            font-size: 10.5px;
            font-weight: bold;
            text-transform: uppercase;
        }

        table.data tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table.data tbody td {
            padding: 6px 8px;
            border-bottom: 1px solid #eeeeee;
            font-size: 10.5px;
        }

        table.data tfoot tr {
            background-color: #1a1a1a;
            color: white;
        }

        table.data tfoot td {
            padding: 7px 8px;
            font-size: 11.5px;
            font-weight: bold;
        }

        .badge {
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 9.5px;
            font-weight: bold;
        }

        .badge-amber { background-color: #faeeda; color: #854f0b; }
        .badge-blue  { background-color: #e6f1fb; color: #185fa5; }
        .badge-gray  { background-color: #f0f0f0; color: #6b6b6b; }

        .footer {
            margin-top: 24px;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
            font-size: 9.5px;
            color: #6b6b6b;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="header">
        <table>
            <tr>
                <td>
                    <div class="header-logo">Nunes Tur</div>
                    <div class="header-sub">Transporte Escolar</div>
                </td>
                <td class="header-info">
                    <div>Relatório gerado em {{ $dataGeracao }}</div>
                    <div>Referência: {{ $mesReferencia }}</div>
                </td>
            </tr>
        </table>
    </div>

    <h1>Relatório de Subsídios — Prefeitura Municipal</h1>
    <p class="subtitle">Listagem completa de alunos transportados, frequência semanal e valores de subsídio</p>

    <table class="totais">
        <tr>
            <td class="total-box">
                <div class="label">Total de alunos</div>
                <div class="value">{{ $totalAlunos }}</div>
            </td>
            <td class="total-box destaque">
                <div class="label">Total subsídios</div>
                <div class="value">R$ {{ number_format($valorTotal, 2, ',', '.') }}</div>
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>#</th>
                <th>Aluno</th>
                <th>Instituição</th>
                <th>Veículo</th>
                <th>Turno</th>
                <th>Dias/semana</th>
                <th>Dias cursados</th>
                <th>Valor subsídio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matriculas as $i => $m)
            <tr>
                <td style="color:#6b6b6b">{{ $i + 1 }}</td>
                <td><strong>{{ $m->aluno->nome }}</strong></td>
                <td>{{ $m->instituicao->nome }}</td>
                <td>{{ $m->veiculo->modelo }}</td>
                <td>
                    @if($m->turno === 'Matutino')
                        <span class="badge badge-amber">{{ $m->turno }}</span>
                    @elseif($m->turno === 'Vespertino')
                        <span class="badge badge-blue">{{ $m->turno }}</span>
                    @else
                        <span class="badge badge-gray">{{ $m->turno }}</span>
                    @endif
                </td>
                <td style="text-align:center">{{ $m->frequencia_semanal }}x</td>
                <td style="text-align:center">{{ $m->dias_semana }}</td>
                <td><strong>R$ {{ number_format($m->valor_subsidio, 2, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style="text-align:right">TOTAL GERAL</td>
                <td>R$ {{ number_format($valorTotal, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <table class="footer">
        <tr>
            <td>Nunes Tur — Transporte Escolar Municipal</td>
            <td style="text-align:right">Documento gerado automaticamente pelo sistema</td>
        </tr>
    </table>

</body>
</html>