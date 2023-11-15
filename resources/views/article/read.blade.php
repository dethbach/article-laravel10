<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$data->meta_description}}" />
    <title>{{$data->title}}</title>
    <link rel="icon" type="image/png" href="{{asset('storage/web-material/cctv-logo.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('storage/css/landingpage2.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/css/article.css')}}" />
    <!-- Animation On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: #1748A1;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="/">
                <img src="{{asset('storage/web-material/cctv-logo.png')}}" alt="Logo" width="40" class="d-inline-block align-text-top me-3">
                CCTV Semarang
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#brand">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mb-5" style="padding-top: 6rem;">

        <div class="row mt-3">

            <div class="col">

                <div class="container-fluid">
                    <div class="row">
                        <div class="row-flex justify-content-start">
                            <h1 class="fw-bold">
                                {{ $data->title }}
                            </h1>
                            <hr class="mb-0">
                            <p class="text-secondary mt-0 pt-0"><b>{{$data->articleUser->name}}</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                </svg> <small>{{ $data->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-auto text-muted">
                            <i><small>{{$data->meta_description}}</small></i>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col text-center">
                            <img src="{{ asset('storage/thumbnail-article/' . $data->thumbnail) }}" alt="{{ $data->title }}" class="img-fluid" style="max-height: 300px;">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            {{$data->lead}} @if($data->city_id != null) <a href="{{$data->articleCity->url}}" style="color: #1748A1;">{{$data->articleCity->name}}</a> @endif
                        </div>
                    </div>
                    <div class="row mt-1 mb-5">
                        <div class="col d-none d-sm-none d-md-block">
                            {!! $data->body !!}
                        </div>
                        <div class="col d-block d-md-none">
                            {!! $data->body !!}
                        </div>
                    </div>

                    @if($anotherContent != null)
                    <div class="row mt-5 mb-5">
                        <div class="card shadow-sm border-light" style="width: 35rem;">
                            <div class="card-header">
                                <b>Baca Juga:</b>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($anotherContent as $anotherArticle)
                                <li class="list-group-item">
                                    <a href="/{{$anotherArticle->slug}}" class="linkreadmore">
                                        {{$anotherArticle->title}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                </div>

            </div>


            <div class="col-4 d-none d-sm-none d-md-block">
                <div class="card shadow-sm position-sticky border-light" style="top: 5rem;">
                    <div class="card-header text-light" style="background-color: #15233c;">
                        Baca Juga
                    </div>
                    <div class="card-body">


                        <!-- Right content -->
                        @foreach($readmore as $right)
                        <div class="trand-right-single d-flex mb-2">
                            <div class="card border-light mb-3 onhover" style="max-width: 520px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        @if($right->thumbnail != null)
                                        <img src="{{asset('storage/thumbnail-article/' . $right->thumbnail)}}" class="img-fluid rounded-start" alt="{{$right->title}}" style="width:100px;height: 100px;object-fit: cover;object-position: center;">
                                        @else
                                        <img src="{{asset('storage/thumbnail-article/undraw_articles_wbpb.png')}}" class="img-fluid rounded-start" alt="{{$right->title}}" style="width:100px;height: 100px;object-fit: cover;object-position: center;">
                                        @endif
                                    </div>
                                    <div class="col-md-8 ps-2">
                                        <a href="/{{ $right->slug }}" class="linkreadmore">
                                            <?php $titlelength = strlen($right->title); ?>
                                            {{ substr("$right->title", 0, 35)}}
                                            @if($titlelength >= '35')
                                            ...
                                            @endif
                                        </a>
                                        <div class="trand-right-cap mt-2">
                                            <p class="mb-0 text-muted">
                                                <small>{{$right->articleUser->name}}</small>
                                            </p>
                                            <p class="card-text"><small class="text-muted">{{ $right->created_at->diffForHumans() }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="card-footer text-end py-0" style="background-color: #15233c;color:aliceblue;">
                        <a href="/article" class="text-light">view more <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="ms-2 bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z" />
                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Kontak Section -->
    <section id="kontak">
        <div class="container-fluid overlay h-100">
            <div class="container" data-aos="fade-up" data-aos-duration="2000">
                <div class="row">
                    <div class="col-lg-5 col-md-12 mb-5">
                        <h3>
                            Butuh Konsultasi? Silahkan Kontak Kami Kami Siap Membantu
                        </h3>
                        <div class="kontak">
                            <h6>Kontak</h6>

                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill text-white" viewBox="0 0 16 16">
                                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                </svg>
                                <a href="#">JL. Sriwijaya No. 57 A</a>
                            </div>
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone-fill text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                                <a href="#">62 812-2511-3000</a>
                            </div>
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-at-fill text-white" viewBox="0 0 16 16">
                                    <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z" />
                                    <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z" />
                                </svg>
                                <a href="#">terataiproduction@gmail.com</a>
                            </div>
                        </div>
                        <h6>Social Media</h6>
                        <a href="" class="text-decoration-none me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook text-white" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                        </a>
                        <a href="" class="text-decoration-none me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-twitter text-white" viewBox="0 0 16 16">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg>
                        </a>
                        <a href="" class="text-decoration-none me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram text-white" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                            </svg>
                        </a>
                        <a href="" class="teratai-production text-decoration-none">Teratai Production</a>
                    </div>

                    <div class="col-lg-6 offset-lg-1 col-md-12">
                        <div class="card-kontak w-100">
                            <form action="/customer/ask" method="GET" enctype="multipart/form-data">
                                @csrf
                                <h2>Ada Pertanyan?</h2>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Leave a question here" id="questions" name="questions" style="height: 200px" required></textarea>
                                    <label for="questions">Tulis Pertanyaan di sini</label>
                                </div>
                                <button class="button-kontak" type="submit">
                                    Kirim <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-feather" viewBox="0 0 16 16">
                                        <path d="M15.807.531c-.174-.177-.41-.289-.64-.363a3.765 3.765 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545 8.264 1.415 6.315 3.1c-1.95 1.686-3.168 3.724-3.758 5.423-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88.017.04.035.082.056.122A68.362 68.362 0 0 0 .08 15.198a.528.528 0 0 0 .157.72.504.504 0 0 0 .705-.16 67.606 67.606 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49 1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.528.528 0 0 0 0-.739l-.729-.744 1.311.209a.504.504 0 0 0 .443-.15c.222-.23.444-.46.663-.684.663-.68 1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.524.524 0 0 0-.112-.172ZM3.733 11.62C5.385 9.374 7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196a.526.526 0 0 0-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.282 1.282 0 0 1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a6.85 6.85 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524-1.581-.25Zm3.346-3.357C9.594 3.147 6.045 6.8 3.149 10.678c.007-.464.121-1.086.37-1.806.533-1.535 1.65-3.415 3.455-4.976 1.807-1.561 3.746-2.36 5.31-2.68a7.97 7.97 0 0 1 1.564-.173Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer d-flex flex-wrap justify-content-between align-items-center py-3 px-5">
        <p class="col-md-4 mb-0">&copy; 2023 Jual CCTV Semarang</p>

        <a href="#hero" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="{{asset('storage/web-material/cctv-logo.png')}}" alt="cctv logo" width="40" height="100%">
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#brand" class="nav-link px-2 text-light">Product</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Article</a></li>
            <li class="nav-item"><a href="#kontak" class="nav-link px-2 text-light">Contact</a></li>
        </ul>
    </footer>


    <!-- Animation On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>

    <script src="{{asset('storage/js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>