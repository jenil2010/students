<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rooms extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $primarykey = 'id';
    protected $fillable = ['hostel_id','room_number','status'];

    public function hostel(): BelongsTo{
        return $this->belongsTo(hostels::class,'hostel_id','id');
    }

    public function beds(): HasMany{
        return $this->hasMany(beds::class,'beds_id','id');
    }
}
