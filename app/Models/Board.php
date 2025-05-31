<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'slug',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
