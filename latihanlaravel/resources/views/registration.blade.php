<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="/register" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Nama"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Register</button>
</form>

<p><a href="/login">Kembali ke Login</a></p>

</body>
</html>