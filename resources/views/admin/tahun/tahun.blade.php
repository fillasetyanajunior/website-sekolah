@extends('layouts.base_dashboard')
@section('title', $title)
@section('content')
<x-sliderbar-admin></x-sliderbar-admin>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">{{$title}}</h2>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="p-2 bd-highlight">
                                <a href="" class="btn mb-2 btn-primary " id="tambahtahun" data-toggle="modal" data-target="#tahunModal"><i class="fas fa-plus"></i><span>&nbsp; Tambah Tahun Ajaran</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{$title}}</strong>
                            </div>
                            <div class="card-body my-n2">
                                <table class="table table-striped table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tahun</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($tahun as $item)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$item->tahun}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                        <a class="dropdown-item" href="" id="edittahun" data-toggle="modal" data-target="#tahunModal" data-id="{{$item->id}}">Edit</a>
                                                        <form action="{{route('admin.year.destroy',$item->id)}}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="dropdown-item">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
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
        </div>
    </div>
</main>
<div class="modal fade" id="tahunModal" tabindex="-1" aria-labelledby="ModalTahunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTahunLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_tahun">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tahun">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" placeholder="2021/2022">
                        </div>
                    </div>
                    <div class="modal-footer footer_tahun">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#tambahtahun').on('click', function () {
                $('.footer_tahun button[type=submit]').html('Add');
                $('#ModalTahunLabel').html('Tambah Tahun Ajaran');
                $('.body_tahun form').attr('action', '{{route("admin.year.store")}}');
                $('.body_tahun form').attr('method', 'post');

                $("#tahun").val('');
            });
            $('#edittahun*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.year.edit",":id")}}'.replace(':id', id);

                $('.footer_tahun* button[type=submit]').html('Edit');
                $('#ModalTahunLabel*').html('Edit Tahun Ajaran');
                $('.body_tahun form*').attr('action', '{{route("admin.year.update",":id")}}'.replace(':id', id));
                $('.body_tahun form*').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#tahun').val(hasil.tahun)
                    }
                });
            });
        });
    </script>
@endpush
