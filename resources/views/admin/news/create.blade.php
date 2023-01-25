@extends('layouts.app')

@section('title', __('Add A New News Item'))

@section('menu')
    @include('admin.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add A New News Item') }}</div>
                    <div class="card-body">
                        <form action="{{ route('admin.news.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="newsTitle">Title</label>
                                <input type="text" name="title" id="newsTitle" class="form-control"
                                    value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="newsCategory">News category</label>
                                <select name="categoryId" id="newsCategory" class="form-control">
                                    @forelse($categories as $item)
                                        <option @if ($item['id'] == old('category')) selected @endif
                                            value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                    @empty
                                        <option value="0" selected>Нет категории</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="newsText">Text</label>
                                <textarea name="text" id="newsText" class="form-control">{{ old('text') }}</textarea>
                            </div>

                            <div class="form-check">
                                <input @if (old('isPrivate') == '1') checked @endif id="newsPrivate" name="isPrivate"
                                    type="checkbox" value="1" class="form-check-input">
                                <label for="newsPrivate">Is private?</label>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Add news item">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
