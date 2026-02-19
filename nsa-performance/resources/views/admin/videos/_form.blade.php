

@csrf

@if($errors->any())
<div class="alert alert-danger">
	<ul class="mb-0">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<div class="mb-3">
	<label>Video URL (YouTube / Embed)</label>
	<input type="text" name="url" class="form-control" value="{{ old('url', $video->url ?? '') }}" required>
</div>

<div class="mb-3">
	<label>Title</label>
	<input type="text" name="title" class="form-control" value="{{ old('title', $video->title ?? '') }}" required>
</div>

<div class="mb-3">
	<label class="form-label">Excerpt</label>
	<textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $video->excerpt ?? '') }}</textarea>
</div>

<div class="mb-3">
	<label class="form-label">Status</label>
	<select name="status" class="form-select">
		<option value="draft" @selected(old('status', $video->status ?? 'draft') === 'draft')>Draft</option>
		<option value="published" @selected(old('status', $video->status ?? '') === 'published')>Published</option>
	</select>
</div>

<div class="d-flex justify-content-start mt-5 gap-3">
	<a href="{{ route('admin.videos.index') }}" class="btn btn-secondary px-3">Cancel</a>
	<button type="submit" class="btn btn-success px-3">Save</button>
</div>
