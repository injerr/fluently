<?php
include_once './Route.php';

Route::get('/',[MainController::class,'home']);
Route::get('/random',[MainController::class,'random']);
Route::get('/redirect',[MainController::class,'redirect']);

Route::get('/random/{some}',[MainController::class,'random']);

Route::get('/prueba',function (){
    return ['alumnos' => ['jeremy','marc','eduard'],'profesores' => ['isabel','victor']];
});

Route::fallback([MainController::class,'err404']);