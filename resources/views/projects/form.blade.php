


	
	<div class="field">
		<label for="title">Title</label>
	</div>
	<div class="control">
		<input type="text" name="title" value="{{$project->title}}" required />
	</div>
	<div class="field mb-6">
		<label for="description" class="label text-sm mb-2 block">Description</label>
	
		<div class="control">
			<textarea 
			type="text" 
			name="description"
			rows="10"
			class="textarea bg-transparent border border-grey-light rounded p-2 text-xs w-full"
			required>
				{{$project->description}}
			</textarea>
		</div>
	</div>
	<div class="field">
		<div class="control">
		   <button type="submit" class="button is-link mr-2">{{$buttonText}}</button>
			<a href="{{$project->path()}}" >Cancel</a>		
		</div>
	</div>
	<div class="field mt-6">
		@if ($errors->any())
			@foreach($errors->all() as $error)
				<li class="text-sm text-red"> {{ $error }} </li>
			@endforeach
		@endif
	</div>
	
