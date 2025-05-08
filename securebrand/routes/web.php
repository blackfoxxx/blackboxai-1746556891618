<?php
Route::get('/', function () { return 'Application is running'; });

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
