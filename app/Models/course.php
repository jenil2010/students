<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primarykey = 'id';
    protected $fillable = ['course_name','duration','status','semesters'];
}
