<?php

use Dcat\Admin\Extension\Config\Http\Controllers;

Route::prefix('config')->group(function () {
    Route::get('', Controllers\ConfigController::class.'@index');
    Route::get('create', Controllers\ConfigController::class.'@create');
    Route::get('{id}/edit', Controllers\ConfigController::class.'@editor');
    Route::post('', Controllers\ConfigController::class.'@toCreate');
    Route::post('{id}', Controllers\ConfigController::class.'@toEditor');
    Route::delete('{id}', Controllers\ConfigController::class.'@toDelete');
});
