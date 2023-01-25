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
                    <div class="card-header">{{ __('Requests management ') }} </div>
                    <div class="card-body">
                        <div class="card-body">
                            <form action="{{url('/requestInfo/store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="newsTitle">User's name</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="mb-3">
                                    <label for="phoneNumber" >Phone Number</label>
                                    <input type="tel" name="phoneNumber" class="form-control" id="phoneNumber" maxlength="50"
                                           autofocus="autofocus" required="required"
                                           pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}"
                                           placeholder="+7(XXX)XXX-XX-XX"  aria-describedby="phoneHelp">
                                    <div id="phoneHelp" class="form-text">We'll never share your telephone number with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" >Email address</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="newsText">Write your request here</label>
                                    <textarea name="text" id="text" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
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

