<?php

namespace App\Services;
class PermissionService
{
    public function check($action, $table)
    {
        // Owner / SuperAdmin
        if(auth()->guard('web')->check()){
            return true;
        }

        // SubUser
        if(auth()->guard('subusers')->check()){

            $subUser = auth()->guard('subusers')->user();

            return $subUser->role->permissions()
                ->where('permissions.name', $action)
                ->wherePivot('table_name', $table)
                ->exists();
        }

        return false;
    }
}