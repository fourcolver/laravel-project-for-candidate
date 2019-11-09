<?php

if(!function_exists('currentUser')) {
    /**
     * @return \App\User
     */
    function currentUser()
    {
        return \Illuminate\Support\Facades\Auth::user();
    }
}

if(!function_exists('currentPermissions')) {
    /**
     * @return \App\EmployeePermission
     * @throws Exception
     */
    function currentPermissions()
    {
        return currentUser()->permissions;
    }
}