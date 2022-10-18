<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAccount extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'user_id',
        'provider_user_id',
        'provider'
    ];

    protected $table = 'social_accounts';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
