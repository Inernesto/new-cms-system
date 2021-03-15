<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Role;

use App\Permission;

class PermissionController extends Controller
{
    //
	
	public function index(){
		
		return view('admin.permissions.index', ['permissions' => Permission::all(), ]);
	}
	
	
	public function store(){
		
		request()->validate([
			'name' => ['required']
		]);
		
		Permission::create([
			'name' => Str::ucfirst(request('name')),
			'slug' => Str::of(Str::lower(request('name')))->slug('-')
		]);
		
		return back();
	}
	
	
	public function edit(Permission $permission){
		
		return view('admin.permissions.edit', ['permission' => $permission]);
	}
	
	
	public function update(Permission $permission){
		
		request()->validate([
			'name' => ['required']
		]);
		
		$permission->name = Str::ucfirst(request('name'));
		$permission->slug = Str::of(request('name'))->slug('-');
		
		if($permission->isDirty('name')){
			
			session()->flash('permission-updated', 'Permission Updated: ' . request('name'));
			
		 	$permission->save();			
		} else {
			
			session()->flash('permission-updated', 'Nothing has changed');
		}
			
	
		return back();
	}
	
	
	public function destroy(Permission $permission){
		
		$permission->delete();
		
		session()->flash('permission-deleted', 'Deleted Permission ' . $permission->name);
		
		return back();
	}
}
