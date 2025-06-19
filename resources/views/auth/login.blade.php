@extends('layouts.user')

@section('content')
<div class="container">
    <div class="auth-form">
        <h2>Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" 
                       value="{{ old('username') }}" 
                       required autofocus>
                @error('username')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

           

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>
</div>
@endsection