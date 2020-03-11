<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification; //added for admin password reset email

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use Notifiable;

    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'role_sellers');
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

    // FIXME: make notification for seller
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function isCEO()
    {
        return $this->role()->where('name', 'CEO')->exists();
    }

    public function isAreaManager()
    {
        return $this->role()->where('name', 'AreaManager')->exists();
    }

    public function isManager()
    {
        return $this->role()->where('name', 'Manager')->exists();
    }

    public function isClerk()
    {
        return $this->role()->where('name', 'Clerk')->exists();
    }
}
