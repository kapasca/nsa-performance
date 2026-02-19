@extends('layouts.admin')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-5">
    <div class="d-flex align-items-center gap-4">
      <div class="d-flex align-items-center gap-3">
        <i class="fas fa-boxes text-primary fs-4"></i>
        <h2 class="mb-0">Manage Products</h2>
      </div>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-0"><i class="fas fa-plus me-3"></i>Add Product</a>
  </div>

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th width="120" class="text-center">Image</th>
        <th width="" class="text-center">Name</th>
        <th width="12%" class="text-center">Featured</th>
        <th width="12%" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td class="text-center">
          @if($product->image)
          <img src="/assets/images/products/{{ $product->image }}" alt="{{ $product->name }}"
            class="img-thumbnail" width="100">
          @else
          <span class="text-muted">No Image</span>
          @endif
        </td>
        <td>
          <strong>{{ $product->name }}</strong>
          <div>
            @if($product->discount_price && $product->discount_price < $product->price)
            <span class="text-danger fw-bold">Rp {{ number_format($product->discount_price) }}</span>
            <span class="text-muted text-decoration-line-through">Rp {{ number_format($product->price) }}</span>
            @else
            <span class="fw-bold">Rp {{ number_format($product->price) }}</span>
            @endif
          </div>
          <small class="text-muted d-block mt-1">{{ $product->description }}</small>
        </td>
        <td class="text-center">
          <div class="form-check form-switch d-inline-flex align-items-center gap-2">
            <input type="checkbox"
              class="form-check-input js-toggle-featured"
              data-id="{{ $product->id }}"
              {{ $product->is_featured ? 'checked' : '' }}>
          </div>
        </td>
        <td class="text-center">
          <a href="{{ route('admin.products.edit', $product) }}"
            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>

          <form action="{{ route('admin.products.destroy', $product) }}"
            method="POST"
            class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger"
              onclick="return confirm('Delete this product?')">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $products->links() }}
</div>
@endsection

@push('scripts')
<script>
  $(document).on('change', '.js-toggle-featured', function() {
    const productId = $(this).data('id');

    $.ajax({
      url: `/admin/products/${productId}/toggle-featured`,
      method: 'PATCH',
      data: {
        _token: '{{ csrf_token() }}'
      }
    });
  });
</script>
@endpush