@extends('layoutsAuth.authApp')

@section('content')
<div class="wrapper">
    <div class="title">
        <h2>REGISTER FORM</h2>
    </div>
    <form action="#" method="post">
        @csrf
        <div class="group-input-icon">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="userame_register" placeholder="Enter username !">
        </div>
        <div class="group-input-icon">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email_register" placeholder="Enter email !">
        </div>
        <div class="group-input-icon">
            <i class="fa-solid fa-phone"></i>
            <input type="tel" name="phone_register" placeholder="Phone Number !">
        </div>
        <div class="group-input-icon">
            <i class="fa-solid fa-lock"></i>
            <input type="password_register" name="password_register" placeholder="Enter password !">
        </div>
        <div class="group-input-icon">
            <i class="fa-solid fa-lock-open"></i>
            <input type="confirm_password_register" name="confirm_password_register" placeholder="Re enter password !">
        </div>
        <div class="group-forget-register">
            <a href="#" class="forget-account">forget account</a>
            <a href="#" class="back-login">Back Login</a>
        </div>
        <button type="submit" class="btn btn-login">Register Account</button>
    </form>
</div>
@endsection