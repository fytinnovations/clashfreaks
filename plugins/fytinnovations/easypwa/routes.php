<?php

Route::get('manifest.json', function () {
    return Response::make(Manifest::generateManifest())->header("Content-Type", "application/json");
});