@extends('layouts.app')

@section('content')
<section class="py-5 bg-white text-black">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <!-- back button to homepage on the right -->
        <div class="mb-4 text-end">
          <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
          </a>
        </div>

        {{-- Title --}}
        <h1 class="mb-3 font-audiowide">
          {{ $article->title }}
        </h1>

        {{-- Meta --}}
        <div class="text-muted mb-4">
          {{ $article->published_at?->format('d M Y') }}
        </div>

        {{-- Excerpt --}}
        @if($article->excerpt)
        <p class="lead mb-4">
          {{ $article->excerpt }}
        </p>
        @endif

        <hr class="mb-4">

        {{-- Content --}}
        <div class="article-content">
          {!! nl2br(e($article->content)) !!}
        </div>

      </div>
    </div>

  </div>
</section>
@endsection

@push('styles')
<style>
  .article-content {
    line-height: 1.8;
    font-size: 1.05rem;
  }

  .article-content p {
    margin-bottom: 1.25rem;
  }
</style>
@endpush