@extends('layouts.app')

@section('title', $news->id ? __('Modify the news item') : __('Add a new news item'))

@section('menu')
    @include('admin.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if ($news->id)
                            {{ __('Modify the news item #') . $news->id }}
                        @else
                            {{ __('Add a new news item') }}
                        @endif
                    </div>
                    <div class="card-body">
                        <form
                            action="@if (!$news->id) {{ route('admin.news.store') }}@else{{ route('admin.news.update', $news) }} @endif"
                            method="post">
                            @csrf
                            @if($news->id) @method('PUT') @endif
                            <div class="form-group">
                                <label for="newsTitle">Title</label>
                                @if ($errors->has('title'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('title') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="title" id="newsTitle" class="form-control"
                                    value="{{ $news->title ?? old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="newsCategory">News category</label>
                                @if ($errors->has('category_id'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('category_id') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <select name="category_id" id="newsCategory" class="form-control">
                                    @forelse($categories as $item)
                                        <option @if ($item->id == ($news->category_id ?? old('category'))) selected @endif
                                            value="{{ $item->id }}">{{ $item->title }}</option>
                                    @empty
                                        <option value="0" selected>- no categories -</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="author">Автор</label>
                                @if ($errors->has('author'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('author') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" id="author" name="author" value="{{$news->author ?? old('author') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Статус:{{$news ->status}}</label>
                                @if ($errors->has('status'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('status') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <select class="form-control" name="status" id="status">
                                    @foreach($statuses as $status)
                                        <option @if(old('status') === $status) selected @endif>{{$status}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Изображение: {{$news ->image}}</label>
                                @if ($errors->has('image'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('image') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="file" id="image" name="image"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="newsText">Text</label>
                                @if ($errors->has('text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('text') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <textarea name="text" id="newsText" class="form-control">{{ $news->text ?? old('text') }}</textarea>
                            </div>

                            <div class="form-check">
                                @if ($errors->has('isPrivate'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('isPrivate') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input @if ($news->isPrivate == 1 || old('isPrivate') == 1) checked @endif id="newsPrivate" name="isPrivate"
                                    type="checkbox" value="1" class="form-check-input">
                                <label for="newsPrivate">Is private?</label>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary"
                                    value="{{ $news->id ? 'Update' : 'Add' }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
