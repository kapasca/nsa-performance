@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-4">Manage Products</h2>
    <!-- logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-danger">Logout</button>
    </form>
  </div>

  <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
    + Add Product
  </a>

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th class="text-center">Featured</th>
        <th class="text-center" width="150">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->name }}</td>
        <td>Rp {{ number_format($product->price) }}</td>
        <td class="text-center">
          <input type="checkbox"
            class="form-check-input js-toggle-featured"
            data-id="{{ $product->id }}"
            {{ $product->is_featured ? 'checked' : '' }}>
        </td>
        <td class="text-center">
          <a href="{{ route('admin.products.edit', $product) }}"
            class="btn btn-sm btn-warning">Edit</a>

          <form action="{{ route('admin.products.destroy', $product) }}"
            method="POST"
            class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger"
              onclick="return confirm('Delete this product?')">
              Delete
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