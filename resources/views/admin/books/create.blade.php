@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add New Book</h1>
    
    <!-- Menampilkan pesan error jika ada -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
        </div>
        <div class="form-group">
            <label>Synopsis</label>
            <textarea name="synopsis" class="form-control" rows="5" required>{{ old('synopsis') }}</textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>
        <div class="form-group">
            <label>Book Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <div class="form-group">
            <label>PDF File</label>
            <input type="file" name="pdf_file" class="form-control" accept=".pdf">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
