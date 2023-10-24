@extends('layouts.article')
@section('content')

<div class="container mb-5" style="padding-top: 6rem;">
    <div class="row justify-content-center mb-5 pt-4 g-1">
        @foreach($headerright as $rightheader)
        <div class="col-md-8 col-sm-12">
            <div class="post post-thumb">
                <a class="frame-img" href="/{{$rightheader->slug}}">
                    <img src="{{asset('storage/thumbnail-article/'.$rightheader->thumbnail)}}" alt="" class="img-thumbnail-left">
                </a>
                <div class="caption">
                    <span class="badge green-badge">{{$rightheader->articleCategory->name}}</span>
                    <a href="/{{$rightheader->slug}}">
                        <h3>{{$rightheader->title}}</h3>
                    </a>
                    <p class="text-light"> <b>{{$rightheader->articleUser->name}}</b> <i class="bi bi-dot"></i> <small>{{date('d F Y', strtotime($rightheader->created_at));}}</small></p>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-4 col-sm-12">

            @foreach($headerleft as $leftheader)
            <div class="row pb-1">
                <div class="col">
                    <div class="post post-thumb">
                        <a class="frame-img" href="/{{$leftheader->slug}}">
                            <img src="{{asset('storage/thumbnail-article/'.$leftheader->thumbnail)}}" alt="" class="img-thumbnail-right">
                        </a>
                        <div class="caption">
                            <span class="badge green-badge">{{$leftheader->articleCategory->name}}</span>
                            <a href="/{{$leftheader->slug}}">
                                <h5>{{$leftheader->title}}</h5>
                            </a>
                            <p class="text-light"> <b>{{$leftheader->articleUser->name}}</b> <i class="bi bi-dot"></i> <small>{{date('d F Y', strtotime($leftheader->created_at));}}</small></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>

    @if($finder != null)
    <div class="row mb-3">
        <div class="col-auto">
            <a href="/article" style="color:currentColor;">
                <span class="badge green-badge mb-2">Keyword: {{$finder}} <i class="bi bi-x-circle ms-4"></i></span>
            </a>
            <hr>
        </div>
    </div>
    @endif

    <div class="row d-block d-sm-block d-md-none">
        <div class="col">
            <div class="card" style="background-color: #EFF5F5;border-color:#EFF5F5;">
                <div class="card-body">
                    <form action="/article" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="card-title mb-3">
                            <h4>Search</h4>
                        </div>
                        <div class="input-group mb-2">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Write title here ..." aria-label="Write title here ..." aria-describedby="button-addon2" style="border:solid 1px #2fd1d6;">
                            <button class="btn" type="submit" id="button-addon2" style="background-color: #182627;color:#2fd1d6;border-color:#2fd1d6;"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-1">
        <div class="col-md-8 col-sm-12 col-sm-last">

            @foreach($datas as $data)
            <div class="row mx-auto mb-4 g-4 pe-2">
                <div class="col-auto">
                    <div class="post">
                        <a class="frame-img" href="/{{$data->slug}}">
                            <img src="{{asset('storage/thumbnail-article/'.$data->thumbnail)}}" alt="" class="img-wrapper">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <span class="badge green-badge mb-2">{{$data->articleCategory->name}}</span>
                    <a href="/{{$data->slug}}" style="color: black;">
                        <h5>{{$data->title}}</h5>
                    </a>
                    <p class="text-muted"> <b>{{$data->articleUser->name}}</b> <i class="bi bi-dot"></i> <small>{{date('d F Y', strtotime($data->created_at));}}</small></p>
                    <?php $title = strlen($data->meta_description); ?>

                    @if ($title >= 150)
                    {{ mb_substr($data->meta_description, 0, 150) . ' ...' }}
                    @else
                    {!! $data->meta_description !!}
                    @endif
                </div>
            </div>
            @endforeach


            <div class="row mt-5">
                {{ $datas->links('layouts.custom_pagination') }}
            </div>

        </div>
        <div class="col-md-4 col-sm-12 col-sm-first">
            <div class="sticky-top" style="top: 90px;z-index:1;">
                <div class="row">
                    <div class="col">
                        <div class="card" style="background-color: #EFF5F5;border-color:#EFF5F5;">
                            <div class="card-body">
                                <form action="/article" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-title mb-3">
                                        <h4>Search</h4>
                                    </div>
                                    <div class="input-group mb-2">
                                        <input type="text" id="searchmd" name="search" class="form-control" placeholder="Write title here ..." aria-label="Write title here ..." aria-describedby="button-addon2" style="border:solid 1px #2fd1d6;">
                                        <button class="btn" type="submit" id="button-addon2" style="background-color: #182627;color:#2fd1d6;border-color:#2fd1d6;"><i class="bi bi-search"></i></button>
                                    </div>
                                </form>
                                <hr>
                                <div class="card-title mb-2">
                                    <h4>Contact Us</h4>
                                </div>
                                <div class="mb-3">
                                    <i><small>Solusi Pengurusan Perizinan Anda</small></i>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <a href="https://wa.me/6281225113000">
                                        <button class="btn me-2" style="border-radius: 50%;background-color:#F8EDE3;">
                                            <i class="bi bi-whatsapp"></i>
                                        </button>
                                    </a>
                                    <a href="https://wa.me/6281901463500">
                                        <button class="btn me-2" style="border-radius: 50%;background-color:#B9EDDD;">
                                            <i class="bi bi-whatsapp text-dark"></i>
                                        </button>
                                    </a>
                                    <a href="/">
                                        <button class="btn me-2" style="border-radius: 50%;background-color:#87CBB9;">
                                            <i class="bi bi-envelope-at-fill" style="color:#fff;"></i>
                                        </button>
                                    </a>
                                    <a href="/">
                                        <button class="btn me-2" style="border-radius: 50%;background-color:#569DAA;">
                                            <i class="bi bi-facebook text-light"></i>
                                        </button>
                                    </a>
                                    <a href="/">
                                        <button class="btn me-2" style="border-radius: 50%;background-color:#577D86;">
                                            <i class="bi bi-instagram text-light"></i>
                                        </button>
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

@endsection