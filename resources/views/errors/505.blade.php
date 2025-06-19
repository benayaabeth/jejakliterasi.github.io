@extends('layouts.user')

@section('title', 'Server Error')

@section('content')
<div class="error-page">
    <div class="container">
        <h1>500</h1>
        <h2>Server Error</h2>
        <p>Sorry, something went wrong on our end.</p>
        <a href="{{ route('home') }}" class="btn-primary">Back to Home</a>
    </div>
</div>
@endsection