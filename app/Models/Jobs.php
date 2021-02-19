<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'job_id',
        'job_title',
        'description',
        'amount',
        'phone',
        'time_frame',
        'status',
        'user_id',
        'photo',
        'location',
        'reference_id',
        'date_requested',
        'date_completed'

    ];

    public function JobTypes()
    {
        return $this->belongsTo('App\Models\JobTypes', 'job_id','id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }
}
