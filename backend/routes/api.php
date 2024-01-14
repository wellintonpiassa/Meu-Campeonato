<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;

// Rotas de autenticação e criação de usuários
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function(){
  Route::get('user', [AuthController::class, 'user']);
  Route::post('logout', [AuthController::class, 'logout']);
});

// Rotas envolvendo times
Route::middleware('auth:sanctum')->group(function(){
  Route::get('teams/all', [TeamController::class, 'all']);
  Route::post('teams/new', [TeamController::class, 'store']);
});

