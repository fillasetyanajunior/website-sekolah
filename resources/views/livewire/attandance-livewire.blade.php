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
        @foreach ($attandance as $showattandance)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$showattandance->jam}}</td>
                <td>{{$showattandance->nis}}</td>
                <td>{{App\Models\StudentDetail::find($showattandance->id_siswa)->nama}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
