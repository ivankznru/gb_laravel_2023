@extends('layouts.app')

@section('title', __('RequestInfo index '))

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('RequestInfo management ') }} </div>
                    <div class="card-body">
                        <table class="table">

                            <tbody>

                                @forelse ($requestInfo as $requestInfoItem)
                                    <tr style="vertical-align:middle">
                                        <th scope="row">
                                            <a class="nav-link text-secondary text-opacity-25"
                                                href="{{ route('requestInfo.edit', $requestInfoItem) }}">Пользователь:  {{ $requestInfoItem->title }}</a>
                                            <a class="nav-link"
                                               href="{{ route('requestInfo.edit', $requestInfoItem) }}">{{ $requestInfoItem->text }}</a>
                                            <a class="nav-link text-secondary text-opacity-25"
                                               href="{{ route('requestInfo.edit', $requestInfoItem) }}">Дата: {{ \Carbon\Carbon::parse($requestInfoItem->updated_at)->format('d.m.Y H:i:s')}} </a>
                                        </th>

                                        <td>
                                            <a href="{{ route('requestInfo.edit', $requestInfoItem) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('requestInfo.delete', $requestInfoItem) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td>No requestInfo</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $requestInfo->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
