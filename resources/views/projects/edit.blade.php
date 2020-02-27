@extends('layouts.app')
@section('content')
<div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 rounded shadow">
	<h1 class="heading is-1">Edit Project</h1>
	<form action="{{$project->path()}}" method="POST" 
		class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 rounded shadow">
		@csrf
		@method('PATCH')
		@include('projects.form', [			
			'buttonText' => 'Update Project'
			])		
	</form>
</div>
@endsection