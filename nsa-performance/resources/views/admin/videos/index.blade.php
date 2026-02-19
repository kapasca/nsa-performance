@extends('layouts.admin')

@section('content')
<div class="container py-5">

  <div class="d-flex justify-content-between align-items-center mb-5">
    <div class="d-flex align-items-center gap-3">
      <i class="fas fa-video text-black fs-4"></i>
      <h2 class="mb-0">Manage Videos</h2>
    </div>

    <a href="{{ route('admin.videos.create') }}" class="btn btn-success">
      <i class="fas fa-plus me-2"></i>
      Add Video
    </a>
  </div>

  <!-- Flash message -->
  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th class="text-center">Title</th>
        <th width="12%" class="text-center">Published</th>
        <th width="12%" class="text-center">Action</th>
      </tr>
    </thead>

    <tbody>
      @foreach($videos as $video)
      <tr>
        <td>
          <strong>{{ $video->title }}</strong>
          @if($video->excerpt)
          <small class="text-muted d-block mt-1">{{ Str::limit($video->excerpt, 100) }}</small>
          @endif
        </td>

        <td class="text-center">
          <div class="form-check form-switch d-inline-flex align-items-center gap-2">
            <input type="checkbox"
              class="form-check-input js-toggle-publish"
              data-id="{{ $video->id }}"
              {{ $video->status === 'published' ? 'checked' : '' }}>
          </div>
        </td>

        <td class="text-center">
          <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>

          <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this video?')">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $videos->links() }}

</div>
@endsection

@push('scripts')
<script>
  $(document).on('change', '.js-toggle-publish', function() {
    const id = $(this).data('id')

    $.ajax({
      url: `/admin/videos/${id}/toggle-publish`,
      method: 'PATCH',
      data: {
        _token: '{{ csrf_token() }}'
      }
    })
  })
</script>
@endpush