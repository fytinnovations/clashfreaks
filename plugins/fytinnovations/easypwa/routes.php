<?php

Route::get('manifest.json', function (){
    return Response::make(PWAManifest::get())->header("Content-Type", "application/json");
});