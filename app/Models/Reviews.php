<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'stars',
        'comments',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
