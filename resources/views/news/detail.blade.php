@extends('layouts.app')

@section('title', $newsItem['title'])

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __($newsItem['title']) }}</div>
                    <div class="card-body">
                        {{ $newsItem['text'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection