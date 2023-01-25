@extends('layouts.app')

@section('title', __('Comments index '))

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Comments management ') }} </div>
                    <div class="card-body">
                        <div class="card-body">
                            <form action="{{url('/comments/store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="newsTitle">User's name</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Full Name">
                                </div>
                                <div class="mb-3">
                                    <label for="newsText">Comment</label>
                                    <textarea name="text" id="text" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-outline-primary" value="Save" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
