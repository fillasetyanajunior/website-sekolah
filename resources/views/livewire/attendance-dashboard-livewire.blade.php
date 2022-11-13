<div class="card" wire:poll.750ms>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th class="w-1">No.</th>
                    <th>Jam</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;?>
                @foreach ($students as $showstudents)
                <tr>
                    <td><span class="text-muted">{{$i++}}</span></td>
                    <td>{{$showstudents->jam}}</td>
                    <td>{{$showstudents->nis}}</td>
                    <td>{{App\Models\StudentDetail::find($showstudents->id_siswa)->nama}}</td>
                    <td>{{$showstudents->keterangan}}</td>
                    <td>
                        <button type="button" id="editabsen" data-id="{{Crypt::encrypt($showstudents->id)}}" data-bs-toggle="modal" data-bs-target="#ModalAbsenEdit" class="btn btn-warning btn-sm">Edit</button>
                        <button wire:click="destroy('{{Crypt::encrypt($showstudents->id)}}')" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
