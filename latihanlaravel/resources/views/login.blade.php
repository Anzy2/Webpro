<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="/auth" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="/registration">Register</a></p>

</body>
</html>