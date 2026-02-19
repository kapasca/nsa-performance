@extends('layouts.admin')

@section('content')
<h1 class="mb-4">Edit Article</h1>

<form
  method="POST"
  action="{{ route('admin.articles.update', $article) }}">
  @method('PUT')

  @include('admin.articles._form', ['article' => $article])
</form>
@endsection