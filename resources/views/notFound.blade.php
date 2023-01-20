@extends('layouts.app')

@section('title', __('Not found'))

@section('menu')
    @include('menu')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('The requested information was not found') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Try to change your request') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


