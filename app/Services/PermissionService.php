<?php

namespace App\Services;


class PermissionService
{
    
    public $nav_user_group =  false;

    public $nav_users_option = false;

    public $nav_roles_option = false;

    public function __construct()
    {
        $this->prepareNavigation();
    }

    public function prepareNavigation()
    {
        $permissions = session('user_permissions');

        if($permissions == "all")
        {
            $this->setAllTrue();

            return;
        }

        // User Group

        if(in_array('user.index', $permissions) || in_array('role.index', $permissions))
        {
            $this->nav_user_group = true;
        }

        if(in_array('user.index', $permissions))
        {
            $this->nav_users_option = true;
        }

        if(in_array('role.index', $permissions))
        {
            $this->nav_roles_option = true;
        }

    }

    public function setAllTrue()
    {
        $this->nav_user_group =  true;

        $this->nav_users_option =  true;

        $this->nav_roles_option =  true;
    
    }
}