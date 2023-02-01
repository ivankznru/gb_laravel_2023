@extends('layouts.app')

@section('title', __('Admin: news list '))

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('News management ') }} </div>
                    <div class="card-body">
                        <table class="table">

                            <tbody>

                                @forelse ($news as $newsItem)
                                    <tr style="vertical-align:middle">
                                        <th scope="row">

                                            <a class="nav-link"
                                                href="{{ route('admin.news.edit', $newsItem) }}">{{ $newsItem->title }}</a>
                                        </th>
                                        <td>
                                            <a href="{{ route('admin.news.edit', $newsItem) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.news.delete', $newsItem) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td>No news</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
