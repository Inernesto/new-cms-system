<x-admin-master>
	
	@section('content')
			
		@if(session()->has('role-updated'))
			<div class="alert alert-success">
				{{session('role-updated')}}
			</div>
		@endif
			
		
		<h1>Edit Role: {{$role->name}}</h1>
		
			<div class="row">
				<div class="col-sm-6">

					<form method="post" action="{{route('role.update', $role->id)}}">
						@csrf
						@method('PUT')

						<div class="form-group">
						<label for="name">Name</label>
						<input class="form-control" type="text" name="name" id="name" value="{{$role->name}}">
						</div>

						<button class="btn btn-primary">Update</button>
					</form>
				</div>				
			</div>
			
			<div class="row">
				
				<div class="col-lg-12">
				
					@if($permissions->isNotEmpty())
					
						<div class="card shadow mb-4">
						<div class="card-header py-3">
						  <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
						</div>
						<div class="card-body">
						  <div class="table-responsive">
							<table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
							  <thead>
								<tr>

								  <th>Options</th>
								  <th>Id</th>
								  <th>Name</th>
								  <th>Slug</th>
								  <th>Created At</th>
								  <th>Updated At</th>
								  <th>Attach</th>
								  <th>Detach</th>
								  
								</tr>
							  </thead>
							  <tfoot>
								<tr>

								  <th>Options</th>
								  <th>Id</th>
								  <th>Name</th>
								  <th>Slug</th>
								  <th>Created At</th>
								  <th>Updated At</th>
								  <th>Attach</th>
								  <th>Detach</th>
								  
								</tr>
							  </tfoot>
							  <tbody>
								
								@foreach($permissions as $permission)
								
								 <tr>

								   <td><input type="checkbox" 

										  @foreach($role->permissions as $role_permission)
												@if($role_permission->slug == $permission->slug)
													checked
												@endif				   	   		  		
										  @endforeach

								   ></td>
								   <td>{{$permission->id}}</td>
								   <td>{{$permission->name}}</td>
								   <td>{{$permission->slug}}</td>					   
								   <td>{{$permission->created_at}}</td>
								   <td>{{$permission->updated_at}}</td>
								   <td>
										<form method="post" action="{{route('role.permission.attach', $role)}}">
										@method('PUT')
										@csrf

										<input type="hidden" name="permission" value="{{$permission->id}}">

											<button class="btn btn-primary"

												@if($role->permissions->contains($permission))
												disabled
												@endif
											>
											Attach

											</button>

										</form>

								   </td>
								   
								   <td>
										<form method="post" action="{{route('role.permission.detach', $role)}}">
										@method('PUT')
										@csrf

										<input type="hidden" name="permission" value="{{$permission->id}}">

											<button class="btn btn-danger"

												@if(!$role->permissions->contains($permission))
												disabled
												@endif
											>
											Detach

											</button>

										</form>

								   </td>								   

								 </tr>
								 
								@endforeach
							  </tbody>
							</table>
						  </div>
					</div>

				  </div>
         			
          			@endif
          			
				</div>
			</div>
	@endsection
</x-admin-master>