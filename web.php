<?php
include_once './src/fluently/Route.php';
require_once './controllers/MainController.php';
require_once './controllers/UserController.php';

Route::get('/',[MainController::class,'home']);
Route::get('/random',[MainController::class,'random']);
Route::get('/redirect',[MainController::class,'redirect']);
Route::get('/apitest',function() {
    view('./views/apitesting.php');
});

Route::post('/apitest/{id}',[MainController::class,'apitesting']);
Route::put('/apitest/{id}',[MainController::class,'apitesting']);
Route::delete('/apitest/{id}',[MainController::class,'apitesting']);

Route::get('/random/{some}',[MainController::class,'random']);

Route::get('/prueba',function (){
    return ['alumnos' => ['jeremy','marc','eduard'],'profesores' => ['isabel','victor']];
});

Route::get('/random/{some}',[MainController::class,'random']);

Route::get('/crear',[UserController::class,'create']);
Route::get('/docs', function() {
    return view('docs/index');
});

Route::get('/response',[UserController::class,'mostrarLista']);
// Route::get('/users', function() {
//     return httpResponse()->json(User::all());
// });
Route::get('/users', function() {
    return httpResponse()->json(User::all());
});
Route::get('/user/{id}',[UserController::class,'getById']);
Route::put('/user/{id}',[UserController::class,'update']);
Route::delete('/user/{id}',[UserController::class,'borrar']);
// Route::fallback([MainController::class,'err404']);
Route::get('/usersbyquery', function() {
    return httpResponse()->json(User::where('id','>=',7)->orderBy('user','asc')->get(['id','user']));
});
// Route::get('/usersbyquery2', [UserController::class,'querys']);
Route::get('/usersbyquery2', function () {
    httpResponse()->json(['id' => User::insertGetId(['user' => '30-06-26', 'password' => 'Ugu'])]);
});
Route::get('/groupby', function () {
    return httpResponse()->json(
        Query::table('productos')
        ->select('categoria',DB::raw('SUM(precio) as Total'),DB::raw('COUNT(*) as Items'))
        ->groupBy('categoria')
        ->get()
    );
});
Route::get('/viewEngine', function () {
    $users = User::all();
    return ViewEngine::transform('layout',compact('users'));
});

Route::get('/viewEngine2', function () {
    return ViewEngine::transform('docs.prueba.random');
});