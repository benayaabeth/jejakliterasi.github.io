@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Book Management</h1>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary mb-3">Add New Book</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Author</th>
                <th>Synopsis</th>
                <th>Category</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $index => $book)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ Str::limit($book->synopsis, 50) }}</td>
                <td>{{ $book->kategori }}</td>
                <td>{{ number_format($book->price, 2) }}</td> <!-- Format harga -->
                <td>
                    @if($book->image)
                        <img src="{{ Storage::url('books/'.$book->image) }}" alt="{{ $book->title }}" width="100">
                    @else
                        <span>No Image</span> <!-- Menampilkan teks jika tidak ada gambar -->
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-primary">Edit</a>

                    <!-- Form untuk menghapus dengan konfirmasi -->
                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
    {{ $books->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
    </div>
</div>
@endsection
