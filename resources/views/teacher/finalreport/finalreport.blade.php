@extends('layouts.base_dashboard')
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-teacher></x-sliderbar-teacher>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Wali Kelas
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{$title}}</h3>
                                </div>
                                <div class="card-body border-bottom py-3">
                                    <div class="d-flex">
                                        <div class="ms-auto text-muted">
                                            Search:
                                            <div class="ms-2 d-inline-block">
                                                <input type="text" class="form-control form-control-sm"
                                                    aria-label="Search invoice">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NISN</th>
                                                <th>Nama</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($student as $showstudent)
                                                @php
                                                    $path = explode('/', $showstudent->path);
                                                @endphp
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$showstudent->nisn}}</td>
                                                    <td>{{$showstudent->nama}}</td>
                                                    <td width="100">
                                                        <a href="{{route('teacher.finalreport.print', Crypt::encrypt($showstudent->id))}}" target="_blank" class="btn btn-sm btn-warning" id="editgradeincrease">Print</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer d-flex align-items-center">
                                    {{$student->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#tambahgradeincrease').on('click', function () {
                $('.body_gradeincrease button[type=submit]').text('Edit All');
                $('.modal-title').text('Semua Naik Kelas');
                $('.body_gradeincrease form').attr('action', '{{route("teacher.gradeincrease.update_all")}}');
                $('.body_gradeincrease form').attr('method', 'post');
            });

            $('#editgradeincrease*').on('click', function () {
                const id = $(this).data('id');

                $('.body_gradeincrease button[type=submit]').text('Edit');
                $('.modal-title').text('Naik Kelas');
                $('.body_gradeincrease form').attr('action', '{{route("teacher.gradeincrease.update",":id")}}'.replace(':id', id));
                $('.body_gradeincrease form').attr('method', 'post');
            });
        });
    </script>
@endpush
