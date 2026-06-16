<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'judul_jasa',
        'kategori',
        'deskripsi',
        'harga',
        'estimasi_pengerjaan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function avgRating(): float
    {
        return round((float) $this->ratings->avg('rating'), 1);
    }

    public function ratingCount(): int
    {
        return $this->ratings->count();
    }
}