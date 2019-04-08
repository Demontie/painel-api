<?php

//Route::get('/', function () {
//    return view('home');
//});
if (!request()->ajax() ) {
    Route::get('/{vue?}', function (){
        return view('home');
    })->where('vue', '[\/\w\.-]*');
}

