<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>

<h1>User Management</h1>

<!-- Loop through users and display their information -->
@foreach($users as $user)
    <div>
        <p>Name: {{ $user->first_name }}</p>
        <p>Email: {{ $user->email }}</p>
        <!-- Update action link with encrypted ID -->
        <a href="/admin/edituser/{{$user->encrypted_id}}">Update</a>
        <!-- Delete action form with encrypted ID -->
        <form action="" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        
    </div>
@endforeach
<form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
        <form action="/admin/createuser" method="GET">
            @csrf
            <button type="submit">Create User</button>
        </form>
</body>
</html>
