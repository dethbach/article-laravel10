@extends('layouts.sidebar')

@php
$sidetitle = 'Settings';
@endphp


@section('css')
<style>
    .card-article-post {
        background-color: #e6f7f5;
        color: #34bfad;
        border-color: transparent;
        border-radius: 20px;
    }

    .card-article-draft {
        background-color: #ecf2ff;
        color: #668bff;
        border-color: transparent;
        border-radius: 20px;
    }
</style>
@endsection

@section('contents')


<div class="container-fluid">

    <div class="row mb-0">
        <div class="col">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/{{auth()->user()->role}}/account"><i class="bi bi-house-fill"></i> Accounts</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>@</span>{{$data->username}}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">


            <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                <div class="card-body">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-auto mb-3">
                                @if($data->photo != null)
                                @php
                                $imageProfilePath = 'storage/profile-pic/'.$data->photo;
                                @endphp

                                @if (file_exists(public_path($imageProfilePath)))
                                <img src="{{ asset($imageProfilePath) }}" alt="Photo {{$data->name}}" height="100px" width="100px" style="border-radius: 50%;object-fit: cover;object-position: top;">
                                @else
                                <div class="initial-pic-lg">
                                    <div class="letter">{{substr($data->name, 0, 1)}}</div>
                                </div>
                                @endif

                                @else
                                <div class="initial-pic-lg">
                                    <div class="letter">{{substr($data->name, 0, 1)}}</div>
                                </div>
                                @endif
                            </div>
                            <div class="col align-self-center mb-3">
                                <h3 class="mb-0" style="color: #352F44;">{{$data->name}}</h3>
                                <p class="fw-semibold mb-0" style="color: #5C5470;"><span>@</span>{{$data->username}}</p>
                            </div>

                            <div class="col-md-auto col-sm-12 mb-3">
                                <a href="/{{auth()->user()->role}}/author/{{$data->id}}/{{$data->name}}/publish" target="_blank">
                                    <div class="card card-article-post shadow-sm">
                                        <div class="card-body text-center">
                                            <h1 class="fw-bold mb-0">
                                                <div id="article-post-sum"></div>
                                            </h1>
                                            <p class="mb-0">Article Post</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-auto col-sm-12 mb-3">
                                <a href="/{{auth()->user()->role}}/author/{{$data->id}}/{{$data->name}}/draft" target="_blank">
                                    <div class="card card-article-draft shadow-sm">
                                        <div class="card-body text-center">
                                            <h1 class="fw-bold mb-0">
                                                <div id="article-draft-sum"></div>
                                            </h1>
                                            <p class="mb-0">Article Draft</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <div class="row mb-3">
        <div class="col">



            <div class="container-fluid px-0">
                <div class="row g-3">
                    <div class="col-md-8 col-sm-12">

                        <div class="card shadow-sm mb-3" style="border: transparent;border-radius:8px;">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-md-3 col-sm-4 fw-bold">
                                        Name
                                    </div>
                                    <div class="col">
                                        <small>{{$data->name}}</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 col-sm-4 fw-bold">
                                        Username
                                    </div>
                                    <div class="col">
                                        <small><span>@</span>{{$data->username}}</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 col-sm-4 fw-bold">
                                        Email
                                    </div>
                                    <div class="col">
                                        <small>{{$data->email}}</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 col-sm-4 fw-bold">
                                        Role
                                    </div>
                                    <div class="col">
                                        <span class="badge green-badge" data-bs-toggle="modal" data-bs-target="#modalRole">
                                            {{strtoupper($data->role)}}
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card shadow-sm mb-3" style="border: transparent;border-radius:8px;">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <h4 class="fw-bold text-muted mb-4"><i class="bi bi-stickies" style="color: #34bfad;"></i> Latest Post</h4>
                                    </div>
                                </div>

                                @forelse($posts as $post)
                                @php $title = strlen($post->title); @endphp
                                <div class="row mb-3 g-2">
                                    <div class="col-auto">
                                        @if($post->status == true)
                                        <span class="badge green-badge" style="width: 70px;">Post</span>
                                        @else
                                        <span class="badge blue-badge" style="width: 70px;">Draft</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <a href="/{{auth()->user()->role}}/posts/{{$post->slug}}" target="_blank">
                                            <p class="mb-0">
                                                @if ($title >= 60)
                                                {{ mb_substr($post->title, 0, 60) . ' ...' }}
                                                @else
                                                <small>{{$post->title}}</small>
                                                @endif
                                            </p>
                                            <p class="mb-0 text-muted"><small>{!! date('d F Y', strtotime($post->created_at)) !!}</small></p>
                                        </a>
                                    </div>
                                </div>

                                @empty

                                <div class="row mb-3">
                                    <div class="col text-center">
                                        <img src="{{asset('storage/web-material/undraw_tree_swing_re_pqee.svg')}}" alt="empty post" height="200px">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col fw-bold text-muted text-center">
                                        <span style="color: #00B0FF;"><span>@</span>{{$data->username}}</span> haven't uploaded any articles yet
                                    </div>
                                </div>
                                @endforelse

                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-12">

                        <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                            <div class="card-body">
                                <h4 class="fw-bold text-muted mb-4"><i class="bi bi-people-fill" style="color: #00B0FF;"></i> Users</h4>
                                @foreach($users as $user)
                                <a href="/{{auth()->user()->role}}/account/{{$user->username}}">
                                    <div class="row g-2 mb-3">
                                        <div class="col-auto">

                                            @if($user->photo != null)
                                            @php
                                            $imageUserPath = 'storage/profile-pic/'.$user->photo;
                                            @endphp

                                            @if (file_exists(public_path($imageUserPath)))
                                            <img src="{{ asset($imageUserPath) }}" alt="" style="width: 45px; height: 45px" class="rounded-circle" style="border-radius: 50%;object-fit: cover;object-position: top;" />
                                            @else
                                            <div class="initial-pic">
                                                <div class="letter">{{substr($user->name, 0, 1)}}</div>
                                            </div>
                                            @endif

                                            @else
                                            <div class="initial-pic">
                                                <div class="letter">{{substr($user->name, 0, 1)}}</div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <p class="fw-semibold mb-0">{{$user->name}}</p>
                                            <p class="mb-0"><small><span>@</span>{{$user->username}}</small></p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                <div class="row mb-0">
                                    <div class="col text-end border-top">
                                        <a href="/{{auth()->user()->role}}/account" style="color: #00B0FF;">
                                            <small>View More</small>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-arrow-up-right-square" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<div class="modal fade" id="modalRole" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="/{{auth()->user()->role}}/account/role-update" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col text-center text-warning">

                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>

                            <input type="text" name="userRoleId" value="{{$data->id}}" hidden>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center fw-bold">
                            <h4>Please confirm the role adjustment for <span style="color: #00B0FF;"><span>@</span>{{$data->username}}</span>?</h4>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-center fw-bold text-secondary">
                            <span class="badge grey-badge">{{strtoupper($data->role)}}</span> to @if($data->role == 'admin') <span class="badge blue-badge">USER</span> @else <span class="badge blue-badge">ADMIN</span> @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit" type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Confrim</strong></button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 text-muted" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('javascript')
<script>
    $(document).ready(function() {
        var theId = '{{$data->id}}';
        var sumPost = $('#article-post-sum');

        function fetchSumArticle() {
            $.ajax({
                url: '/admin/get-sum-article/' + theId,
                method: 'GET',
                success: function(data) {
                    sumPost.empty().append(data);
                }
            });
        }
        fetchSumArticle();
        setInterval(fetchSumArticle, 3000);
    });
</script>

<script>
    $(document).ready(function() {
        var theId = '{{$data->id}}';
        var sumDraft = $('#article-draft-sum');

        function fetchSumArticle() {
            $.ajax({
                url: '/admin/get-sum-draft/' + theId,
                method: 'GET',
                success: function(data) {
                    sumDraft.empty().append(data);
                }
            });
        }
        fetchSumArticle();
        setInterval(fetchSumArticle, 3000);
    });
</script>
@endsection

@endsection