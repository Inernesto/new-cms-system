<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
	
	public function index(){
		//
		
//		$posts = Post::all();
		$posts = auth()->user()->posts()->paginate(2);
		return view('admin.posts.index', ['posts' => $posts]);
	}
	

	public function create(){
		//
		$this->authorize('create', Post::class);
		
		return view('admin.posts.create');
	}
	
	
	public function show(Post $post){
		
		return view('blog-post', ['post' => $post]);
	}
	
	
	public function store(){
		$this->authorize('create', Post::class);
		
		$inputs = request()->validate([
			'title' => 'required|min:8|max:255',
			'post_image' => 'file',
			'body' => 'required'
		]);
		
		if(request('post_image')){
			$inputs['post_image'] = request('post_image')->store('image');
		}
		
		auth()->user()->posts()->create($inputs);
		
		session()->flash('post-created-message', 'Post was Created');
		
		return redirect()->route('post.index');
	}
	
	
	public function edit(Post $post){
		
//		$this->authorize('view', $post);
		
		/*** also you can do the authorization using can ***/
		
		if(auth()->user()->can('view', $post)){
			
			return view('admin.posts.edit', ['post' => $post]);
		}
		
	}
	
	
	public function update(Post $post){
		
		$inputs = request()->validate([
			'title' => 'required|min:8|max:255',
			'post_image' => 'file',
			'body' => 'required',
		]);
		
		
		if(request('post_image')){
			
			$inputs['post_image'] = request('post_image')->store('images');
			$post->post_image = $inputs['post_image'];
		}
		
		$post->title = $inputs['title'];
		$post->body  = $inputs['body'];
		
		$this->authorize('update', $post);

		$post->save();
		
		session()->flash('post-updated-message', 'Post was updated');
		
		return redirect()->route('post.index');
	}
	
	
	public function destroy(Post $post){
		
        $this->authorize('delete', $post);
		
		$post->delete();
		
		Session::flash('message', 'Post was deleted');
		
		return back();
	}
}
