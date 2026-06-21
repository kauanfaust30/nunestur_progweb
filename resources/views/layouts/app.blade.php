<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nunes Tur</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">

        <a href="/" class="logo">
            <div class="logo-icon"><i class="bi bi-bus-front-fill"></i></div>
            Nunes Tur
        </a>

        <ul class="nav-menu">
            <li>
                <a href="/dashboard" class="{{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/alunos" class="{{ request()->is('alunos*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Alunos</span>
                </a>
            </li>
            <li>
                <a href="/instituicoes" class="{{ request()->is('instituicoes*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    <span>Instituições</span>
                </a>
            </li>
            <li>
                <a href="/veiculos" class="{{ request()->is('veiculos*') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i>
                    <span>Veículos</span>
                </a>
            </li>
            <li>
                <a href="/matriculas" class="{{ request()->is('matriculas*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Matrículas</span>
                </a>
            </li>
        </ul>

    </div>
</nav>

<div class="main-content">

    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</div>

{{-- Modal de confirmação reutilizável --}}
<div class="modal-overlay" id="confirmModal">
    <div class="modal-box">
        <div class="modal-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
        <h3 id="confirmModalTitle">Confirmar exclusão</h3>
        <p id="confirmModalText">Tem certeza que deseja excluir este item? Essa ação não pode ser desfeita.</p>
        <div class="modal-actions">
            <button type="button" class="btn-outline-custom" onclick="closeConfirmModal()">Cancelar</button>
            <button type="button" class="btn-danger-solid" id="confirmModalBtn">Excluir</button>
        </div>
    </div>
</div>

</body>
</html>