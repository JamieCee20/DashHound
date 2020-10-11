<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

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

    // A user has one discussion
    public function discussion() {
        return $this->hasOne('App\Discussion');
    }

    // A user can have many discussions
    public function discussions() {
        return $this->hasMany('App\Discussion');
    }

    public function posts() {
        return $this->hasMany('App\Post')->orderBy('created_at', 'DESC');
    }

    public function vpost() {
        return $this->hasOne('App\Verified');
    }

    public function like() {
        return $this->hasOne('App\Like');
    }

    public function likes() {
        return $this->hasMany('App\Like');
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

    public function replies() {
        return $this->hasMany('App\Reply');
    }

    public function officialPublisher($user) {
        return '/storage/images/verified.png';
    }
}
