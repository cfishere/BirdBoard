<div class="card" style="height:200px">
	<h3 class="font-normal text-xl py-4"><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h3>
	<div class="text-grey">
		{{ Str::limit( $project->description, 100 ) }}
	</div>
</div>
	
