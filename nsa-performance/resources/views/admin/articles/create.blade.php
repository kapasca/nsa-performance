@extends('layouts.admin')

@section('content')
<h1 class="mb-4">Create Article</h1>

<form
  method="POST"
  action="{{ route('admin.articles.store') }}">
  @include('admin.articles._form')
</form>
@endsection