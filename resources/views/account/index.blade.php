@extends('layouts.sidebar')

@php
$sidetitle = 'Settings';
@endphp


@section('css')
<style>
    .thumbnail-profile {
        max-height: 250px;
        max-width: 250px;
        object-fit: cover;
        object-position: top;
    }

    #togglePassword {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-color: #ccc;
    }

    #togglePasswordConfirmation {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-color: #ccc;
    }
</style>
@endsection

@section('contents')


<div class="container-fluid">

    <div class="row mb-3">
        <div class="col">
            <h3>Hi, {{$data->name}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">

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

                            <div class="row mb-2">
                                <div class="col text-center">
                                    @if($data->photo == null)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="#adb5bd" class="bi bi-person-square" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
                                    </svg>
                                    @else
                                    <img src="{{asset('storage/profile-pic/'.auth()->user()->photo)}}" class="circle-image" alt="Circle Image" style="border-radius:8px;max-height:200px;max-width:200px;object-fit: cover;object-position: top;">
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-center g-1">
                                <div class="col-auto">
                                    <button class="btn btn-dark-blue btn-sm fw-bold px-5" data-bs-toggle="modal" data-bs-target="#modalPicture" style="border-radius: 8px;"><i class="bi bi-image-alt me-1"></i> Ganti Foto</button>
                                </div>
                                <div class="col-auto">
                                    <a href="/{{auth()->user()->role}}/profile/delete-profpic" class="btn btn-dark-blue btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete Profile Picture" style="border-radius: 8px;"><i class="bi bi-person-x-fill"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <div class="row mb-3">
                <div class="col">

                    <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                        <div class="card-body">


                            <form action="/{{auth()->user()->role}}/profile/update" id="deleteForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col text-end">
                                        <button class="btn btn-dark-blue fw-bold px-5" style="border-radius: 8px;"><i class="bi bi-arrow-repeat me-1"></i> Update</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" autocomplete="on" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="username" class="form-label fw-bold">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="{{$data->username}}" autocomplete="on" required>
                                            <input type="text" class="form-control" name="user_id" value="{{$data->id}}" hidden>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" autocomplete="on" required>
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>


            <div class="row mb-5">
                <div class="col">

                    <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                        <div class="card-body">

                            <button class="btn btn-dark px-5" data-bs-toggle="modal" data-bs-target="#modalPassword" style="border-radius: 8px;"><i class="bi bi-file-lock2-fill"></i> Ganti Password</button>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPicture" tabindex="-1" aria-labelledby="modalPictureLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="/{{auth()->user()->role}}/profile/update-profpic" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPictureLabel"><small>Profile Picture</small></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-3">
                    <div class="row">
                        <div class="col text-center">
                            <div id="imagePreview" class="mb-3"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-5 text-center">
                            <div class="mb-3">
                                <label for="imageUpload" class="form-label fw-bold">Upload foto profile</label>
                                <input class="form-control" type="file" id="imageUpload" name="imageUpload">
                                <label for="imageUpload" class="form-label text-muted">
                                    <small>Foto berformat jpg, jpeg, atau png</small>
                                </label>
                            </div>
                            <input type="text" name="user_id" value="{{$data->id}}" hidden>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-2 m-0 rounded-0 border-end"><strong>Save</strong></button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-2 m-0 rounded-0  text-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="/{{auth()->user()->role}}/profile/change-password" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPasswordLabel"><small>Change Password</small></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-3">
                    <div class="row justify-content-center">
                        <div class="col-md-5 col-sm-12 text-start">

                            <div class="form-group mb-3">
                                <label for="password" class="fw-bold">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" aria-label="Password" aria-describedby="togglePassword" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword" onclick="togglePasswordVisibility('password')">
                                            <span id="eyeIcon" class="fa fa-eye"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="passwordConfirmation" class="fw-bold">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm your password" aria-label="Confirm Password" aria-describedby="togglePasswordConfirmation" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirmation" onclick="togglePasswordVisibility('passwordConfirmation')">
                                            <span id="eyeIconConfirmation" class="fa fa-eye"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <input type="text" name="user_id" value="{{$data->id}}" hidden>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-2 m-0 rounded-0 border-end"><strong>Save</strong></button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-2 m-0 rounded-0  text-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('javascript')
<script>
    // Function to handle file selection and preview
    function handleFileSelect(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(event) {
            const imagePreview = document.getElementById("imagePreview");
            imagePreview.innerHTML = '';

            const imgElement = document.createElement("img");
            imgElement.setAttribute("src", event.target.result);
            imgElement.setAttribute("class", "thumbnail-profile");
            imagePreview.appendChild(imgElement);
        };

        reader.readAsDataURL(file);
    }

    // Add event listener for file selection
    const imageUpload = document.getElementById("imageUpload");
    imageUpload.addEventListener("change", handleFileSelect);
</script>

<!-- Add Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script>
    function togglePasswordVisibility(targetFieldId) {
        var passwordInput = document.getElementById(targetFieldId);
        var eyeIcon = document.getElementById(targetFieldId === 'password' ? 'eyeIcon' : 'eyeIconConfirmation');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>



@endsection
@endsection