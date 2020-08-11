<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableContract;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, ReacterableContract
{
    use Notifiable, Reacterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'image', 'bio', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post() {
        return $this->hasOne('App\Post');
    }

    public function posts() {
        return $this->hasMany('App\Post')->orderBy('created_at', 'DESC');
    }

    public function vpost() {
        return $this->hasOne('App\Verified');
    }

    public function vposts() {
        return $this->hasMany('App\Verified')->orderBy('created_at', 'DESC');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }

    public function comment() {
        return $this->hasOne('App\Comment');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function hasAnyRoles($roles) {
        if($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function hasRole($roles) {
        if($this->roles()->where('name', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function profileImage() {
        $imagePath = ($this->image) ? $this->image : 'profile/no-image-available.png';
        return "/storage/" . $imagePath;
    }
}
