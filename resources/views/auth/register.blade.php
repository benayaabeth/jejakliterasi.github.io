@extends('layouts.user')

@section('content')
<div class="container">
    <div class="auth-form">
        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="hidden" name="level" value="user">

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <!-- <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div> -->
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>

        <p class="mt-3">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </div>
</div>

<script>
    // Password visibility toggle
    document.getElementById('toggle-password').addEventListener('click', function() {
        let passwordField = document.getElementById('password');
        let passwordConfirmField = document.getElementById('password_confirmation');
        let passwordIcon = this.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordConfirmField.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            passwordConfirmField.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });
</script>
@endsection
