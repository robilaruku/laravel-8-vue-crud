<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::namespace('Notes')->group(function(){

    Route::prefix('notes')->group(function(){
        Route::post('create-new-note', [\App\Http\Controllers\Notes\NoteController::class, 'store']);
        Route::get('', [\App\Http\Controllers\Notes\NoteController::class, 'index']);
        Route::get('{note:slug}', [\App\Http\Controllers\Notes\NoteController::class, 'show'])->name('notes.show');
        Route::patch('{note:slug}/edit', [\App\Http\Controllers\Notes\NoteController::class, 'update']);
    });

    Route::prefix('subjects')->group(function(){
        Route::get('', [\App\Http\Controllers\Notes\SubjectController::class, 'index']);
    });
});
