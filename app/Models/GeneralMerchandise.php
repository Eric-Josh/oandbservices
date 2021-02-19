<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'location'
    ];

    public function Merchandise()
    {
        return $this->belongsTo('App\Models\Merchandise', 'merchandise_id','id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }
}
