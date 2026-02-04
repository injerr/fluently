<?php
//include_once './Route.php';

Route::get('/',[MainController::class,'home']);
Route::get('/random',[MainController::class,'random']);
Route::get('/redirect',[MainController::class,'redirect']);
Route::get('/**',[MainController::class,'err404']);