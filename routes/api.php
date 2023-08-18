<?php

use App\Http\Controllers\Api\Country\Routing\CalculateCountryLandDistanceController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::name('country.')->group(function () {
        Route::prefix('/routing')->name('border.')->group(function () {
            Route::get('/{origin}/{destination}', CalculateCountryLandDistanceController::class)->name('check');
        });
    });
});

Route::get('/test', function () {
    $result = (new \App\Service\Country\Parser\CountryJsonParserService)->getCountryAndBorders();
    dd($result);

    return 'test';
});
