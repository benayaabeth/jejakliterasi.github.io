<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Ubah ini
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    
    public $timestamps = true; // Pastikan ini ada

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'profile_photo'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mendapatkan semua pengguna
    public static function getAllUsers()
    {
        return self::all();  // Menggunakan all() untuk mendapatkan semua data
    }

    // Mendapatkan pengguna berdasarkan nama
    public static function getUserByName($name)
    {
        return self::where('name', $name)->get();  // Lebih sederhana, tetap menggunakan where() untuk mendapatkan pengguna
    }

    // Mendapatkan pengguna berdasarkan username
    public static function getUserByUsername($username)
    {
        return self::where('username', $username)->first();  // Gunakan first() untuk mengambil satu data
    }

    // Mendapatkan pengguna berdasarkan email
    public static function getUserByEmail($email)
    {
        return self::where('email', $email)->first();  // Gunakan first() untuk mengambil satu data
    }

    // Mendapatkan pengguna berdasarkan level
    public static function getUserByLevel($level)
    {
        return self::where('level', $level)->get();  // Menggunakan where() untuk mendapatkan data berdasarkan level
    }

    // Menambahkan pengguna baru
    public static function insertUser($name, $username, $email, $password, $level)
    {
        return self::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password,PASSWORD_DEFAULT),  // Menggunakan bcrypt untuk mengenkripsi password
            'level' => $level
        ]);
    }

    // Memperbarui data pengguna
    public static function updateUser($id, $name, $username, $email, $password, $level)
    {
        $user = self::find($id);  // Menggunakan find() untuk mendapatkan pengguna berdasarkan ID

        if ($user) {
            $user->name = $name;
            $user->username = $username;
            $user->email = $email;
            $user->password = password_hash($password,PASSWORD_DEFAULT);  // Pastikan password di-hash sebelum disimpan
            $user->level = $level;
            $user->save();  // Menyimpan perubahan pada data pengguna
        }

        return $user;
    }

    // Relasi satu ke banyak dengan Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Mengecek apakah pengguna telah membeli buku tertentu
    public function hasPurchased(Book $book)
{
    return $this->orders()
        ->whereIn('status', ['verified', 'Selesai', 'Pending']) // Kita cek juga status Pending
        ->whereDoesntHave('orderDetails', function ($query) use ($book) {
            $query->whereHas('order', function ($orderQuery) {
                $orderQuery->where('status', 'rejected');
            });
        })
        ->whereHas('orderDetails', function ($query) use ($book) {
            $query->where('book_id', $book->id);
        })
        ->exists();
}

public function getProfilePhotoUrlAttribute()
{
    if ($this->profile_photo) {
        return asset('storage/profile-photos/' . $this->profile_photo);
    }
    return asset('images/default-avatar.png'); // Add default image
}

    // app/Models/User.php

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
}
