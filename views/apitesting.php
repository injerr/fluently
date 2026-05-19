<?php
require_once './src/fluently/Request.php';

$request = new Request();
header('Content-Type: application/json');
echo json_encode([
    "status" => "ok",
    "method" => $request->method(),
    "body" =>   $request->body() ?? null,
    "params" => ["id" => $id ?? null] ?? null
]);

echo json_encode(["prueba" => $request->input('email')]);