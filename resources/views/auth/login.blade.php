@extends('layoutsAuth.authApp')

@section('content')
<div class="wrapper">
    <div class="title">
        <h2>LOGIN FORM</h2>
    </div>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="group-input-icon">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="username" placeholder="Enter username !">
        </div>
        <div class="group-input-icon">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Enter password !">
        </div>
        <div class="group-forget-register">
            <a href="#" class="forget-account">forget account</a>
            <a href="{{ route('register') }}" class="register-account">register account</a>
        </div>
        <button type="submit" class="btn btn-login">Login</button>
    </form>
</div>
@endsection