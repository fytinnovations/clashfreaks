<?php
use Fytinnovations\EasyPWA\Models\Settings;
Route::get('manifest.json', function (){
    return Response::make(json_encode(PWAManifest::get()))->header("Content-Type", "application/json");
});

Route::get('service-worker.js', function (){
    return Response::make(Settings::get('service_worker'))->header("Content-Type", "text/javascript");
});
