
@extends('layouts.admin')

@section('content')
<div class="container py-5">
	<h2 class="mb-5">Create Video</h2>

	<form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
		@include('admin.videos._form')
	</form>
</div>
@endsection
