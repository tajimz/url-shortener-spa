<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    //
    use HasFactory;
    protected $fillable = ['long_url', 'short_code', 'clicks', 'expires_at', 'password'];
    protected $casts = [
        'expires_at' => 'datetime',
    ];
    protected $hidden = [
        'password',
    ];
    protected $appends = [
        'has_password',
    ];
    public function getHasPasswordAttribute()
    {
        return !empty($this->password);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
