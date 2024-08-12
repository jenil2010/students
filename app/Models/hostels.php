<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class hostels extends Model
{
    use HasFactory;

    protected $table = 'hostels';
    protected $primarykey = 'id';
    protected $fillable = ['hostel_name','location','contact_number','mobile_number','status','warden_id'];


public function warden():BelongsTo{
    return $this->belongsTo(wardens::class,'warden_id','id');
}

}
