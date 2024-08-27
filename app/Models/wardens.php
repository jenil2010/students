<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class wardens extends Model
{
    use HasFactory;
    protected $table = 'wardens';
    protected $primarykey ='id';
    protected $fillable = ['first_name','last_name','email','phone','dob','gender','address','experience','qualification','status','user_id'];

    public function user() : BelongsTo {
       return $this->belongsTo(User::class,'user_id','id');
    }
    public function role() : BelongsTo {
       return $this->belongsTo(Role::class,'role_id','id');
    }
}
