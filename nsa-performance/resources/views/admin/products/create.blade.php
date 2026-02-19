@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2>Create Product</h2>

  <form action="{{ route('admin.products.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @include('admin.products._form')
  </form>
</div>
@endsection