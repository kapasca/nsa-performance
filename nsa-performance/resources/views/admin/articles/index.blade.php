@extends('layouts.admin')

@section('content')
<div class="container py-5">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-5">
    <div class="d-flex align-items-center gap-3">
      <i class="fas fa-newspaper text-primary fs-4"></i>
      <h2 class="mb-0">Manage Articles</h2>
    </div>

    <a href="{{ route('admin.articles.create') }}"
      class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>
      Add Article
    </a>
  </div>

  <!-- Flash message -->
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <!-- Table -->
  <table class="table table-bordered align-middle">
    <thead>
      <tr>
        <th width="40%">Title</th>
        <th width="20%" class="text-center">Date Published</th>
        <th width="20%" class="text-center">Publish</th>
        <th width="20%" class="text-center">Action</th>
      </tr>
    </thead>

    <tbody>
      @forelse($articles as $article)
      <tr>
        <!-- Title -->
        <td>
          <strong>{{ $article->title }}</strong>

          @if($article->excerpt)
          <small class="text-muted d-block mt-1">
            {{ Str::limit($article->excerpt, 100) }}
          </small>
          @endif
        </td>

        <!-- Published date -->
        <td class="text-center">
          {{ $article->published_at
                ? $article->published_at->format('d M Y H:i')
                : '-' }}
        </td>

        <!-- Status -->
        <td class="text-center">
          <div class="form-check form-switch d-inline-flex align-items-center gap-2">
            <input class="form-check-input article-publish-toggle" type="checkbox" data-id="{{ $article->id }}" {{ $article->status === 'published' ? 'checked' : '' }}>
          </div>
        </td>

        <!-- Actions -->
        <td class="text-center">
          <a href="{{ route('admin.articles.edit', $article) }}"
            class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i>
          </a>

          <form action="{{ route('admin.articles.destroy', $article) }}"
            method="POST"
            class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger"
              onclick="return confirm('Delete this article?')">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center text-muted">
          No articles found.
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <!-- Pagination -->
  {{ $articles->links() }}

</div>
@endsection

@push('scripts')
<script>
  $(document).on('change', '.article-publish-toggle', function() {
    const checkbox = $(this)
    const articleId = checkbox.data('id')

    $.ajax({
      url: `/admin/articles/${articleId}/toggle-publish`,
      type: 'PATCH',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success(res) {
        const badge = checkbox.closest('td').find('.badge')

        if (res.status === 'published') {
          badge
            .removeClass('bg-secondary')
            .addClass('bg-success')
            .text('Published')
        } else {
          badge
            .removeClass('bg-success')
            .addClass('bg-secondary')
            .text('Draft')
        }

        const publishedCell = checkbox
          .closest('tr')
          .find('td:nth-child(3)')

        publishedCell.text(res.published_at ?? '-')
      },
      error() {
        alert('Failed to update publish status.')
        checkbox.prop('checked', !checkbox.prop('checked'))
      }
    })
  })
</script>
@endpush