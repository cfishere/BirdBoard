<div class="card" style="height:200px">
	<h3 class="font-normal text-xl py-4"><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h3>
	<div class="text-grey mb-4">
		{{ Str::limit( $project->description, 100 ) }}
	</div>
	<footer>
		<form class="text-right" action="{{ $project->path() }}" method="post">
			@method('DELETE')
			@csrf
			
			<button class="text-xs" type="submit">Delete</button>
		</form>

	</footer>
</div>
	
