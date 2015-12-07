@extends('front.auth_master')

@section('container')

    <form class="form-signin" action="/register" method="post">
        

        <h2 class="form-signin-heading">Register</h2>

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Name" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <label for="inputPassword" class="sr-only">Confirm Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

        @if (isset($errors))       
            @foreach ($errors->all() as $message)
                 <p class="text-danger"> {{ $message }}</p>
            @endforeach
        @endif

        <button class="btn btn-lg btn-success btn-block" type="submit">Sign up</button><br>
        <a href="/auth/login" class="btn btn-lg  btn-primary  btn-block" type="submit">Sign in</a>

    </form>

@stop