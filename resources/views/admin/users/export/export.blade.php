<table>
    <thead>
    <tr>
        <th>S. No/</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Department</th>
        <th>Approval Status</th>
        <th>Activation Status</th>
        <th>Created_at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->department }}</td>
            <td>{{ $user->approval }}</td>
            <td>{{ $user->status }}</td>
            <td>{{ $user->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
