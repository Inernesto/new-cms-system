<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Post extends Model
{
    //
	
	protected $fillable = 
		[ 'user_id', 
		 'title', 
		 'post_image', 
		 'body', 
		];
	
	
	public function user(){
		
		return $this->belongsTo(User::class);
	}
	
	
//	public function setPostImageAttribute($value){
//		
//		$this->attributes['post_image'] = asset($value);
//	}
	
	
	public function getPostImageAttribute($value){
		
		if(Str::before($value, '/') == 'https:'){
			return asset($value);
		}else{
			return asset('storage/' . $value);	
		}
		 
	}
}
