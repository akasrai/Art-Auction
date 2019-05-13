<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification; //added for admin password reset email

class Admin extends Authenticatable
{
    use Notifiable;

    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'role_admins');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'image', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function isSuperAdmin()
    {
        return $this->role()->where('name', 'Superadmin')->exists();
    }

    public function isAdmin()
    {
        return $this->role()->where('name', 'Admin')->exists();
    }

    public function isEditor()
    {
        return $this->role()->where('name', 'Editor')->exists();
    }

    public function isModerator()
    {
        return $this->role()->where('name', 'Moderator')->exists();
    }
}
