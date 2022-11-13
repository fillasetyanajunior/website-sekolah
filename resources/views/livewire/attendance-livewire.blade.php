<table class="table card-table table-vcenter text-nowrap datatable">
    <thead>
        <tr>
            <th>No.</th>
            <th>Jam</th>
            <th>NIS</th>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
        @foreach ($attendance as $showattendance)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$showattendance->jam}}</td>
                <td>{{$showattendance->nis}}</td>
                <td>{{App\Models\StudentDetail::find($showattendance->id_siswa)->nama}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
