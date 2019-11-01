<?php

Route::get('manifest.json', function (){
    return Response::make(json_encode(PWAManifest::get()))->header("Content-Type", "application/json");
});