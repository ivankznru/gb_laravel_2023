@extends('layouts.app')

@section('url', $resource->id ? __('Modify the resource') : __('Add a new resource'))

@section('menu')
    @include('admin.menu')
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if ($resource->id)
                            {{ __('Modify the resource #') . $resource->id }}
                        @else
                            {{ __('Add a new resource') }}
                        @endif
                    </div>
                    <div class="card-body">
                        <form
                            action="@if (!$resource->id) {{ route('admin.resources.store') }}@else{{ route('admin.resources.update', $resource) }} @endif"
                            method="post">
                            @csrf
                            @if($resource->id) @method('PUT') @endif
                            <div class="form-group">
                                <label for="url">URL</label>
                                @if ($errors->has('url'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('url') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="url" id="url" class="form-control"
                                    value="{{ $resource->url ?? old('url') }}">
                            </div>

                            <div class="form-group">
                                <label for="map">A map for the news</label>
                                @if ($errors->has('map'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('map') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <textarea name="map" id="map" class="form-control">{{ $resource->map ?? old('map') }}</textarea>
                                <ckeditor-component></ckeditor-component>                                
                                
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary"
                                    value="{{ $resource->id ? 'Update' : 'Add' }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
