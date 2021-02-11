<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['stored_at'];

    public function getStoredAtAttribute()
    {
        return $this->created_at->diffforHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
