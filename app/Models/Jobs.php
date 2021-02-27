<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\JobTypes;
use App\Models\User;

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
        'assigned_to',
        'photo',
        'location',
        'reference_id',
        'date_requested',
        'date_completed'

    ];

    public function jobTypes()
    {
        return $this->belongsTo(JobTypes::class, 'job_id','id');
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
