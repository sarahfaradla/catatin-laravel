<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'matkul',
        'jurusan',
        'category_id',
        'deskripsi',
        'tautan',
        'visibilitas',
        'anonim',
    ];

    protected $casts = [
        'anonim' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Catatan yang boleh dilihat umum
    public function scopePublik($query)
    {
        return $query->where('status', 'Terbit')->where('visibilitas', 'publik');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
