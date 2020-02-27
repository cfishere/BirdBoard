
@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between w-full items-center">
			<h2 class="text-grey text-sm font-normal">My Projects</h2>
			<a class="button" href="/projects/create">New Project</a>
		</div>
	</header>
	<main class="flex flex-wrap -mb-3">
		@forelse($projects as $project)
			<div class="w-1/3 px-3 mb-6">
				@include('projects.card')	
			</div>
		@empty 
			<div>You Haven't Created Any Projects.</div>	
		@endforelse
	</main>
@endsection