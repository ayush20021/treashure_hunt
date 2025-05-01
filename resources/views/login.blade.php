<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login & Registration Form</title>
    <!---Custom CSS File--->
    @vite(['resources/css/app.css'])
</head>
<body>
<div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
        <header>Login</header>
        <form action="/authenticate-user"  method="Post">
            @csrf
            <input type="text" placeholder="Enter your email" name="email" value="{{old('email')}}">
            @error('email')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="password" placeholder="Create a password" name="password">

            <span class=""> Remember Me
                     <input type="checkbox" name="remember">
        </span>
            <input type="submit" class="button" value="Login">
        </form>
        <div class="signup">
         <span class="signup">Don't have an account?
{{--         <label for="check">Signup</label>--}}
             <a href="{{route('welcome')}}">Signup</a>
        </span>
        </div>
        </div>
</div>
</body>
</html>
