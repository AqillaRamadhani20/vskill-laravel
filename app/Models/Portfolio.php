<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'judul_project',
        'deskripsi',
        'tools',
        'link_demo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}