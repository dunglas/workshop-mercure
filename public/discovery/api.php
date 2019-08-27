<?php
header('Content-Type: application/ld+json');
header('Link: <http://localhost:3000/hub>; rel="mercure"', false);

echo json_encode(['@id' => 'http://example.com/my-resource', 'foo' => 'bar']);
