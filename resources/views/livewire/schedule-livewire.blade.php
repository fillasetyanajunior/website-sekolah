<div class="page-body">
    <div class="container-fluid">
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
                                    <input type="text" wire:model="search" class="form-control form-control-sm" aria-label="Search invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hari</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Tahun</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Bagian Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($schedule as $showschedule)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-capitalize">{{$showschedule->hari}}</td>
                                    <td>{{App\Models\Subject::find($showschedule->matapelajaran)->matapelajaran}}</td>
                                    <td>{{$showschedule->guru == 0 ? '' :
                                        App\Models\TeacherDetail::find($showschedule->guru)->nama}}</td>
                                    <td>{{App\Models\Year::find($showschedule->tahun)->tahun . ' - ' .
                                        App\Models\Year::find($showschedule->tahun)->semester}}</td>
                                    <td>{{$showschedule->kelas}}</td>
                                    <td>{{$showschedule->jurusan != null ?
                                        App\Models\Department::find($showschedule->jurusan)->jurusan : ''}}</td>
                                    <td>{{$showschedule->no_kelas}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" id="editjadwal"
                                            data-bs-toggle="modal" data-bs-target="#JadwalModal"
                                            data-id="{{Crypt::encrypt($showschedule->id)}}">Ubah</button>
                                        <form
                                            action="{{route('admin.schedule.destroy', Crypt::encrypt($showschedule->id))}}"
                                            method="post" class="d-inline">
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
                        {{$schedule->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
