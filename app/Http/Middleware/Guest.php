<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Providers\RouteServiceProvider;
// use Illuminate\Support\Facades\Log;

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
        $guestIp = \request()->ip();
        $client = new Client();
        $url = 'https://api.ipgeolocation.io/ipgeo?apiKey=a5bb47955e2547f38ead40538034b5ae&ip='.$guestIp;

        $response = $client->request('GET', $url);
        $responseBody = json_decode($response->getBody());
        // Log::info(json_encode($responseBody->country_name));

        if(response()->json($responseBody, 200)){
            if( json_encode($responseBody->country_name) == '"Nigeria"' || json_encode($responseBody->country_name) == '"United Kingdom"'){
                
                // return response()->view('guest');
              
            }else{
                return redirect()->away('https://www.google.com');
            }
            
        }else{
            return redirect()->away('https://www.google.com');
        }
        
        return $next($request);
    }
}
