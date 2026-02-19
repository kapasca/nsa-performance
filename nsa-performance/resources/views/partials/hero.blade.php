@push('styles')
<style>
  #hero,
  #hero .carousel,
  #hero .carousel-inner,
  #hero .carousel-item {
    height: 100vh;
  }

  #hero img {
    height: 100vh;
    object-fit: cover;
  }

  .carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 4rem 6rem 6rem 6rem;
    background: linear-gradient(to top,
        rgba(0, 0, 0, 1),
        rgba(0, 0, 0, 0));
    text-align: left;
  }

  .carousel-caption h1 {
    font-size: 3.5rem;
    font-family: 'Audiowide', cursive;
    text-shadow: 
    5px 5px 3px #000000, 
    -2px -2px 0 #000000,
    2px -2px 0 #000000,
    -2px 2px 0 #000000;
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .carousel-caption h1 .lighter {
    font-weight: normal;
    font-size: 2.7rem;
    color: #cfb6b6;
    letter-spacing: 2px;
  }

  .carousel-caption p {
    letter-spacing: 2px;
  }

  .btn-explore {
    letter-spacing: 2px;
    padding: 0.25rem 1.25rem;
    border-radius: 7px;
    font-size: 0.9rem;
    margin-top: 5px;
  }

  @media (max-width: 991px) {
    #hero {
      margin-top: 80px;
    }
  }

  @media (max-width: 768px) {

    #hero,
    #hero .carousel,
    #hero .carousel-inner,
    #hero .carousel-item {
      height: 40vh;
    }

    #hero img {
      height: 40vh;
    }

    .carousel-caption {
      padding: 1rem 2rem;
    }

    .carousel-caption h1 {
      font-size: 2rem;
    }

    .carousel-caption h1 .lighter {
      font-size: 1.5rem;
    }

  }
</style>
@endpush

<section id="hero">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="{{ asset('assets/images/slides/slide-1.jpg') }}" class="d-block w-100">
        <div class="carousel-caption text-center">
          <h1 class="fw-bold text-danger mb-1 d-flex justify-content-center"><div>NSA</div><div class="lighter">Performance</div></h1>
          <a href="#products" class="btn btn-danger btn-sm btn-explore mb-3"><i class="fas fa-shopping-cart me-2"></i> Explore Products</a>
        </div>
      </div>

      <div class="carousel-item">
        <img src="{{ asset('assets/images/slides/slide-2.jpg') }}" class="d-block w-100">
        <div class="carousel-caption text-end">
            <h1 class="fw-bold text-danger mb-1 d-flex justify-content-end"><div>RACING</div><div class="lighter">Ready</div></h1>
          <p>Built for Speed & Reliability</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="{{ asset('assets/images/slides/slide-3.jpg') }}" class="d-block w-100">
        <div class="carousel-caption text-start">
          <h1 class="fw-bold text-danger mb-1 d-flex justify-content-start"><div>PREMIUM</div><div class="lighter">Accessories</div></h1>
          <p>Style Meets Performance</p>
        </div>
      </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>
</section>