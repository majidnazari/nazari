<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CheckClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $client=Client::where("user_name",$request->user_name)->first();
       //->where("password",Hash::make($request->password))    
      
       
        if(!$client || (!(Hash::check($request->password, $client['password']) ))){
            return redirect()->route("login")->withErrors([
                'user_name' => 'Invalid user name',
                'password' => 'Invalid password',
            ])->withInput();

        }
       
        if ( empty($client->email) || empty($client->mobile) ) {
            //dd("should show complete form");

           // return redirect()->route('client.completeInfo');
            return response()->view('completeInfo', compact('client'));
        }

        return $next($request);
    }
}
