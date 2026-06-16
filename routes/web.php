<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\MatriculaTransporteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatorioController;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::redirect('/', '/dashboard'); // opcional, para a raiz redirecionar pro dashboard

// Relatório PDF
Route::get('/relatorio/pdf', [RelatorioController::class, 'pdf'])->name('relatorio.pdf');

// Resources
Route::resource('alunos', AlunoController::class);
Route::resource('instituicoes', InstituicaoController::class)
    ->parameters(['instituicoes' => 'instituicao']);
Route::resource('veiculos', VeiculoController::class);
Route::resource('matriculas', MatriculaTransporteController::class);