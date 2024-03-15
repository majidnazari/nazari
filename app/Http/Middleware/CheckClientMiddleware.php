<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
       $client=Client::where("user_name",$request->user_name)->where("password",$request->password)->first();
     
        if(!$client){
            return redirect()->route("client.wrong")->withErrors([
                'user_name' => 'Invalid user name',
                'password' => 'Invalid password',
            ])->withInput();

        }
        $credentials = $request->only('user_name', 'password');

        // if (Auth::guard('client')->attempt($credentials)) {

        //  dd("auth is ok");
        // }
       // dd("auth is  not ok");
        // Check if the user is authenticated and has an email address
        if ( empty($client->email) || empty($client->mobile) ) {
            //dd("should show complete form");

           // return redirect()->route('client.completeInfo');
            return response()->view('completeInfo', compact('client'));
        }

        return $next($request);
    }
}
