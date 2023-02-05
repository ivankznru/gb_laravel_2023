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
                                            <a href="{{ route('admin.news.edit', $newsItem) }}" class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-danger delete" rel="{{ $newsItem->id }}" >Delete</a>
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
@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function (){
            let elements =document.querySelectorAll(".delete");
            elements.forEach(function (e, k){
                e.addEventListener("click", function(){
                    const id = this.getAttribute('rel');
                    if(confirm(`Подтверждаете удаление записи с #ID = ${id}`)){
                        send(`/admin/news/${id}`).then(() => {
                            location.reload();
                        });
                    } else {
                        alert("Удаление отменено");
                    }
                });
            });
        });

        async function send(url){
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })

            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
