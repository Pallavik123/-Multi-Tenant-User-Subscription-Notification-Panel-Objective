<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

// Route::get('/{any}', function () {
//     $index = public_path('index.html');

//     if (File::exists($index)) {
//         return Response::make(File::get($index), 200, [
//             'Content-Type' => 'text/html'
//         ]);
//     }

//     abort(404);
// })->where('any', '.*');



Route::get('/{any}', function () {
    return response()->file(public_path('index.html'));
})->where('any', '^(?!build).*$');