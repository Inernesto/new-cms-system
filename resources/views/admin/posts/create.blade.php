<x-admin-master>
	
	@section('content')
	
		<h1>Create</h1>
			
			<form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
				@csrf
				
				<div class="form-group">
					<label for="rirle">Title</label>
					<input type="text" 
					       name="title" 
					       class="form-control" 
					       id="title" 
					       aria-describedby="" 
					       placeholder="Enter Title">
				</div>
				
				<div class="form-group">
					<label for="rirle">File</label>
					<input type="file" 
					       name="post_image" 
					       class="form-control-file" 
					       id="post_image">
				</div>
				
				<div class="form-group">
					<textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
				</div>
				
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="Submit">
				</div>				
			</form>
	@endsection
</x-admin-master>