<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'category_course');
    }

    public function catatans()
    {
        return $this->hasMany(Catatan::class);
    }
}
