<div>
    <h1>Admin dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>
                    <button wire:click="editUser({{ $user['id]}})">Edit</button>
                    <button wire:click="deleteUser({{ $user['id]}})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
</div>
