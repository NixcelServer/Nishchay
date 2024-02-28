<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
</head>
<body>
    <h2>User Registration Form</h2>
    <form action="/admin/storeuser" method="post">
        @csrf <!-- Include CSRF token -->
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br>
        
        <label for="middle_name">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name"><br>
        
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <label for="tbl_role_id">Role:</label><br>
        <select id="tbl_role_id" name="tbl_role_id" required>
            <option value="">Select Role</option>
            <option value="1">Admin</option>
            <option value="2">User</option>
            <!-- Add more options as needed -->
        </select><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
