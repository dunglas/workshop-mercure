<?php
require __DIR__.'/../../vendor/autoload.php';

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

$jwt = (new Builder())
        // set other appropriate JWT claims, such as an expiration date
        // try, then change the target, and check that you don't receive the update anymore
        ->set('mercure', ['subscribe' => ['http://example.com/users/1234']])
        // It must be the same key than the one used by the Hub (JWT_KEY)
        ->sign(new Sha256(), '!ChangeMe!')
        ->getToken();

setcookie('mercureAuthorization', $jwt, [
    'path' => '/hub',
    //'secure' => true, // only HTTPS, be sure to uncomment this line in prod
    'httponly'=> true, // not accessible in JavaScript
    'samesite' => 'strict', // CSRF protection
]);
?>
<script>
    const url = new URL('http://localhost:3000/hub');
    url.searchParams.append('topic', 'http://example.com/my-private-resource');

    // withCredentials is mandatory for the cookie to be send!
    const es = new EventSource(url, { withCredentials: true });
    es.onmessage = ({data}) => console.log(data);
</script>