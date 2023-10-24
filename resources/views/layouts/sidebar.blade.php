<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sidebar</title>
    <link rel="icon" type="image/png" href="{{asset('storage/web-material/logo.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{asset('storage/css/sidebar.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('css')

    <style>
        .choose-card:hover {
            background-color: #eee;
            color: #002e94;
        }
    </style>


</head>

<body>

    <!-- NAVBAR -->
    <header class="border-bottom p-3 shadow-sm">
        <div class="container-fluid px-4">
            <div class="row g-2">
                <div class="mb-md-0 mb-sm-2 col-md-2 col-sm-12">
                    <div class="d-flex justify-content-between">
                        <a href="/{{auth()->user()->role}}/dashboard" class="align-items-center text-decoration-none">
                            <img src="{{ asset('storage/web-material/icon.png') }}" alt="logo" width="auto" height="35">
                        </a>

                        <button class="btn btn-dark btn-sm d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- <div class="mb-md-0 mb-sm-2 col-md-5 col-sm-12">
                    <form action="/{{auth()->user()->role}}/detail-customer" method="POST" style="width:100%;">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Customer's name, nik, or phone" name="search" id="search" aria-label="Customer's name" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2" style="border-color: #ccc;" require>
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="mb-md-0 mb-sm-2 col-1">
                    <button type="button" class="btn btn-outline-light text-dark" type="button" data-bs-toggle="modal" data-bs-target="#modalSearch" style="border-radius: 50%;">
                        <i class="bi bi-sliders"></i>
                    </button>
                </div> -->
                <div class="mb-md-0 mb-sm-2 col">

                    <div class="d-flex justify-content-end">

                        <!-- <div class="dropdown px-3">
                            <button type="button" class="btn btn-light position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 50%;">
                                <i class="bi bi-bell" style="font-size: larger;"></i>
                                <div id="span_notif" class="span_notif">

                                </div>
                            </button>
                            <ul class="dropdown-menu animated dropdown-menu-lg">
                                <div class="container-fluid px-2">
                                    <div class="row mt-2">
                                        <div class="col">
                                            <h5 class="fw-bold" style="color: #002e94;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell-fill pb-1" viewBox="0 0 16 16">
                                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                                                </svg> Notifikasi
                                            </h5>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div id="notif-loading" class="notif-loading">

                                                <div class="text-center py-3">
                                                    <div class="spinner-border" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="notif-content" class="notif-content"></div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div> -->

                        <div class="d-flex align-self-center">
                            <div class="dropdown align-self-center text-end">
                                <a href="#" class="d-block link-dark text-decoration-none fw-semibold" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="row g-2">
                                        <div class="col-auto align-self-center">
                                            @if(auth()->user()->photo != null)
                                            <img src="{{asset('storage/profile-pic/'.auth()->user()->photo)}}" class="circle-image" alt="Circle Image" style="border-radius: 50%;height:35px;width:35px;object-fit: cover;object-position: top;">
                                            @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#ccc" class="bi bi-person-circle main-txtcolor" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                            </svg>
                                            @endif
                                        </div>
                                        <div class="col text-start">
                                            <h5 class="my-0 fw-bold"><small>{{auth()->user()->username}}</small></h5>
                                            <p class="my-0 text-muted" style="font-size: smaller;">{{strtoupper(auth()->user()->role)}}</p>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu animated text-small">
                                    <li>
                                        <a class="dropdown-item" href="/{{auth()->user()->role}}/account">Akun</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                            {{ __('Sign out') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
            </div> -->
        </div>
    </header>

    <!-- END NAVBAR -->
    <div class="container-fluid dashboard-content ps-0">
        <div class="row">
            <div class="col-auto dashboard-sidebar ps-2">
                <div class="offcanvas-lg offcanvas-start sidebar-custom " tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasResponsiveLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body px-0 py-0">
                        <!-- SIDEBAR -->
                        <div class="flex-shrink-0 p-3 navbar-expand-md vh-100 sticky-top">
                            <ul class="list-unstyled ps-0">

                                <li class="mb-1">
                                    <a type="button" href="/{{auth()->user()->role}}/dashboard" class="btn @if($sidetitle == 'Dashboard') active-sidebar @endif btn-non-toggle d-inline-flex align-items-center rounded border-0 fw-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house me-2" viewBox="0 0 16 16">
                                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                                        </svg>
                                        Dashboards
                                    </a>
                                </li>

                                <li class="mb-1">
                                    <button class="btn btn-non-toggle @if($sidetitle == 'Article') active-sidebar @endif d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-journals me-2" viewBox="0 0 16 16">
                                            <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z" />
                                            <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z" />
                                        </svg>
                                        Article
                                    </button>
                                    <div class="collapse" id="dashboard-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <li><a href="/{{auth()->user()->role}}/categories" class="btn-non-toggle d-inline-flex text-decoration-none fw-semibold align-items-center rounded ps-4 mt-1"><i class="bi bi-tags-fill me-2"></i> Categories</a></li>
                                            <li><a href="/{{auth()->user()->role}}/write-post" class="btn-non-toggle d-inline-flex text-decoration-none fw-semibold align-items-center rounded ps-4 mt-1"><i class="bi bi-feather me-2"></i> Add New</a></li>
                                            <li><a href="/{{auth()->user()->role}}/posts" class="btn-non-toggle d-inline-flex text-decoration-none fw-semibold align-items-center rounded ps-4 mt-1"><i class="bi bi-file-earmark-post me-2"></i> All Posts</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="mb-1">
                                    <button class="btn btn-non-toggle @if($sidetitle == 'Settings') active-sidebar @endif d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-settings" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-gear me-2" viewBox="0 0 16 16">
                                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                        </svg>
                                        Settings
                                    </button>
                                    <div class="collapse" id="dashboard-settings">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <li><a href="/{{auth()->user()->role}}/cities" class="btn-non-toggle d-inline-flex text-decoration-none fw-semibold align-items-center rounded ps-4 mt-1"><i class="bi bi-globe-americas me-2"></i> Cities</a></li>
                                            <li><a href="/{{auth()->user()->role}}/profile" class="btn-non-toggle d-inline-flex text-decoration-none fw-semibold align-items-center rounded ps-4 mt-1"><i class="bi bi-person-lines-fill me-2"></i> Profile</a></li>
                                            <li><a href="/{{auth()->user()->role}}/account" class="btn-non-toggle d-inline-flex text-decoration-none fw-semibold align-items-center rounded ps-4 mt-1"><i class="bi bi-person-vcard-fill me-2"></i> Account</a></li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <!-- END SIDEBAR -->
                    </div>
                </div>

            </div>

            <div class="col" style="overflow-x: auto;">
                <div class="mt-3">
                    @yield('contents')
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <!-- <div class="modal fade" id="modalSearch" tabindex="-1" aria-labelledby="modalSearchLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="/{{auth()->user()->role}}/service/search" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalSearchLabel"><small>Cari berdasarkan Nomor Nota</small></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-3">
                        <div class="row justify-content-center">
                            <div class="col text-center">

                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12">
                                <input type="number" class="form-control" id="nomor_nota" name="nomor_nota" placeholder="Masukan nomor nota" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-nowrap p-0">
                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-2 m-0 rounded-0 border-end"><strong>Cari</strong></button>
                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-2 m-0 rounded-0  text-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    @yield('javascript')

    <!-- <script>
        $(document).ready(function() {
            setInterval(function() {
                $.getJSON('/get-notif', function(response) {
                    // Update the HTML elements with the new data
                    $('.notif-content').empty(); // Clear existing data
                    $('.span_notif').empty(); // Clear existing data
                    var notifLoading = document.getElementById("notif-loading");

                    if (response.length > 0) {
                        notifLoading.style.display = "none";
                        // Data is not null
                        $('.span_notif').append('<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill notif-color mt-2">' + response.length + '</span>');
                        $.each(response, function(index, data) {
                            $('.notif-content').append('<a class="dropdown-item notification-item fw-bold" onClick="readNotif(' + data.id + ')" href="' + data.detail_notif.link + '">' + data.detail_notif.message + '</a>');
                        });
                    } else {
                        notifLoading.style.display = "none";
                        // Data is null
                        // Append something or handle the null case 
                        $('.notif-content').append('<a class="dropdown-item notification-item fw-bold">No notifications</a>');
                    }
                });
            }, 2000); // Interval in milliseconds (e.g., 5000 = 5 seconds)
        });


        function readNotif(id) {
            $.ajax({
                url: '/read-notification/' + id,
                type: "GET",
                dataType: "json",
            });
        }
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <!-- Bootstrap Bundle -->
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>