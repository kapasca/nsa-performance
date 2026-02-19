
@extends('layouts.admin')

@section('content')
<div class="container py-5">
  <h2 class="mb-5">Edit Article</h2>

  <form method="POST" action="{{ route('admin.articles.update', $article) }}">
    @method('PUT')
    @include('admin.articles._form', ['article' => $article])
  </form>
</div>
@endsection