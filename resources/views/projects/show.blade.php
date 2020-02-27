@extends('layouts.app')
	@section('content')

	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between w-full items-center">
			<p class="text-grey text-sm font-normal">
				<a class="text-grey text-sm font-normal" href="/projects">My Projects</a> / {{$project->title}}
			</p>
			<a class="button" href="{{$project->path().'/edit'}}">Edit Project</a>
		</div>
	</header>
	<main>
		<div class="lg:flex -mx-3">
			<div class="lg:w-3/4 px-3">
				<div class="mb-8">
					<h2 class="text-grey text-lg font-normal mb-3">Tasks</h2>
					@foreach ($project->tasks as $task)						
						<div class="card mb-3">
							<form method="post" action="{{$task->path()}}" >
								@method('PATCH')
								@csrf
								<div class="flex">
									<input class="w-full {{$task->completed ? 'text-grey' : ''}}" name="body" value="{{ $task->body }}" />
									<input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}} />
								</div>		
							</form>		
						</div>						
					@endforeach
					<form action="{{$project->path().'/tasks'}}" method="post">
						@csrf
						<input name="body" class="w-full p-3" placeholder="Enter A Task..." type="text" />
					</form>			
				</div>			
				<div>
					<h2 class="text-grey text-lg font-normal mb-3">General Notes</h2>
						{{-- General Notes --}}
					<form method="post" action="{{ $project->path() }}" >
						@csrf
						@method('PATCH')						
						<textarea 
						name="notes"
						class="card w-full mb-4" 
						style="min-height:170px">
							{{$project->notes}}
						</textarea>

						<button type="submit" class="button">Update</button>
						<div class="field mt-6">
							@if ($errors->any())
								@foreach($errors->all() as $error)
									<li class="text-sm text-red"> {{ $error }} </li>
								@endforeach
							@endif
						</div>
					</form>
				</div>	
			</div>	
			<div class="lg:w-1/4 px-3">
				@include('projects.card')
			</div>
		</div>
	</main>	
@endsection