<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complains extends Model
{
    use HasFactory;

    protected $table = 'complains';

    protected $primarykey = 'id';
    protected $fillable = ['complain_by','message','type','status','admin_comments'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'complain_by','id');
    }
}
