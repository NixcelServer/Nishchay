<form action="/admin/edituser" method="POST">
    @csrf

<input type="hidden" name="enc_id" value="{{ $enc_id }}">

    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name" required><br><br>

    <label for="middle_name">Middle Name:</label><br>
    <input type="text" id="middle_name" name="middle_name"><br><br>

    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="last_name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="role">Role:</label><br>
    <select id="tbl_role_id" name="tbl_role_id" required>
        <option value="1">Admin</option>
        <option value="2">HR</option>
        <!-- Add more options if needed -->
    </select><br><br>

    <input type="submit" value="Submit">
</form>
