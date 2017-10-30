<?php
    include_once('getid3.php');
    use Psr\Http\Message\ServerRequestInterface;
    use Illuminate\Http\Response;

    $app->post('api/v{version}/uploadvideo', function($version, ServerRequestInterface $request) { // Can create if/else tree later to utilise $version if required
        if ($request->hasFile('video') && $request->file('video')->isValid()) { // Check for video file in request and that it uploaded correctly
            $videoFile = $request->file('video');

            $videoFile->store('videos'); // Save video

            return response()->json(getID3($videoFile));
        } else { // Handle bad request/failed upload
            return response()->json(['error' => 'invalidFile']); // Handle on client-side via JavaScript to determine failed response
        }
    });
?>
