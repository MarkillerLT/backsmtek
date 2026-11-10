<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Trusted Proxies
    |--------------------------------------------------------------------------
    |
    | Read by Laravel's TrustProxies middleware. Only requests coming from these
    | addresses may set X-Forwarded-For/Host/Proto. In Docker this is the subnet
    | of the network shared only by Anubis and the app (ANUBIS_BACKEND_SUBNET),
    | so the real client IP and the HTTPS scheme set by the edge proxy are kept
    | while anything else sending those headers is ignored.
    |
    | Comma-separated list of IPs/CIDRs. Empty means no proxy is trusted.
    |
    */

    'proxies' => env('TRUSTED_PROXIES'),

];
