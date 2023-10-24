@extends('layouts.sidebar')

@php
$sidetitle = 'Article';
@endphp

@section('contents')

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col">
            <h3>Articles</h3>
            @if($category != null)
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/{{auth()->user()->role}}/posts">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
                </ol>
            </nav>
            @endif
        </div>
    </div>


    @if ($errors->any())
    <div class="row px-3 mb-3">
        <div class="alert alert-danger alert-block">
            @foreach ($errors->all() as $error)
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle pb-1" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
            </svg> <strong>{{ $error }}</strong><br>
            @endforeach
        </div>
    </div>
    @endif

    @if ($message = Session::get('success'))
    <div class="row px-3 mb-3">
        <div class="alert alert-success alert-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check pb-1" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
            </svg> <strong>{{ $message }}</strong>
        </div>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="row px-3 mb-3">
        <div class="alert alert-danger alert-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle pb-1" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
            </svg> <strong>{{ $message }}</strong>
        </div>
    </div>
    @endif

    <div class="row mb-3">
        <div class="col">

            <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                <div class="card-body">
                    <table class="table table-hover" id="table-articles">
                        <thead>
                            <tr class="table-primary">
                                <th style="width: 5%;">#</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($datas as $data)
                            @php $title = strlen($data->title); @endphp
                            <tr>
                                <td class="fw-bold">{{$i++}}.</td>
                                <td>
                                    <a href="/{{auth()->user()->role}}/author/{{$data->articleUser->id}}/{{$data->articleUser->name}}">
                                        <small>{{$data->articleUser->name}}</small>
                                    </a>
                                </td>
                                <td>
                                    <a href="/{{auth()->user()->role}}/posts/{{$data->slug}}">
                                        @if ($title >= 50)
                                        {{ mb_substr($data->title, 0, 50) . ' ...' }}
                                        @else
                                        <small>{{$data->title}}</small>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="/{{auth()->user()->role}}/categories/{{$data->articleCategory->slug}}">
                                        <span class="badge blue-badge">{{$data->articleCategory->name}}</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="/{{auth()->user()->role}}/posts/{{$data->id}}/publish">
                                        @if($data->status == true)
                                        <span class="badge green-badge">Publish</span>
                                        @else
                                        <span class="badge grey-badge">Unpublish</span>
                                        @endif
                                    </a>
                                </td>
                                <td><small>{!! date('d F Y', strtotime($data->created_at)) !!}</small></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



</div>


@section('javascript')

<script>
    $(document).ready(function() {
        $('#table-articles').DataTable({
            "bInfo": false,
        });
    });
</script>

<!-- Data Table -->
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
@endsection

@endsection