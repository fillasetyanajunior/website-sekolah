@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-admin></x-sliderbar-admin>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Management Blog
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#MagazineModal" id="tambahmagazine">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Majalah
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#MagazineModal" id="tambahmagazine" aria-label="Tambah Majalah">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </a>
                            </div>
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
                                                <th>Thumnail</th>
                                                <th>Title</th>
                                                <th>file</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($magazine as $showmagazine)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td><img src="{{Storage::url($showmagazine->thumnail)}}" width="100px"></td>
                                                    <td>{{$showmagazine->title}}</td>
                                                    <td>{{$showmagazine->file}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" id="editmagazine" data-bs-toggle="modal" data-bs-target="#MagazineModal" data-id="{{$showmagazine->id}}">Ubah</button>
                                                        <form action="{{route('admin.magazine.destroy', $showmagazine->id)}}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-sm btn-primary">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer d-flex align-items-center">
                                    {{$magazine->links()}}
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
<div class="modal modal-blur fade" id="MagazineModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_informasi">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                       <div class="mb-3">
                            <label class="form-label" for="thumnail">Thumnail</label>
                            <input type="file" class="form-control" id="thumnail" name="thumnail">
                        </div>
                       <div class="mb-3">
                            <label class="form-label" for="file">File</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#tambahmagazine').on('click', function () {
                $('.body_informasi button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Magazine');
                $('.body_informasi form').attr('action', '{{route("admin.magazine.store")}}');
                $('.body_informasi form').attr('method', 'post');

                $('#title').val('')
                $('#thumnail').val('')
                $('#file').val('')
            });
            $('#editmagazine*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.magazine.edit",":id")}}'.replace(':id', id);

                $('.body_informasi button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Magazine');
                $('.body_informasi form').attr('action', '{{route("admin.magazine.update",":id")}}'.replace(':id', id));
                $('.body_informasi form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#title').val(hasil.title)
                    }
                });
            });
        });
    </script>
@endpush

