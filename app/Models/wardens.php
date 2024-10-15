<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class wardens extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'wardens';
    protected $primarykey ='id';
    protected $fillable = ['first_name','last_name','email','phone','dob','gender','address','experience','qualification','status','user_id'];

    public function user() : BelongsTo {
       return $this->belongsTo(User::class,'user_id','id');
    }
    public function role() : BelongsTo {
       return $this->belongsTo(Role::class,'role_id','id');
    }

    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logUnguarded = true;
    protected static $logName = 'wardens';

    public function getActivitylogOptions(): LogOptions
    {
        $userName = Auth::user()->name;

        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('wardens')
            ->setDescriptionForEvent(function (string $eventName) use ($userName) {
                return "{$userName} has {$eventName} wardens";
            });
    }
}
