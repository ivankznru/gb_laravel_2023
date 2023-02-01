@extends('layouts.app')

@section('title', __('Admin: categories list'))

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

                                @forelse ($categories as $category)
                                    <tr style="vertical-align:middle" >
                                        <th scope="row">

                                            <a class="nav-link"
                                                href="{{ route('admin.categories.edit', $category) }}">{{ $category->title }}</a>
                                        </th>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.categories.delete', $category) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td>No categories</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
