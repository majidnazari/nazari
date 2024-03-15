<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

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
       return view('dashboard',['client' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
