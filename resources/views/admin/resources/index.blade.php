@extends('layouts.app')

@section('title', __('Admin: resources list'))

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

                                @forelse ($resources as $resource)
                                    <tr>
                                        <th scope="row">

                                            <a class="nav-link"
                                                href="{{ route('admin.resources.edit', $resource) }}">{{ $resource->url }}</a>
                                        </th>
                                        <td>
                                            <a href="{{ route('admin.resources.edit', $resource) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.resources.destroy', $resource) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td>No resources</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $resources->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
