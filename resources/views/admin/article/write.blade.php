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
@endsection

@section('contents')


<div class="container-fluid">

    <div class="row mb-3">
        <div class="col">
            <h3><span style="color: #fba83e;">Write </span>New Post</h3>
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


            <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                <div class="card-body">

                    <form action="/{{auth()->user()->role}}/post-article" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <div class="row">
                                <div class="col-5">
                                    <label for="thumbnail" class="form-label fw-semibold">Thumbnail</label>
                                    <input class="form-control" type="file" id="thumbnail" name="thumbnail" onchange="previewImage()" required>
                                </div>
                                <div class="col-auto">
                                    <img class="img-preview img-fluid shadow" width="150" height="150" style="display: none;">
                                </div>
                                <div class="col align-self-center">
                                    <label class="form-label fw-semibold text-muted">
                                        <small>The uploaded image will be automatically resized to <span class="fw-bold" style="color:#fba83e;border-bottom: solid #383c4b 1px;">300x200 pixels</span> for optimal display. This ensures that your images fit seamlessly into our design and load quickly.</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Write title here" id="title" name="title" style="height: 100px;border:solid 2px #ccc;" required></textarea>
                                <label for="title" style="color:#ccc"><small>Write title here</small></label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Body</label>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Write lead here" id="lead" name="lead" style="height: 170px;border:solid 2px #ccc;" required></textarea>
                                <label for="lead" style="color:#ccc"><small>Write lead here</small></label>
                            </div>
                            <div class="form-control" style="border:solid 2px #ccc;">
                                <input id="x" value="" type="hidden" name="content" required>
                                <trix-editor input="x" style="min-height: 300px;"></trix-editor>
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
                                        <textarea class="form-control" placeholder="Write meta-title here" id="metaTitle" name="metaTitle" style="height: 120px;" required></textarea>
                                        <label for="metaTitle" style="color:#ccc"><small>Write meta-title here</small></label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="metaDesc" class="form-label"> <span class="fw-semibold text-muted">Meta Description</span><span class="text-danger">*</span></label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Write meta-description here" id="metaDesc" name="metaDesc" style="height: 150px;" required></textarea>
                                        <label for="metaDesc" style="color:#ccc"><small>Write meta-description here</small></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">Category</label>
                            <select class="form-select" size="4" id="category" name="category" aria-label="Select category" required>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <a href="/{{auth()->user()->role}}/categories" class="text-primary">
                                <small style="font-size: small;">Add new category <i class="bi bi-box-arrow-up-right" style="font-size: 8px;"></i></small>
                            </a>
                        </div>

                        <div class="mb-4">
                            <hr>
                        </div>

                        @if($cities->count() >= 1)
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="YES" id="duplicate" name="duplicate" style="border-color: #000;">
                                <label class="form-check-label fw-semibold" for="duplicate">
                                    Create Articles for <a href="/{{auth()->user()->role}}/cities" class="text-primary" target="_blank">{{$cities->count()}} Cities and Regencies</a>?
                                </label>
                            </div>
                        </div>
                        @endif

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="YES" id="publishNow" name="publishNow" style="border-color: #000;">
                                <label class="form-check-label fw-semibold" for="publishNow">
                                    Publish now?
                                </label>
                            </div>
                            <label class="form-check-label text-muted" for="publishNow">
                                <small><span class="fw-semibold" style="color:#fba83e;">'Publish Now'</span> to make it live for everyone to see.</small>
                            </label>
                        </div>

                        <div class=" mb-4">
                            <hr>
                        </div>

                        <div class="mb-3 text-center">
                            <button class="btn btn-dark-blue px-5 fw-bold shadow-sm" style="border-radius: 10px;"><i class="bi bi-feather"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>

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
            // Create a temporary image element
            const tempImage = new Image();
            tempImage.src = oFREvent.target.result;

            tempImage.onload = function() {
                // Resize the image to 300x200 pixels
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 300;
                canvas.height = 200;
                ctx.drawImage(tempImage, 0, 0, 300, 200);

                // Set the resized image as the source for the preview
                imgPreview.src = canvas.toDataURL('image/jpeg'); // You can specify the desired format (e.g., 'image/jpeg')
            };
        };
    }
</script>
@endsection

@endsection