<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wardens extends Model
{
    use HasFactory;
    protected $table = 'wardens';
    protected $primarykey ='id';
    protected $fillable = ['first_name','last_name','email','phone','dob','gender','address','experience','qualification','status'];
}
