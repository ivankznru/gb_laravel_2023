@extends('layouts.app')

@section('title', __('Admin: users list'))

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Сategories management ') }} </div>
                    <div class="card-body">
                        <table class="table">

                            <tbody>

                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">

                                            <a class="nav-link"
                                                href="{{ route('admin.users.edit', $user) }}">{{ $user->name }}</a>
                                        </th>
                                        <td>@if ($user->isAdmin())
                                            
                                                is administrator
                                            
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td>No users</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
