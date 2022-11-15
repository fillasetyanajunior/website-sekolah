<html>
    <table style="border: 2px solid black;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1?>
            @foreach ($student as $showstudent)
                @php
                    $detail = App\Models\Student::where('id_siswa', $showstudent->id)->first();
                @endphp
                <tr>
                    <td>{{$i++}}</td>
                    <td width="300px">{{$detail->name}}</td>
                    <td>{{$detail->username}}</td>
                    <td>{{Crypt::decrypt($detail->password_encrypted)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</html>
