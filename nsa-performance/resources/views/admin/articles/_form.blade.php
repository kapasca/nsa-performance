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
  <label>Title</label>
  <input
    type="text"
    name="title"
    class="form-control"
    value="{{ old('title', $article->title ?? '') }}"
    required>
</div>

<div class="mb-3">
  <label>Slug</label>
  <input
    type="text"
    name="slug"
    class="form-control"
    value="{{ old('slug', $article->slug ?? '') }}"
    required>
</div>

<div class="mb-3">
  <label>Excerpt</label>
  <textarea
    name="excerpt"
    class="form-control"
    rows="3">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
</div>

<div class="mb-3">
  <label>Content</label>
  <textarea
    name="content"
    class="form-control"
    rows="8"
    required>{{ old('content', $article->content ?? '') }}</textarea>
</div>

<div class="mb-3">
  <label>Status</label>
  <select name="status" class="form-select">
    <option value="draft" @selected(old('status', $article->status ?? 'draft') === 'draft')>
      Draft
    </option>
    <option value="published" @selected(old('status', $article->status ?? '') === 'published')>
      Published
    </option>
  </select>
</div>

<div class="d-flex justify-content-start mt-5 gap-3">
  <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary px-3">Cancel</a>
  <button type="submit" class="btn btn-success px-3">Save</button>
</div>