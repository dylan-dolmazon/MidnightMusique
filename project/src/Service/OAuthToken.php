<?php

namespace App\Service;

class OAuthToken
{
    public function __construct()
    {

        $provider = new Kerox\OAuth2\Client\Provider\Spotify([
            'clientId' => '3f03cf38cb744b239bd7e82078578387',
            'clientSecret' => '106e7c60e4be460bbc50f8e4b93e4b44',
            'redirectUri' => 'localhost:8080',
        ]);

        if (!isset($_GET['code'])) {
            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl([
                'scope' => [
                    Kerox\OAuth2\Client\Provider\Spotify::SCOPE_USER_READ_EMAIL,
                ]
            ]);

            $_SESSION['oauth2state'] = $provider->getState();

            return 1;

// Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            unset($_SESSION['oauth2state']);
            return 0;

        }

// Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

// Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            /** @var \Kerox\OAuth2\Client\Provider\SpotifyResourceOwner $user */
            $user = $provider->getResourceOwner($token);

            // Use these details to create a new profile
            printf('Hello %s!', $user->getDisplayName());

            echo '<pre>';
            var_dump($user);
            echo '</pre>';

        } catch (Exception $e) {

            // Failed to get user details
            exit('Damned...');
        }

        echo '<pre>';
// Use this to interact with an API on the users behalf
        var_dump($token->getToken());
# string(217) "CAADAppfn3msBAI7tZBLWg...

// The time (in epoch time) when an access token will expire
        var_dump($token->getExpires());
# int(1436825866)
        echo '</pre>';
    }
}