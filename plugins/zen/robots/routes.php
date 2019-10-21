<?php

use Zen\Robots\Controllers\Generate;

Route::get('robots.txt', function () {
    return Response::make(Generate::robots())->header("Content-Type", "text/plain");
});