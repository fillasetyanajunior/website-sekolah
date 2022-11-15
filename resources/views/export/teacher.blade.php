<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teacher as $showteacher)
        <tr>
            <td>{{$showteacher->name}}</td>
            <td>{{$showteacher->username}}</td>
            <td>{{Crypt::decrypt($showteacher->password_encrypted)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
