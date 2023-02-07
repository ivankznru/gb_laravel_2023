@extends('layouts.app')

@section('title', $user->id ? __('Modify the user') : __('Add a new user'))

@section('menu')
    @include('admin.menu')
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if ($user->id)
                            {{ __('Modify the user #') . $user->id }}
                        @else
                            {{ __('Add a new user') }}
                        @endif
                    </div>
                    <div class="card-body">
                        <form
                            action="@if (!$user->id) {{ route('admin.users.store') }}@else{{ route('admin.users.update', $user) }} @endif"
                            method="post">
                            @csrf
                            @if ($user->id)
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger" role="alert">
                                            @foreach ($errors->get('name') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') ?? $user->name }}" autofocus>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail </label>

                                <div class="col-md-6">
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger" role="alert">
                                            @foreach ($errors->get('email') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                    <input id="email" type="text" class="form-control" name="email"
                                        value="{{ old('email') ?? $user->email }}">


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    @if ($user->id)
                                        New password
                                        <br> (leave it blank if don't want to change)
                                    @else
                                        Password
                                    @endif

                                </label>

                                <div class="col-md-6">
                                    @if ($errors->has('newPassword'))
                                        <div class="alert alert-danger" role="alert">
                                            @foreach ($errors->get('newPassword') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                    <input id="password-confirm" type="password" class="form-control" name="newPassword">
                                </div>
                            </div>

                            <div class="form-check">
                                @if ($errors->has('is_admin'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('is_admin') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input @if ($user->is_admin == 1 || old('is_admin') == 1) checked @endif id="newsPrivate" name="is_admin"
                                    type="checkbox" value="1" class="form-check-input">
                                <label for="newsPrivate">Is admin?</label>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">

                                        {{ $user->id ? 'Update profile' : 'Add user' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
