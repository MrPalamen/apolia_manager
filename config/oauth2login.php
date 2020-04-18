<?php

return [
    'oauthconf' => [ // See http://oauth2-client.thephpleague.com/usage/#authorization-code-flow
        'clientId' => '4a31e69937298b7ffd95bb0727067fc9', // The client ID assigned to you by the provider
        'clientSecret' => '4e504913f458e53b7a122a545be74fbd0830e14c3bb79879', // The client password assigned to you by the provider
        'redirectUri' => 'http://127.0.0.1/oauth2/callback',
        'urlAuthorize' => 'https://forum.apolia-rp.com/oauth/authorize/',
        'urlAccessToken' => 'https://forum.apolia-rp.com/oauth/token/',
        'urlResourceOwnerDetails' => 'https://forum.apolia-rp.com/api/core/hello',
        'scopes' => ['profile'],
    ],
    'provider' => \Kronthto\LaravelOAuth2Login\OAuthProvider::class,

    'oauth_redirect_path' => '/oauth2/callback',

    'session_key' => 'oauth2_session',
    'session_key_state' => 'oauth2_auth_state',

    'resource_owner_attribute' => 'oauth2_user',
    'auth_driver_key' => 'oauth2',
    'authWrapperFactory' => null, // Can be used to specify a factory with an __invoke (ResourceOwnerInterface passed as arg1) method to build a custom User object
    'authWrapper' => \Kronthto\LaravelOAuth2Login\OAuthUserWrapper::class, // Ignored if authWrapperFactory is not null

    'cacheUserDetailsFor' => 30, // minutes
    'cacheUserPrefix' => 'oauth_user_',
];
