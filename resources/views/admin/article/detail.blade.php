@extends('layouts.sidebar')

@php
$sidetitle = 'Article';
@endphp


@section('css')

<!-- Trix Editor -->
<link rel="stylesheet" type="text/css" href="/storage/css/trix.css">
<script type="text/javascript" src="/storage/js/trix.js"></script>
<!-- <script type="text/javascript" src="/storage/js/attachments.js"></script> -->
<style>
    .trix-button-group.trix-button-group--file-tools {
        display: none;
    }
</style>

<style>
    /* Apply grayscale effect to the image only on hover */
    .thumbnail-container:hover .grayscale {
        filter: grayscale(100%);
    }

    /* Style the thumbnail container */
    .thumbnail-container {
        position: relative;
        display: inline-block;
    }

    /* Style the overlay */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.2s;
    }

    /* Style the Bootstrap icon */
    .overlay i {
        color: white;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    /* Style the overlay text */
    .overlay-text {
        color: white;
        font-size: 1rem;
    }

    /* Show overlay on hover */
    .thumbnail-container:hover .overlay {
        opacity: 1;
        cursor: pointer;
    }
</style>
@endsection

@section('contents')


<div class="container-fluid">

    <div class="row mb-3">
        <div class="col">
            <h3><span style="color: #fba83e;">Preview </span>Articles</h3>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/{{auth()->user()->role}}/posts">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Preview</li>
                </ol>
            </nav>
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

    <div class="row">
        <div class="col">


            <div class="card shadow-sm mb-3" style="border: transparent;border-radius:8px;">
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col">
                            <div class="card shadow-sm" style="border-color: #cfe2ff;">
                                <div class="card-body">
                                    <small class="mb-0 fw-semibold text-muted">Written by <span style="color: #224ba5;"><a href="/{{auth()->user()->role}}/account/{{$data->articleUser->username}}" target="_blank">{{$data->articleUser->name}}</a></span></small><br>
                                    @if($data->status == true)
                                    <small class="mb-0 fw-semibold text-muted">Published on <span style="color: #224ba5;">{!! date('d F Y, H:i', strtotime($data->created_at)) !!}</span></small>
                                    @else
                                    <small class="mb-0 fw-semibold text-muted">Drafted on <span style="color: #224ba5;">{!! date('d F Y, H:i', strtotime($data->created_at)) !!}</span></small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col">
                            <label for="thumbnail" class="form-label fw-semibold">Thumbnail</label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-5">
                            <div class="thumbnail-container" data-bs-toggle="modal" data-bs-target="#modalThumbnail">
                                <img src="{{asset('storage/thumbnail-article/'.$data->thumbnail)}}" alt="Thumbnail {{$data->title}}" class="grayscale" style="max-height:200px;max-width:200px;object-fit: cover;object-position: center;">
                                <div class=" overlay">
                                    <i class="bi bi-camera-fill mb-0"></i> <!-- Bootstrap icon -->
                                    <div class="overlay-text"><small>Change Thumbnail</small></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="/{{auth()->user()->role}}/update-article/{{$data->id}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Write title here" id="title" name="title" style="height: 100px;border:solid 2px #ccc;" required>{{$data->title}}</textarea>
                                <label for="title" style="color:#ccc"><small>Write title here</small></label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Body</label>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Write lead here" id="lead" name="lead" style="height: 170px;border:solid 2px #ccc;" required>{!!$data->lead!!}</textarea>
                                <label for="lead" style="color:#ccc"><small>Write lead here</small></label>
                            </div>
                            <div class="form-control" style="border:solid 2px #ccc;">
                                <input id="x" value="" type="hidden" name="content" required>
                                <trix-editor input="x" style="min-height: 300px;">
                                    {!!$data->body!!}
                                </trix-editor>
                            </div>
                        </div>

                        <div class="row mb-4 justify-content-center">
                            <div class="col">
                                <hr style="border:solid 4px #ccc">
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4" style="border:solid 2px #ccc;">
                            <div class="card-header fw-semibold">
                                Search Engine Optimization (SEO)
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="metaTitle" class="form-label"> <span class="fw-semibold text-muted">Meta Title</span><span class="text-danger">*</span></label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Write meta-title here" id="metaTitle" name="metaTitle" style="height: 120px;" required>{{$data->meta_title}}</textarea>
                                        <label for="metaTitle" style="color:#ccc"><small>Write meta-title here</small></label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="metaDesc" class="form-label"> <span class="fw-semibold text-muted">Meta Description</span><span class="text-danger">*</span></label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Write meta-description here" id="metaDesc" name="metaDesc" style="height: 150px;" required>{{$data->meta_description}}</textarea>
                                        <label for="metaDesc" style="color:#ccc"><small>Write meta-description here</small></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">Category</label>
                            <select class="form-select" size="4" id="category" name="category" aria-label="Select category" required>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if ($category->id == $data->category_id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <a href="/{{auth()->user()->role}}/categories" class="text-primary">
                                <small style="font-size: small;">Add new category <i class="bi bi-box-arrow-up-right" style="font-size: 8px;"></i></small>
                            </a>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-dark-blue px-5 fw-bold shadow-sm" style="border-radius: 10px;"><i class="bi bi-feather"></i> Save</button>
                        </div>
                    </form>

                </div>
            </div>


            <div class="card shadow-sm mb-4" style="border: transparent;border-radius:8px;">
                <div class="card-body">

                    <button class="btn btn-danger px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bi bi-exclamation-diamond-fill me-1"></i> Delete Article</button>

                </div>
            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="modalThumbnail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalThumbnailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/{{auth()->user()->role}}/update-thumbnail/{{$data->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-auto">
                                <img src="{{asset('storage/thumbnail-article/'. $data->thumbnail)}}" width="200" height="200" style="object-fit: cover;object-position: center;">
                            </div>
                            <div class="col">
                                <img class="img-preview img-fluid shadow" style="max-height:200px;max-width:200px;object-fit: cover;object-position: center;">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="title" id="title" rows="3" hidden>{{$data->title}}</textarea>
                        <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail" onchange="previewImage()" required>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit" type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Save</strong></button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 text-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="/{{auth()->user()->role}}/delete-article" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col text-center text-warning">

                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>

                            <input type="text" name="articleId" value="{{$data->id}}" hidden>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center fw-bold">
                            <h4>Delete Article?</h4>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col text-center fw-semibold">
                            {{$data->title}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col text-center fw-bold text-secondary">
                            You will not be able to recover it
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit" type="button" class="btn btn-lg btn-link fs-6 text-decoration-none text-danger col-6 m-0 rounded-0 border-right"><strong>Delete</strong></button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 text-muted" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('javascript')
<script>
    function previewImage() {
        const image = document.querySelector('#thumbnail');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection


@endsection