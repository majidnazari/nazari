@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Welcome to your dashboard! <h2> {{ isset($client) ? $client->user_name : '' }}   </h2>
                    </div>

                    <li class="nav-item">
                          <a class="nav-link" href="{{ route('articles.datatable') }}">{{ __('articles') }}</a>
                    </li>
                </div>
            </div>
        </div>
    </div>
@endsection