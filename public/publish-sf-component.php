<?php

// composer require symfony/mercure

define('JWT', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOltdfX0.Oo0yg7y4yMa1vr_bziltxuTCqb8JVHKxp-f_FwwOim0');

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Mercure\Update;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\Jwt\StaticJwtProvider;

$publisher = new Publisher(
    'http://localhost:3000/hub',
    new StaticJwtProvider(JWT)
);

$update = new Update(
    'http://example.com/my-resource',
    'My payload'
);
echo $publisher($update);
