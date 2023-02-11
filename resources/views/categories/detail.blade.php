@extends('layouts.app')

@section('title', $category ? __('News from the category ') . $category->title : 'Not found')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $category ? __('News from the category ') . $category->title : 'Not found' }}
                    </div>
                    <div class="card-body">
                        <ul>
                            @forelse ($news as $newsItem)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('news.detail', $newsItem->slug) }}">
                                        <img src="{{ $newsItem->image }}" width="80" alt="" style="margin:5px">
                                        @if ($newsItem->isPrivate && !Auth::check())
                                            <i><b>(private)</b></i>
                                        @endif

                                        {{ $newsItem->title }}
                                    </a>
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
