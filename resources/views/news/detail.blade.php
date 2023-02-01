@extends('layouts.app')

@section('title', $newsItem ? $newsItem->title : 'Not found')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if (!empty($newsItem))
                        <div class="card-header">{{ __($newsItem->title) }}</div>
                        <div class="card-body">
                            @if ($newsItem->isPrivate !== true)
                                {{ $newsItem->text }}
                            @else
                                <i>-- This is a PRIVATE news item. The content is hidden --</i>
                            @endif
                        </div>
                    @else
                        <i>The requested information was not found</i>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
