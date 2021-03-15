<x-admin-master>
	
	@section('content')
			
		@if(session()->has('permission-updated'))
			<div class="alert alert-success">
				{{session('permission-updated')}}
			</div>
		@endif
			
		
		<h1>Edit Permission: {{$permission->name}}</h1>
		
			<div class="row">
				<div class="col-sm-6">

					<form method="post" action="{{route('permission.update', $permission->id)}}">
						@csrf
						@method('PUT')

						<div class="form-group">
						<label for="name">Name</label>
						<input class="form-control" type="text" name="name" id="name" value="{{$permission->name}}">
						</div>

						<button class="btn btn-primary">Update</button>
					</form>
				</div>				
			</div>
			
	@endsection
</x-admin-master>