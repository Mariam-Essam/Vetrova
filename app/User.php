<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'gender', 'type', 'password',
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

    protected $appends = ["profile_pic"];



    /** 
     * Return user "image" or a path to placeholder image
     */
    public function getProfilePicAttribute(){

        if($this->attributes['image']){
            return Storage::url($this->attributes['image']);
        }

        return $this->attributes['gender'] === "male" ? '/images/user-male.jpg' : '/images/user-male.jpg'; 
    }

    /**
     * Get name property as first and last name
     */
    public function getNameAttribute(){
        return $this->attributes["fname"] . " " . $this->attributes["lname"];
    }


    /**
     * Return true if the user type is "admin"
     */
    public function isAdmin(){
        return $this->attributes["type"] == "admin";
    }

    /**
     * Relationshiop with posts
     */
    public function posts(){
        return $this->hasMany("App\Post", "user_id", "id");
    }
   
   
    /**
     * Relationshiop with products
     */
    public function products(){
        return $this->hasMany('App\Cart', 'user_id', 'id');
    }


    /**
     * Relationship with orders
     */
    public function orders(){
        return $this->hasMany("App\Order", "user_id", "id");
    }

    /**
     * Get date of birth attribute
     */
    public function getDobAttribute(){
        if($this->attributes['day'] && $this->attributes['month'] && $this->attributes['year']){
            return $this->attributes['day'] . '/' . $this->attributes['month'] . '/' . $this->attributes['year'];
        }
        return null;
    }


    /**
     * Followers relationship
     */
    public function followers(){
        return $this->belongsToMany("App\User", "follow", "designer_id", "customer_id");
    }
    
    
    /**
     * Follwed relationship
     */
    public function follows(){
        return $this->belongsToMany("App\User", "follow", "customer_id", "designer_id");
    }


    /**
     * Follow posts
     */
    public function follow_posts(){
        return $this->hasManyThrough(
                        "App\Post",
                        "App\Follow",
                        'follow.customer_id',
                        'posts.user_id',
                        'id',
                        'designer_id');
    }

    
}
