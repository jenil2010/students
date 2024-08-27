<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primarykey = 'id';
    protected $fillable = ['course_id','country_id','first_name','last_name','middle_name','email','password','phone','dob','gender','address','village','status','is_any_illness','illness_description','user_id'];
    public function country(): BelongsTo{
        return $this->belongsTo(country::class,'country_id','id');
    }
    public function course(): BelongsTo{
        return $this->belongsTo(course::class,'course_id','id');
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'user_id','id');
    } 
    public function role(): BelongsTo{
        return $this->belongsTo(User::class,'role_id','id');
    }
}
