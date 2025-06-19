<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'author',
        'synopsis',
        'kategori',
        'price',
        'image',
        'pdf_file',
        'created_at',
        'updated_at'
    ];

    // Mendapatkan semua buku
    public static function getAllBooks(){
        return self::all();
    }

    // Mendapatkan buku berdasarkan ID
    public static function getBookById($id){
        return self::find($id);
    }

    // Mendapatkan buku berdasarkan judul
    public static function getBookByTitle($title){
        return self::where('title', 'like', "%{$title}%")->get();
    }

    // Mendapatkan buku berdasarkan pengarang
    public static function getBookByAuthor($author){
        return self::where('author', 'like', "%{$author}%")->get();
    }

    // Mendapatkan buku berdasarkan kategori
    public static function getBookByCategory($category){
        return self::where('kategori', $category)->get();
    }

    // Mendapatkan buku berdasarkan harga
    public static function getBookByPrice($price){
        return self::where('price', $price)->get();
    }

    // Mendapatkan buku berdasarkan tanggal dibuat
    public static function getBookByCreated($created){
        return self::where('created_at', $created)->get();
    }

    // Mendapatkan buku berdasarkan tanggal diupdate
    public static function getBookByUpdated($updated){
        return self::where('updated_at', $updated)->get();
    }

    // Menambahkan buku baru
    public static function insertBook($title, $author, $synopsis, $kategori, $price, $image, $pdf_file, $created, $updated){
        return self::create([
            'title' => $title,
            'author' => $author,
            'synopsis' => $synopsis,
            'kategori' => $kategori,
            'price' => $price,
            'image' => $image,
            'pdf_file' => $pdf_file,
            'created_at' => $created,
            'updated_at' => $updated
        ]);
    }

    // Memperbarui buku yang ada
    public static function updateBook($id, $title, $author, $synopsis, $kategori, $price, $image, $pdf_file, $created, $updated){
        return self::where('id', $id)->update([
            'title' => $title,
            'author' => $author,
            'synopsis' => $synopsis,
            'kategori' => $kategori,
            'price' => $price,
            'image' => $image,
            'pdf_file' => $pdf_file,
            'created_at' => $created,
            'updated_at' => $updated
        ]);
    }

    // Relasi dengan OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
