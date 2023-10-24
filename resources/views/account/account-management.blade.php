@extends('layouts.sidebar')

@php
$sidetitle = 'Settings';
@endphp


@section('css')
@endsection

@section('contents')

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col">
            <h3>Account Management</h3>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">


            <div class="card shadow-sm" style="border: transparent;border-radius:8px;">
                <div class="card-body">
                    <table class="table table-hover" id="table-users">
                        <thead>
                            <tr class="table-primary">
                                <th style="width: 5%;">#</th>
                                <th>Name</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($datas as $data)
                            <tr class="table-row" data-url="/{{auth()->user()->role}}/account/{{$data->username}}">
                                <td class="fw-bold">{{$i++}}.</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($data->photo != null)
                                        <img src="{{asset('storage/profile-pic/'.$data->photo)}}" alt="" style="width: 45px; height: 45px" class="rounded-circle" style="border-radius: 50%;object-fit: cover;object-position: top;" />
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#B9B4C7" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg>
                                        @endif
                                        <div class="ms-3">
                                            <p class="fw-bold mb-0" style="color: #352F44;">{{$data->name}}</p>
                                            <p class="fw-bold mb-0" style="color: #5C5470;"><span>@</span>{{$data->username}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge green-badge">{{strtoupper($data->role)}}</span>
                                </td>
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

        $('.table-row').click(function() {
            var url = $(this).data('url');
            window.location.href = url;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#table-users').DataTable({
            "bInfo": false,
            "bPaginate": false
        });
    });
</script>

<!-- Data Table -->
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
@endsection
@endsection