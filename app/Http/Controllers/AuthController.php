<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $data = [
            'login' => $request['login'],
            'password' => $request['password'],
            'app' => $request['app'],
            'redirect_uri' => $request['redirect_uri'],
        ];

        $client = new Client(array(
            'cookies' => true
        ));


        $response = $client->request('POST', 'https://users.premierleague.com/accounts/login/', [
            'headers'        => [
                'authority' => 'users.premierleague.com',
                'cache-control' => 'max-age=0',
                'upgrade-insecure-requests' => '1',
                'origin' => 'https =>//fantasy.premierleague.com',
                'content-type' => 'application/x-www-form-urlencoded',
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36',
                'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'sec-fetch-site' => 'same-site',
                'sec-fetch-mode' => 'navigate',
                'sec-fetch-user' => '?1',
                'sec-fetch-dest' => 'document',
                'referer' => 'https =>//fantasy.premierleague.com/my-team',
                'accept-language' => 'en-US,en;q=0.9,he;q=0.8',
            ],
            'form_params' => $data
        ]);


        $c = $client->request('GET','https://fantasy.premierleague.com/api/me/');

        return $c;

        return $response;
        if ($response['location']) {
            $parts = parse_url($response['location']);
            parse_str($parts['query'], $query);
            if ($query['state'] == 'success') {
                return response()->json([
                    'success' => true,
                ]);
            }
        }

        return $response;
    }

    public function social($provider)
    {
        $auth = Socialite::driver($provider)->stateless()->user();
        $email = $auth->getEmail();
        $avatar = $auth->getAvatar();
        return response()->json(compact('email', 'avatar'));
    }
}
