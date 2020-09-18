<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = 'universities';
    protected $fillable = ['name'];

    public function specializations()
    {
        return $this->hasMany(Specialization::class,'university_id','id');
    }
}
