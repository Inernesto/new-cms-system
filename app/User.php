<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

	protected $guarded = [];
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
	
	
	public function posts(){
		
		return $this->hasMany(Post::class);
	}
	
/** This is for the permission and role ***/
	
	public function permissions(){
		
		return $this->belongsToMany(Permission::class);
	}
	
	
	public function roles(){
		
		return $this->belongsToMany(Role::class);
	}
	
	
	public function userHasRole($role_name){
		
		foreach($this->roles as $role){
			
			if(Str::lower($role_name)  == Str::lower($role->slug)) 
				return true;
		}
		
		return false;
	}
	
	
/*** Password Mutator ***/
	
	
	public function setPasswordAttribute($value){
		$this->attributes['password'] = bcrypt($value);
	}
	
	
/*** Password Accessor ***/
	
	public function getAvatarAttribute($value){
		
		if(Str::before($value, '/') == 'https:'){
			return asset($value);
		}else{
			return asset('storage/' . $value);	
		}
		 
	}
	
}
