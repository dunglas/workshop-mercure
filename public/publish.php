<?php

// The publisher must be authenticated, more about that later!
define('JWT', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOltdfX0.Oo0yg7y4yMa1vr_bziltxuTCqb8JVHKxp-f_FwwOim0');

// simple form-urlencoded format
$postData = http_build_query([
    'topic' => 'http://example.com/my-resource',
    'data' => 'My payload',
]);

$headers = [
    'Content-type: application/x-www-form-urlencoded',
    'Authorization: Bearer '.JWT,
];

echo file_get_contents('http://localhost:3000/hub', false, stream_context_create(['http' => [
    'method'  => 'POST',
    'header'  => implode("\r\n", $headers),
    'content' => $postData,
]]));
