<?php
include_once './Route.php';
require_once './controllers/MainController.php';
require_once './controllers/UserController.php';

Route::get('/',[MainController::class,'home']);
Route::get('/random',[MainController::class,'random']);
Route::get('/redirect',[MainController::class,'redirect']);

Route::get('/random/{some}',[MainController::class,'random']);

Route::get('/prueba',function (){
    return ['alumnos' => ['jeremy','marc','eduard'],'profesores' => ['isabel','victor']];
});

Route::get('/random/{some}',[MainController::class,'random']);

Route::get('/crear',[UserController::class,'create']);

Route::fallback([MainController::class,'err404']);