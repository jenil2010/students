<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class beds extends Model
{
    use HasFactory;
    protected $table = 'beds';
    protected $primarykey = 'id';
    protected $fillable = ['hostel_id','room_id','bed_number','status'];

    public function hostel(): BelongsTo{
        return $this->belongsTo(hostels::class,'hostel_id','id');
    }
    public function rooms(): BelongsTo{
        return $this->belongsTo(rooms::class,'room_id','id');
    }
}
