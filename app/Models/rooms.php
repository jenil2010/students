<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rooms extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $primarykey = 'id';
    protected $fillable = ['hostel_id','room_number','status'];

    public function hostel(): BelongsTo{
        return $this->belongsTo(hostels::class,'hostel_id','id');
    }
}
