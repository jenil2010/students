<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fees extends Model
{
    use HasFactory;
    protected $table = 'fees';
    protected $primarykey = 'id';
    protected $fillable = [
        'addmission_id', 'fees_amount','payment_type','payment_method','paid_at','status', 'transaction_number', 'bank_name', 'cheque_number', 'receipt_number', 'remarks', 'serial_number', 'donation_type',  'financial_year','student_name','father_name','address'
    ];

    public function addmission(): BelongsTo{
        return $this->belongsTo(Addmission::class,'addmission_id','student_id');
    }
}
