<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Country;
use App\Models\UserGallery;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function galleries()
    {
        return $this->hasMany(UserGallery::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $role)
    {
        return $this->roles->contains('name', $role);
    }

    
    public function hasPermission($permission_name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == "super_admin")
            {
                return true;
            }

            foreach($role->permissions as $permission)
            {
                if($permission->name == $permission_name)
                {
                    return true;
                }
            }
        }

        return false;
    }

    public function getPermissions()
    {
        $permissions = [];

        foreach($this->roles as $role)
        {
            if($role->name == "super_admin")
            {
                $permissions = "all";

                break;
            }

            foreach($role->permissions as $permission)
            {
                $permissions[] = $permission->name;
            }
        }

        return $permissions;
    }
}
