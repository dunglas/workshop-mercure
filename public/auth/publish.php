<?php
// composer require lcobucci/jwt
// Never implement JWT by yourself!!

require __DIR__.'/../../vendor/autoload.php';

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Mercure\Publisher;

$targets = [
    'http://example.com/users/1234',
    'http://example.com/groups/abc',
];

$jwtProvider = function () use ($targets) : string {
    return (new Builder())
        // could also include the security roles, or anything else
        ->set('mercure', ['publish' => $targets])
        // It must be the same key than the one used by the Hub (JWT_KEY)
        ->sign(new Sha256(), '!ChangeMe!')
        ->getToken();
};

$publisher = new Publisher('http://localhost:3000/hub', $jwtProvider);
$update = new Update('http://example.com/my-private-resource', 'My private payload', $targets);
echo $publisher($update);
