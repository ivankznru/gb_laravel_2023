@extends('layouts.app')

@section('title', __('News categories'))

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('News categories') }}</div>
                    <div class="card-body">
                        <ul >
                            @forelse($categories as $categoryItem)
                                <li class="nav-item">
                                    <a class="nav-link"
                                    href="{{ route('categories.detail', $categoryItem->slug) }}">{{ $categoryItem->title }}</a>
                                </li>
                            @empty
                                <li>No categories</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

