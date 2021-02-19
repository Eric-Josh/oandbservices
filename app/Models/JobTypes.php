<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTypes extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'job_types';
    protected $fillable = [
        'name'
    ];


}
