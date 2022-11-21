<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Absen</title>
</head>
<body>
    <table border="2px">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            @foreach ($attendance as $showattendance)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$showattendance->tanggal}}</td>
                    <td>{{App\Models\Subject::find($showattendance->matapelajaran)->matapelajaran}}</td>
                    <td>{{App\Models\TeacherDetail::find($showattendance->guru)->nama}}</td>
                    <td>{{App\Models\Department::find($showattendance->jurusan)->jurusan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
