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
        <header>Welcome to Treasure Hunt</header>
        <form action="/create-account" method="post">
            @csrf
            <input type="text" placeholder="Enter you name" name="user_name" value="{{old('user_name')}}">
            @error('user_name')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="email" placeholder="Enter your email" name="email" value="{{old('email')}}">
            @error('email')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="password" placeholder="Enter your password" name="password" value="">
            @error('password')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            <a href="#">Forgot password?</a>
            <input type="submit" class="button" value="Login">
        </form>
        <div class="signup">
         <span class="signup">Already have an account?
{{--         <label for="check">Login</label>--}}
             <a href="{{route('login')}}" > Login </a>
        </span>
        </div>
    </div>
    <div class="registration form">
        <header>Login In </header>
        <form action="/authenticate-user"  method="Post">
            @csrf
            <input type="text" placeholder="Enter your email" name="email" value="{{old('email')}}">
            @error('email')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="password" placeholder="Create a password" name="password">
            <input type="submit" class="button" value="Login">
        </form>
        <div class="signup">
        <<span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
        </div>
    </div>
</div>
</body>
</html>
