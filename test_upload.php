<?php
$_FILES['logo'] = [
    'name' => 'test.jpg',
    'type' => '',
    'tmp_name' => '',
    'error' => UPLOAD_ERR_INI_SIZE,
    'size' => 0
];
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::capture();
$validator = Illuminate\Support\Facades\Validator::make($request->all(), [
    'logo' => 'nullable|image|max:2048'
]);
var_dump($request->hasFile('logo'));
var_dump($validator->fails());
var_dump($validator->errors()->all());
