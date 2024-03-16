<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $client=Client::where('user_name',$request->user_name)->where('password',$request->password)->first();
        return view('dashboard',['client' => $client]);

       //return view("dashboard");
    //    $client=Client::where('username',$request->user_name)->where('password',$request->password)->first();
    //    if($client){
    //     //return response('User does not exist or password is incorrect', 403);
    //     return view("client.wrong");
    //    }
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
       //dd("the client shoudl update and redirect to dashboard");
       SendEmailJob::dispatch($client)->onQueue('email');
        
       $data=[
        "email"=> $request->email,
        "mobile"=> $request->mobile,
       ];

       $client->update($data);
       $client->save();

       return view('dashboard',['client' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    public function authClient(Request $request){
       $client= Client::where('user_name',$request->user_name)->first();
       //->where('password',$request->password)
       
       $credentials =[
        'user_name' => $request->user_name,
        'password' =>  $request->password,
    ];

    //dd( Hash::check($request->password, $client['password']));

    if (Auth::guard('web')->attempt($credentials)) {
        $request->session()->regenerate();

         return view('dashboard',['client' => $client]);
    }

        return back()->withErrors([
            'user_name' => 'The provided credentials do not match our records.',
        ])->onlyInput('user_name');
    }

    public function logout(Request $request){

        Auth::logout();

    // Check if the user is logged out
    if (Auth::check()) {
        //dd("user  is still authenticated");
        // User is still authenticated
        // Handle the case where logout failed
    } else {
       // dd("user is logged out");

        // User is logged out
        // Perform any additional actions or redirect the user to a specific page
        return redirect('/login');
    }

    }
}
