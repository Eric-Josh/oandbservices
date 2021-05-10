<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $guestIp = \request()->ip();
        // $client = new Client();
        // $url = "https://api.ipgeolocation.io/ipgeo?apiKey=a5bb47955e2547f38ead40538034b5ae&ip=".$guestIp;

        // $response = $client->request('GET', $url);
        // $responseBody = json_decode($response->getBody());

        // if($response->json(['success' => 'success'], 200)){
        //     if($responseBody->country_name !== 'United Kingdom' ){
        //        return redirect('https://google.com');
        //     }elseif($responseBody->country_name == 'United Kingdom' ){
        //        return view('guest');
        // }
        // }else{
        //     return "You are not permitted to view this page!";
        // }
        
        return $next($request);
    }
}
