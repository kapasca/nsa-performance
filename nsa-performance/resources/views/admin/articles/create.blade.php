
@extends('layouts.admin')

@section('content')
<div class="container py-5">
  <h2 class="mb-5">Create Article</h2>

  <form method="POST" action="{{ route('admin.articles.store') }}">
    @include('admin.articles._form')
  </form>
</div>
@endsection