@extends('layouts.app')

@section('title', __('Download news by category'))

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Download category news') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.news.download') }}">
                            @csrf
                            <div class="form-group">
                                <label for="newsCategory">Select a category</label>
                                <select name="categoryId" id="newsCategory" class="form-control">
                                    @forelse($categories as $item)
                                        <option @if ($item['id'] == old('category')) selected @endif
                                            value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                    @empty
                                        <option value="0" selected>Нет категории</option>
                                    @endforelse
                                </select>
                            </div>
                            <div><br></div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Download">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
