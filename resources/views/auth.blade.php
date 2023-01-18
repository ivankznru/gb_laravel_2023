@include("menu")
<H1>Sign In</H1>
<form action="" method="POST">

    @csrf

    <label>Login: <input type="text" name="login" placeholder="Enter you login"></label><br>
    <label>Password: <input type="password" name="password" placeholder="Enter you password"></label><br>
    <label><input type="checkbox" name="remember">Remember me</label><br>
    <input type="submit" value="Sign in">
</form>