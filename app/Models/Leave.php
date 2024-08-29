<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;

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
}
