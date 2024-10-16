<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Student_map extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'student_map';
    protected $primarykey = 'id';
    protected $fillable = ['addmission_id','student_id','hostel_id','room_id','bed_id','addmission_year','is_bed_release'];

    public function admission(): BelongsTo{
        return $this->belongsTo(Addmission::class,'addmission_id','id');
    }

    public function student(): BelongsTo{
        return $this->belongsTo(Students::class,'student_id','id');
    }

    public function hostel(): BelongsTo{
        return $this->belongsTo(hostels::class,'hostel_id','id');
    }
    public function beds(): BelongsTo{
        return $this->belongsTo(beds::class,'bed_id','id');
    }

    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logUnguarded = true;
    protected static $logName = 'student_map';

    public function getActivitylogOptions(): LogOptions
    {
        $userName = Auth::user()->name;

        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('student_map')
            ->setDescriptionForEvent(function (string $eventName) use ($userName) {
                return "{$userName} has {$eventName} student_map";
            });
    }
}
