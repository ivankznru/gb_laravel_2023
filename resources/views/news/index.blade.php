@extends('layouts.app')

@section('title', __('News index '))

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('News index ') }} </div>
                    <div class="card-body">
                        <ul>
                            @forelse ($news as $newsItem)
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('news.detail', $newsItem->slug) }}">{{ $newsItem->title }}</a>
                                </li>
                            @empty
                                <li>No news</li>
                            @endforelse
                        </ul>
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
