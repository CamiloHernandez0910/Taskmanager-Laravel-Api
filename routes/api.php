<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::get('/tareas', [TareaController::class, 'index']);
Route::post('/tareas', [TareaController::class, 'store']);
Route::put('/tareas/{tarea}', [TareaController::class, 'update']);
Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy']);

Route::get('/odata/tareas', [TareaController::class, 'filtrarTareas']);

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (!$token = Auth::attempt($credentials)) {
        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => Auth::factory()->getTTL() * 60
    ]);
});

Route::post('/register', function (Request $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return response()->json($user);
});
