<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $table = 'specializations';

    protected $fillable = ['university_id','name','point','is_paid','is_special','group'];
}
