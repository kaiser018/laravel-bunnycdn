<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$url = "";
    return view('welcome',compact('url'));
});

Route::post('/upload', function (Request $request) {
	if ($request->file('file')->isValid()) {
		$result = $request->file->store('files','bunnycdn');
		$url = Storage::disk('bunnycdn')->url($result);
    	return view('welcome',compact('url'));
	}
});
