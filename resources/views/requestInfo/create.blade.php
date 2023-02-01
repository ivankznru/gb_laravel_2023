@extends('layouts.app')

@section('title', $requestInfo->id ? __('Modify the requestInfo') : __('Add a new requestInfo'))

@section('menu')
    @include('menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if ($requestInfo->id)
                            {{ __('Modify the requestInfo item #') . $requestInfo->id }}
                        @else
                            {{ __('Add a new requestInfo item') }}
                        @endif
                    </div>
                    <div class="card-body">
                        <form
                            action="@if (!$requestInfo->id) {{ route('requestInfo.create') }}@else{{ route('requestInfo.update', $requestInfo) }} @endif"
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
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Name"
                                       value="{{ $requestInfo->title ?? old('title') }}">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" >Phone Number</label>
                                @if ($errors->has('text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('phoneNumber') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="tel" name="phoneNumber" class="form-control" id="phoneNumber" maxlength="50"
                                       autofocus="autofocus" required="required"
                                       pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}"
                                       placeholder="+7(XXX)XXX-XX-XX"  aria-describedby="phoneHelp" value="{{ $requestInfo->phoneNumber ?? old('phoneNumber') }}">
                                <div id="phoneHelp" class="form-text">We'll never share your telephone number with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" >Email address</label>
                                @if ($errors->has('text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('email') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $requestInfo->email ?? old('email') }}">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="newsText">Write your request here</label>
                                @if ($errors->has('text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('text') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <textarea name="text" id="text" class="form-control">{{ $requestInfo->text ?? old('text') }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary"  value="{{ $requestInfo->id ? 'Update' : 'Add' }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
