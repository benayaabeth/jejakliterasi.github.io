<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    // Konstanta untuk status
    const STATUS_PENDING = 'Pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_REJECTED = 'rejected';
    const STATUS_COMPLETED = 'Selesai';
    
    // Daftar status yang valid
    public static $validStatuses = [
        self::STATUS_PENDING,
        self::STATUS_VERIFIED,
        self::STATUS_REJECTED,
        self::STATUS_COMPLETED
    ];
    
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'created_at'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan OrderDetails
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    // Relasi dengan Book melalui OrderDetails
    public function books()
    {
        return $this->belongsToMany(Book::class, 'order_details')
                    ->withPivot('quantity', 'price');
    }

    // Check status order
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isVerified()
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }
}