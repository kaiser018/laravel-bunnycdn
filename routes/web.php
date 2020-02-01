<?php

use App\Jobs\UploadFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
	return view('welcome', compact('url'));
});

Route::post('/upload', function (Request $request) {

	if ($request->file('file')->isValid()) {

		$filename = $request->file->store('files', 'public');
		
		dispatch($job = new UploadFile($filename, 'public'));

		$url = $job->getUrl();

		return view('welcome', compact('url'));

	}

});

Route::get('/files/{filename}', function ($filename) {
	
	$storage = Storage::disk('public');

	$filename = "files/{$filename}";

	if ($storage->exists($filename)) {
    	return response($storage->get($filename), 200)->header('Content-Type', $storage->mimeType($filename));
	} else {
		return Redirect::to(Storage::disk('bunnycdn')->url($filename), 301); 
	}

});