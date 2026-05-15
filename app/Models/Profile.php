<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'npm',
        'prodi',
        'foto',
        'bio',
        'skill_summary',
        'tools_summary',
        'harga_mulai',
        'kontak_wa',
        'status_ketersediaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}