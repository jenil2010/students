<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Permission;

class Permissions extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'module_permission';

    protected $fillable = [
        'role_id',
        'module',
        'read',
        'create',
        'update',
        'delete'
    ];

    public static function checkCRUDPermissionToUser($checkPR, $checkPermission)
    {
        $loggedInUser = Auth::user();
        $CRUDData = '';

        $isSuper = 0;
        if ($loggedInUser->role_id == 1) {
            $isSuper = 1;
        } else {
            $CRUDData = Permissions::where('role_id', $loggedInUser->role_id)->where('module', $checkPR)->value($checkPermission);
        }

        if ($CRUDData == 'on' || $isSuper == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function isSuperAdmin()
    {
        $loggedInUser = Auth::user();
        $isSuper = 0;
        if ($loggedInUser->role_id == 1) {
            $isSuper = 1;
        }
        return $isSuper;
    }

    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logUnguarded = true;
    protected static $logName = 'module_permission';

    public function getActivitylogOptions(): LogOptions
    {
        $userName = Auth::user()->name;

        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('module_permission')
            ->setDescriptionForEvent(function (string $eventName) use ($userName) {
                return "{$userName} has {$eventName} module_permission";
            });
    }

}

