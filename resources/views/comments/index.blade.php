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
                        <table class="table">

                            <tbody>

                                @forelse ($comments as $commentsItem)
                                    <tr style="vertical-align:middle">
                                        <th scope="row" >

                                            <a class="nav-link text-secondary text-opacity-25"
                                                href="{{ route('comments.edit', $commentsItem) }}">Пользователь:  {{ $commentsItem->title }}</a>
                                            <a class="nav-link"
                                            href="{{ route('comments.edit', $commentsItem) }}">{{ $commentsItem->text }}</a>
                                            <a class="nav-link text-secondary text-opacity-25"
                                               href="{{ route('comments.edit', $commentsItem) }}">Дата:  {{ \Carbon\Carbon::parse($commentsItem->updated_at)->format('d.m.Y H:i:s')}}</a>
                                        </th>
                                        <td>
                                            <a href="{{ route('comments.edit', $commentsItem) }}" class="btn btn-success" >
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('comments.delete', $commentsItem) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No comments</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
