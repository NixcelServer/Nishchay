<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>

<h1>User Management</h1>


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
