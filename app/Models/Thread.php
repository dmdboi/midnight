<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //
    protected $fillable = [
        'user_id',
        'board_id',
        'title',
        'body',
        'slug',
        'is_pinned',
        'pinned_at',
        'pinned_until',
        'pinned_by_user_id',
        'is_hidden',
        'hidden_at',
        'hidden_until',
        'hidden_by_user_id',
        'is_locked',
        'locked_reason',
        'status',
        'closed_at',
        'closed_by_user_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'pinned_at' => 'datetime',
        'pinned_until' => 'datetime',
        'hidden_at' => 'datetime',
        'hidden_until' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function pinnedBy()
    {
        return $this->belongsTo(User::class, 'pinned_by_user_id');
    }

    public function hiddenBy()
    {
        return $this->belongsTo(User::class, 'hidden_by_user_id');
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by_user_id');
    }
}
