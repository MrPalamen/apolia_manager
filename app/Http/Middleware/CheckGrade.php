<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp;
use Illuminate\Support\Facades\Session;

class CheckGrade
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * Config User id groups
         */
        $admin = ['4'];
        $moderator = ['18','6'];
        $support = ['16'];
        $h_smp = ['8'];
        $smp = ['10'];
        // GET API USER
        if (Session::exists('grade'))
        {
            if (Session::get('grade') === 'guard')
                return redirect()->route('home');
            return $next($request);
        }

        $accessToken = session('oauth2_session')->getToken();
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 'https://forum.apolia-rp.com/api/core/me', [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
            ]
        ]);
        $response = json_decode($res->getBody());
        $groups = $response->groups;
        $grade = 'guard';
        foreach ($groups as $value)
        {
            if (in_array($value, $admin)) {
                $grade = 'administrator';
                break;
            }
            if (in_array($value, $moderator)) {
                $grade = 'moderator';
                break;
            }
            if (in_array($value, $support)) {
                $grade = 'support';
                break;
            }
            if (in_array($value, $h_smp)) {
                $grade = 'h_smp';
                break;
            }

            if (in_array($value, $smp)) {
                $grade = 'smp';
                break;
            }
        }
        Session::put('grade', $grade);
        Session::put('user', $response);
        if (Session::get('grade') === 'guard')
            return redirect()->route('home');
        return $next($request);
    }
}
