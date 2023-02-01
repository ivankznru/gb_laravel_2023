@extends('layouts.app')

@section('title', $comments->id ? __('Modify the comments') : __('Add a new comments'))

@section('menu')
    @include('menu')
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if ($comments->id)
                            {{ __('Modify the comments #') . $comments->id }}
                        @else
                            {{ __('Add a new comments') }}
                        @endif
                    </div>
                    <div class="card-body">
                        <form
                            action="@if (!$comments->id) {{ route('comments.create') }}@else{{ route('comments.update', $comments) }} @endif"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="newsTitle">User's name</label>
                                @if ($errors->has('title'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('title') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="title" id="newsTitle" class="form-control"
                                    value="{{ $comments->title ?? old('title') }}">
                            </div>
                            <div class="mb-3">
                                <label for="newsText">Comment</label>
                                @if ($errors->has('text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('text') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <textarea name="text" id="newsText" class="form-control">{{ $comments->text ?? old('text') }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary"
                                    value="{{ $comments->id ? 'Update' : 'Add' }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
