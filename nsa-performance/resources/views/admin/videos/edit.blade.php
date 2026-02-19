
@extends('layouts.admin')

@section('content')
<div class="container py-5">
	<h2 class="mb-5">Edit Video</h2>

	<form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@include('admin.videos._form', ['video' => $video])
	</form>
</div>
@endsection
