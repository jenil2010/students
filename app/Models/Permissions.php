<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Permissions extends Model
{
    use HasFactory;
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

}

