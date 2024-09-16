<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Studentdocuments extends Model
{
    use HasFactory;
    protected $table = 'student_documents';
    protected $primarykey = 'id';
    protected $fillable = ['student_id','doctype','doc','percentile','result_Status'];

    public function student(): BelongsTo{
        return $this->belongsTo(Students::class,'student_id','id');
    }
}
