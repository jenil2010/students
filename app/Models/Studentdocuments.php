<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Studentdocuments extends Model
{
    use HasFactory ;
    protected $table = 'student_documents';
    protected $primarykey = 'id';
    protected $fillable = ['student_id','doctype','doc','percentile','result_Status'];

    public function student(): BelongsTo{
        return $this->belongsTo(Students::class,'student_id','id');
    }

    // protected static $logAttributes = ['*'];
    // protected static $logFillable = true;
    // protected static $recordEvents = ['created', 'updated', 'deleted'];
    // protected static $logOnlyDirty = true;
    // protected static $logUnguarded = true;
    // protected static $logName = 'student_documents';

    // public function getActivitylogOptions(): LogOptions
    // {
    //     // $userName = Auth::user()->name;

    //     return LogOptions::defaults()
    //         ->logOnly(['*'])
    //         ->useLogName('student_documents')
    //         ->setDescriptionForEvent(function (string $eventName) use ($userName) {
    //             return "{$userName} has {$eventName} student_documents";
    //         });
    // }
}
