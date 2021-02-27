<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Merchandise;
use App\Models\User;

class GeneralMerchandise extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table='general_merchandise';
    protected $fillable = [
        'merchandise_id',
        'phone',
        'description',
        'amount',
        'time_frame',
        'status',
        'user_id',
        'assigned_to',
        'location'
    ];

    public function Merchandise()
    {
        return $this->belongsTo(Merchandise::class, 'merchandise_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_to','id');
    }
}
