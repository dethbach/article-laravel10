@extends('layouts.sidebar')

@php
$sidetitle = 'Dashboard';
@endphp

@section('css')
<style>
    .feed-post {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        border: transparent;
        border-radius: 20px;
    }

    /* Define a keyframe animation named "shake" */
    @keyframes shake {
        0% {
            transform: translate(0, 0);
        }

        10% {
            transform: translate(5px, -5px);
        }

        20% {
            transform: translate(-5px, 5px);
        }

        30% {
            transform: translate(5px, -5px);
        }

        40% {
            transform: translate(-5px, 5px);
        }

        50% {
            transform: translate(5px, -5px);
        }

        60% {
            transform: translate(-5px, 5px);
        }

        70% {
            transform: translate(5px, -5px);
        }

        80% {
            transform: translate(-5px, 5px);
        }

        90% {
            transform: translate(5px, -5px);
        }

        100% {
            transform: translate(0, 0);
        }
    }

    /* Apply the animation to the image element when hovering */
    .shaking-image:hover {
        animation: shake 4s infinite;
    }
</style>
@endsection

@section('contents')

<div class="container-fluid">

    <div class="row g-2 mb-3">
        <div class="col-auto">
            <h3><span style="color: #fba83e;">Hi, </span>{{auth()->user()->name}}</h3>
        </div>
        <div class="col-auto">
            <img class="shaking-image" src="{{asset('storage/web-material/waving_hand_FILL0_wght400_GRAD0_opsz242.png')}}" width="30px">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                <div class="card-body">

                    <div class="row g-3">
                        <div class="col-md-8 col-sm-12">

                            @forelse($datas as $data)
                            <div class="card mb-3 feed-post">
                                <div class="card-body">

                                    <div class="container-fluid">
                                        <div class="row mb-3 g-2">
                                            <div class="col-auto">
                                                @if($data->articleUser->photo != null)
                                                @php
                                                $imageLastPostsPath = 'storage/profile-pic/'.$data->articleUser->photo;
                                                @endphp

                                                @if (file_exists(public_path($imageLastPostsPath)))
                                                <img src="{{ asset($imageLastPostsPath) }}" class="circle-image" alt="{{$data->articleUser->name}}" style="border-radius: 50%;height:45px;width:45px;object-fit: cover;object-position: top;">
                                                @else
                                                <div class="initial-pic">
                                                    <div class="letter">{{substr($data->articleUser->name, 0, 1)}}</div>
                                                </div>
                                                @endif

                                                @else
                                                <div class="initial-pic">
                                                    <div class="letter">{{substr($data->articleUser->name, 0, 1)}}</div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col align-self-center">
                                                <p class="fw-semibold mb-0">{{$data->articleUser->name}}</p>
                                                <p class="text-muted mb-0"><small>{!! date('d F \\a\\t h:i A', strtotime($data->created_at)) !!}</small></p>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-3">
                                            <div class="col-auto">
                                                <span class="badge blue-badge">{{$data->articleCategory->name}}</span>
                                            </div>
                                            <div class="col-auto">
                                                @if($data->status == true)
                                                <span class="badge green-badge">Publish</span>
                                                @else
                                                <span class="badge grey-badge">Draft</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col">
                                                <a href="/{{auth()->user()->role}}/posts/{{$data->slug}}" style="color: #265073;">
                                                    <b>{{$data->title}}</b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col">
                                                <small>
                                                    {{$data->meta_description}}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-auto">
                                                <a href="/{{auth()->user()->role}}/posts/{{$data->slug}}" style="color: #265073;">
                                                    <small>Read post
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z" />
                                                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z" />
                                                        </svg>
                                                    </small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col">
                                                @php
                                                $thumbnailPath = 'storage/thumbnail-article/'. $data->thumbnail;
                                                @endphp

                                                @if(file_exists(public_path($thumbnailPath)))
                                                <img src="{{ asset($thumbnailPath) }}" height="200px" width="300px" style="border-radius: 10px;">
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            @empty

                            <div class="card mb-3 feed-post">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row mb-3">
                                            <div class="col text-center">
                                                <img src="{{asset('storage/web-material/undraw_tree_swing_re_pqee.svg')}}" alt="No Post" height="200px">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col text-center fw-bold">
                                                <span style="color: #2f2e41;">Article currently has no content or information to display.</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col text-center">
                                                <a href="/{{auth()->user()->role}}/write-post" class="btn btn-sm btn-dark-blue px-5 fw-bold shadow-sm">Be the first person to write the article <i class="bi bi-feather"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse

                            <div class="row mt-4">
                                <div class="col text-center">
                                    <a href="/{{auth()->user()->role}}/posts" class="btn btn-sm fw-bold px-4" style="background-color: #F0F0F0;color:#3C486B;border-radius:8px;">
                                        <i class="bi bi-arrow-repeat"></i> Load More Posts
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 col-sm-12">


                            <div class="card sticky-top mb-3 shadow-sm" style="border: transparent;border-radius:10px;">
                                <div class="card-body">
                                    <h5 class="fw-bold text-muted mb-4"><i class="bi bi-trophy-fill" style="color: #00B0FF;"></i> Top Contributor</h5>
                                    @php $i = 1; @endphp
                                    @foreach($topAuthor as $topAuthors)
                                    <a href="/{{auth()->user()->role}}/account/{{$topAuthors->username}}">
                                        <div class="row g-3 mb-3">
                                            <div class="col-2 align-self-center">
                                                <div class="fw-bold text-muted">
                                                    <span style="font-size: larger;font-weight: 900;color:#ccc">0{{$i++}}.</span>
                                                </div>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                @if($topAuthors->photo != null)
                                                @php
                                                $imageTopAuthorPath = 'storage/profile-pic/'.$topAuthors->photo;
                                                @endphp

                                                @if (file_exists(public_path($imageTopAuthorPath)))
                                                <img src="{{ asset($imageTopAuthorPath) }}" class="circle-image" alt="Circle Image" style="border-radius: 50%;height:35px;width:35px;object-fit: cover;object-position: top;">
                                                @else
                                                <div class="initial-pic-sm">
                                                    <div class="letter">{{substr($topAuthors->name, 0, 1)}}</div>
                                                </div>
                                                @endif

                                                @else
                                                <div class="initial-pic-sm">
                                                    <div class="letter">{{substr($topAuthors->name, 0, 1)}}</div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <p class="fw-semibold mb-0">{{$topAuthors->name}} <small>({{$topAuthors->articles_count}})</small></p>
                                                <p class="mb-0"><small><span>@</span>{{$topAuthors->username}}</small></p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection