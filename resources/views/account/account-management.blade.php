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
            <h3><span style="color: #fba83e;">Account </span> Management</h3>
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
                                        <div class="initial-pic">
                                            <div class="letter">{{substr($data->name, 0, 1)}}</div>
                                        </div>
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