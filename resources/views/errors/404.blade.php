@extends('layouts.user')

@section('title', 'Page Not Found')

@section('content')
<div class="error-page">
    <div class="container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you are looking for could not be found.</p>
        <a href="{{ route('home') }}" class="btn-primary">Back to Home</a>
    </div>
</div>
@endsection