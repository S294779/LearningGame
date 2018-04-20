<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'paypal-checkout-complete/*',
        'paypal-checkout-cancel/*',
        'paypal-validate-ipn/*',
        'get-api-token',
        'phaser-game/*',
    ];
}
