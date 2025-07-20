<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>contoh halaman login karena efek middleware untuk akses route /dashboard</h2>

  <form >
        @csrf
        <label>Email:</label><br>
        <input type="email" name="email" required disabled><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required disabled><br><br>

        <button type="submit" disabled>Login</button>
    </form>

    
</body>

</html>