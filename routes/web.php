<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

include_once('../getID3-1.9.15/getid3/getid3.php');
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Http\Response;

$router->post('api/v{version}/uploadvideo', function($version, ServerRequestInterface $request) { // Can create if/else tree later to utilise $version if required
    if ($request->hasFile('video') && $request->file('video')->isValid()) { // Check for video file in request and that it uploaded correctly
        $videoFile = $request->file('video');

        $videoFile->store('videos'); // Save video

        return response()->json(getID3($videoFile));
    } else { // Handle bad request/failed upload
        return response()->json(['error' => 'invalidFile']); // Handle on client-side via JavaScript to determine failed response
    }
});
