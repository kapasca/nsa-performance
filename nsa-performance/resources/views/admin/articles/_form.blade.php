@csrf

<div class="mb-3">
  <label class="form-label">Title</label>
  <input
    type="text"
    name="title"
    class="form-control"
    value="{{ old('title', $article->title ?? '') }}"
    required>
</div>

<div class="mb-3">
  <label class="form-label">Slug</label>
  <input
    type="text"
    name="slug"
    class="form-control"
    value="{{ old('slug', $article->slug ?? '') }}"
    required>
</div>

<div class="mb-3">
  <label class="form-label">Excerpt</label>
  <textarea
    name="excerpt"
    class="form-control"
    rows="3">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
</div>

<div class="mb-3">
  <label class="form-label">Content</label>
  <textarea
    name="content"
    class="form-control"
    rows="8"
    required>{{ old('content', $article->content ?? '') }}</textarea>
</div>

<div class="mb-3">
  <label class="form-label">Status</label>
  <select name="status" class="form-select">
    <option value="draft"
      @selected(old('status', $article->status ?? 'draft') === 'draft')
      >
      Draft
    </option>
    <option value="published"
      @selected(old('status', $article->status ?? '') === 'published')
      >
      Published
    </option>
  </select>
</div>

<div class="d-flex gap-2">
  <button type="submit" class="btn btn-primary">
    Save
  </button>

  <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
    Cancel
  </a>
</div>