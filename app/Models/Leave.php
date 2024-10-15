<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Leave extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'leaves';
    protected $primarykey = 'id';
    protected $fillable = [
        'leave_apply_by', 'reason','approve_by','note','leave_status','leave_from','leave_to','student_id'
    ];

    public function applyby(): BelongsTo{
        return $this->belongsTo(User::class,'leave_apply_by','id');
    }
    
    public function approveby(): BelongsTo{
        return $this->belongsTo(User::class,'approve_by','id');
    }
    public function student(): BelongsTo{
        return $this->belongsTo(Students::class,'student_id','id');
    }

    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logUnguarded = true;
    protected static $logName = 'leaves';

    public function getActivitylogOptions(): LogOptions
    {
        $userName = Auth::user()->name;

        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('leaves')
            ->setDescriptionForEvent(function (string $eventName) use ($userName) {
                return "{$userName} has {$eventName} leaves";
            });
    }
}
