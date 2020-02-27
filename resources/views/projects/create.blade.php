@extends('layouts.app')

@section('content')
	<div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 rounded shadow">
		<h1 class="heading is-1">Create a Project</h1>
		<form action="/projects" method="POST">
			@csrf
			
			@include('projects.form', ['project' => new App\Project, 
			'buttonText' => 'Create Project'])

			
		</form>
	</div>
	
@endsection