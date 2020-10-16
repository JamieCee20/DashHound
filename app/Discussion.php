<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{

    // Define slug as primary route key
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Discussion content that can be filled.
    protected $fillable = ['title', 'slug', 'pinned', 'body', 'image'];

    //Discussion belongs to 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Discussion belongs to 1 category
    public function category() {
        return $this->belongsTo('App\Category');
    }

    //Discussion can have many replies
    public function replies() {
        return $this->hasMany('App\Reply');
    }

    //Discussion time stamp organisation
    function time_ago($timestamp)  
    {  
        $time_ago = strtotime($timestamp);  
        $current_time = time();  
        $time_difference = $current_time - $time_ago;  
        $seconds = $time_difference;  
        $minutes      = round($seconds / 60 );           // value 60 is seconds  
        $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
        $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
        $weeks          = round($seconds / 604800);          // 7*24*60*60;  
        $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
        $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
        if($seconds <= 60) {  
            return "Just Now";  
        } else if($minutes <=60) {  
            if($minutes==1) {  
                return "one minute ago";  
            } else {  
                return "$minutes minutes ago";  
            }  
        } else if($hours <=24) {  
            if($hours==1) {  
                return "an hour ago";  
            } else {  
                return "$hours hrs ago";  
            }  
        } else if($days <= 7) {  
            if($days==1) {  
                return "yesterday";  
            } else {  
                return "$days days ago";  
            }  
        } else if($weeks <= 4.3) { //4.3 == 52/12   
            if($weeks==1) {  
                return "a week ago";  
            } else {  
                return "$weeks weeks ago";  
            }  
        } else if($months <=12) {  
            if($months==1) {  
                return "a month ago";  
            } else {  
                return "$months months ago";  
            }  
        } else {  
            if($years==1) {  
                return "one year ago";  
            } else {  
                return "$years years ago";  
            }  
        }  
    }
}
