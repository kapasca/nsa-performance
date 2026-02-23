@extends('layouts.app')

@push('styles')
<style>
  body {
    background-color: #0a0a0a;
  }

  .store-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
    color: white;
    padding: 100px 0 80px 0;
    text-align: center;
    margin-top: 120px;
    border-bottom: 2px solid #ff4d4d;
    position: relative;
    overflow: hidden;
  }

  .store-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
      linear-gradient(45deg, transparent 48%, rgba(255, 77, 77, 0.03) 50%, transparent 52%),
      linear-gradient(-45deg, transparent 48%, rgba(255, 77, 77, 0.03) 50%, transparent 52%);
    background-size: 30px 30px;
    pointer-events: none;
  }

  .store-header h1 {
    font-family: 'Audiowide', cursive;
    font-size: 3.5rem;
    font-weight: bold;
    margin: 0;
    position: relative;
    text-shadow: 0 0 30px rgba(255, 77, 77, 0.3);
    letter-spacing: 2px;
  }

  .store-header p {
    font-size: 1.2rem;
    color: #aaa;
    margin-top: 15px;
    position: relative;
  }

  .products-container {
    background-color: #0a0a0a;
    min-height: 60vh;
  }

  .product-card {
    background: linear-gradient(145deg, #1a1a1a, #0f0f0f);
    border: 1px solid #2a2a2a;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    position: relative;
  }

  .product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff4d4d, #ff3333);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }

  .product-card:hover {
    transform: translateY(-10px) scale(1.02);
    border-color: #ff4d4d;
    box-shadow: 0 15px 35px rgba(255, 77, 77, 0.3);
  }

  .product-card:hover::before {
    transform: scaleX(1);
  }

  .product-card img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  .product-card:hover img {
    transform: scale(1.1);
  }

  .product-image-wrapper {
    overflow: hidden;
    background: #000;
    position: relative;
  }

  .product-image-wrapper::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.7));
    pointer-events: none;
  }

  .product-card-body {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: linear-gradient(180deg, #1a1a1a 0%, #141414 100%);
  }

  .product-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    color: #ffffff;
    line-height: 1.4;
    letter-spacing: 0.5px;
    min-height: 60px;
    display: flex;
    align-items: center;
  }

  .product-price-wrapper {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid #2a2a2a;
  }

  .product-price {
    font-size: 1.5rem;
    font-weight: 800;
    color: #ff4d4d;
    letter-spacing: 0.5px;
  }

  .price-original {
    font-size: 1rem;
    color: #666;
    text-decoration: line-through;
  }

  .badge-featured {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #ff4d4d, #ff3333);
    color: white;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 700;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(255, 77, 77, 0.4);
    display: flex;
    align-items: center;
    gap: 6px;
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0%, 100% {
      box-shadow: 0 4px 12px rgba(255, 77, 77, 0.4);
    }
    50% {
      box-shadow: 0 4px 20px rgba(255, 77, 77, 0.6);
    }
  }

  .empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #666;
  }

  .empty-state i {
    font-size: 4rem;
    color: #333;
    margin-bottom: 20px;
  }

  .empty-state h3 {
    color: #fff;
    margin-bottom: 10px;
  }

  @media (max-width: 768px) {
    .store-header {
      padding: 60px 0 40px 0;
      margin-top: 100px;
    }

    .store-header h1 {
      font-size: 2.5rem;
    }

    .store-header p {
      font-size: 1rem;
    }

    .product-card img {
      height: 220px;
    }

    .product-card-title {
      font-size: 1.1rem;
      min-height: auto;
    }

    .product-price {
      font-size: 1.3rem;
    }
  }

  @media (max-width: 576px) {
    .store-header h1 {
      font-size: 2rem;
    }

    .product-card-body {
      padding: 20px;
    }
  }
</style>
@endpush

@section('content')

@include('partials.navbar')

<div class="store-header">
  <div class="container">
    <h1>Our Store</h1>
    <p>Discover our premium collection of products</p>
  </div>
</div>

<div class="products-container">
  <div class="container py-5">
    @if($products->count() > 0)
      <div class="row g-4">
        @foreach ($products as $product)
          <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="product-card">
              @if ($product->is_featured)
                <div class="badge-featured">
                  <i class="fas fa-star"></i>
                  <span>Featured</span>
                </div>
              @endif

              <div class="product-image-wrapper">
                <img src="/assets/images/products/{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
              </div>

              <div class="product-card-body">
                <h5 class="product-card-title">{{ $product->name }}</h5>

                <div class="product-price-wrapper">
                  @if ($product->discount_price && $product->discount_price < $product->price)
                    <span class="product-price">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                    <span class="price-original">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                  @else
                    <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="empty-state">
        <i class="fas fa-box-open"></i>
        <h3>No Products Available</h3>
        <p>Check back soon for new products!</p>
      </div>
    @endif
  </div>
</div>

@include('partials.footer')

@endsection
