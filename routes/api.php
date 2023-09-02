<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth.basic')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/tokens/create', function (Request $request) {

        // Revoke all tokens...
        $request->user()->tokens()->delete();

        // Create a new token
        $token = $request->user()->createToken('token');

        return ['token' => $token->plainTextToken];
    });
});

Route::middleware('auth:sanctum')->get('/users', function () {

    return \App\Models\User::all();

});
