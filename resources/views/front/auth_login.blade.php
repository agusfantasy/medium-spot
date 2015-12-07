@extends('front.auth_master')

@section('container')

<form class="form-signin" action="/auth/login" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" name="email" value="{{ old('email') }}"  placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>

    @if (isset($error))
        <p class="danger">{{ $error }}</p>
    @endif
    <div class="checkbox">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br>
    <a href="/register" class="btn btn-lg btn-success btn-block" type="submit">Sign up</a>
</form>

@stop