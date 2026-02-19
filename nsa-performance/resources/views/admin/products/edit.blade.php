@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2>Edit Product</h2>

  <form action="{{ route('admin.products.update', $product) }}"
    method="POST"
    enctype="multipart/form-data">

    @method('PUT')
    @include('admin.products._form')
  </form>
</div>
@endsection