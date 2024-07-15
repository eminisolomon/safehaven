<?php

use Eminisolomon\SafeHaven\Client;
use Eminisolomon\SafeHaven\Service\AccountService;
use Eminisolomon\SafeHaven\Service\BeneficiaryService;
use Eminisolomon\SafeHaven\Service\BillingService;
use Eminisolomon\SafeHaven\Service\CheckoutService;
use Eminisolomon\SafeHaven\Service\TransferService;
use Eminisolomon\SafeHaven\Service\VerificationService;
use Eminisolomon\SafeHaven\Service\VirtualAccountService;

return [
    'environment' => 'sandbox', //sandbox || production
    'company_domain' => 'https://solomonolatunji.dev',
    'client_id' => env('SAFE_HAVEN_CLIENT_ID', 'f1c8e97be92ab33fa19ef7518beab395'),
    'sandbox_endpoint' => 'https://api.sandbox.safehavenmfb.com',
    'production_endpoint' => 'https://api.safehavenmfb.com',
    'alg' => 'RS256',
    'typ' => 'JWT',


    'services' => [
        'client' => Client::class,
        'account' => AccountService::class,
        'virtual' => VirtualAccountService::class,
        'billing' => BillingService::class,
        'beneficiary' => BeneficiaryService::class,
        'transfer' => TransferService::class,
        'verification' => VerificationService::class,
        'checkout' => CheckoutService::class,
    ],


    'keys' => [

        'private' => '<<<EOD
-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAM2XPvvXdyQF8N4v
Zj9Ob4zm1omCv42e80INAwHpoznUnQRAe05ihmbOuSj8XHtvUTPAlkbj+zP15wFi
h9eFPtXoq51A3LaSCzG3BVyFhwo/eV8JYqXLesnmeUNkFIlpyOIiVnl0FnUEEO4n
M6acci2AEqWwBgXrJrieQc3pwoi9AgMBAAECgYAwl6j5WWn9h7Hwsf9WwzE2enEG
u3KPBJy2ZeDqGNDNoGUkViFO25aswfudplgtjJgCxWg/hS8gjuR0vVciJ4o8FCr2
h/bjkUUgu916vqMo5xpVPkOW4Nan9YXv17PgWBhl2h50MgpgZvZ+40NecJ6KNvpz
KrfvBQNdOw5VTt5KAQJBAPdU7hvyIPzEcylFQdddvq7oHikwCdBspmKm+teBxt7E
bHJPYchUBk30PlIBCRVCU7Spk8Kbpv/jiHxKuCO8TP0CQQDUy9CDU7PTEza4Wlrv
PtIWpTZJ7B7EQpTiwMaFs+lylByIlvgyHOSO7cDTinGRJyTVjAFZJumpi6uln/Ml
hdbBAkEA7hMGkEflkOnYoGVWF2TZY6tzPNpM2B99mYB5/G+jalNQwEfBLAAVgXwV
cQImKByMTl7dKHqDqdTvUBTsYxmiUQJBALlRLivQj0B48SSne53zBZ83DgpemYSt
v1+iJsF1pw5jsl25rDhoNRvMLiuL289fWZKntNzhKIjA3CEHJQc+gYECQEhdF+hB
bdpaSdNAbU3tcTJIjF1oQqwh2pSs5kX5lydAfC8lOCYSy07ZdlJsglolhYpnUKCQ
PSOIBF+P0H/YAZI=
-----END PRIVATE KEY-----
EOD',

        'public' => '<<<EOD
-----BEGIN CERTIFICATE-----
MIIDIjCCAougAwIBAgIUC2hEPUPS7gHaxKeb+fMEnsS7lrEwDQYJKoZIhvcNAQEL
BQAwgaIxCzAJBgNVBAYTAk5HMQwwCgYDVQQIDANPeW8xDzANBgNVBAcMBkliYWRh
bjEdMBsGA1UECgwUTWF5bGFuY2VyIElUIExpbWl0ZWQxGzAZBgNVBAsMElNvZnR3
YXJlIERldmVsb3BlcjESMBAGA1UEAwwJTWF5bGFuY2VyMSQwIgYJKoZIhvcNAQkB
FhVtYXlsYW5jZXJpdEBnbWFpbC5jb20wHhcNMjQwMTA5MTMwMDQ0WhcNMjkwMTA3
MTMwMDQ0WjCBojELMAkGA1UEBhMCTkcxDDAKBgNVBAgMA095bzEPMA0GA1UEBwwG
SWJhZGFuMR0wGwYDVQQKDBRNYXlsYW5jZXIgSVQgTGltaXRlZDEbMBkGA1UECwwS
U29mdHdhcmUgRGV2ZWxvcGVyMRIwEAYDVQQDDAlNYXlsYW5jZXIxJDAiBgkqhkiG
9w0BCQEWFW1heWxhbmNlcml0QGdtYWlsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOB
jQAwgYkCgYEAzZc++9d3JAXw3i9mP05vjObWiYK/jZ7zQg0DAemjOdSdBEB7TmKG
Zs65KPxce29RM8CWRuP7M/XnAWKH14U+1eirnUDctpILMbcFXIWHCj95Xwlipct6
yeZ5Q2QUiWnI4iJWeXQWdQQQ7iczppxyLYASpbAGBesmuJ5BzenCiL0CAwEAAaNT
MFEwHQYDVR0OBBYEFF3QvUo/7FFAOIHQQkcUP1UXrc+bMB8GA1UdIwQYMBaAFF3Q
vUo/7FFAOIHQQkcUP1UXrc+bMA8GA1UdEwEB/wQFMAMBAf8wDQYJKoZIhvcNAQEL
BQADgYEAL4DHwgQdVocew1CKSclLN9HJGT83JOYFdQG18d2q9MH3Z61x+ZEwelgZ
jEiakqMpP8x/NTl+2cidVwdiTwlCto3GTYQdqAgVF66fBGapr4gF9onvr9xp0U5Z
A48F5svLHuTAh+L0lM/+VNvjxO6Dy2voCDAn+Ag7YC1rVeYf50s=
-----END CERTIFICATE-----
EOD',


    ]
];
