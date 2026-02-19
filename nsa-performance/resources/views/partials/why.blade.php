<section class="py-5 bg-dark text-white">
  <div class="container text-center">
    <h2 class="fw-bold mb-4 text-danger font-audiowide">Why Choose NSA Performance?</h2>

    <div class="row">
      <div class="col-md-4">
        <img height="150" src="{{ asset('assets/images/logo/part-quality.svg') }}" alt="High Quality Parts" class="why-image mb-3">
        <h5>High Quality Parts</h5>
        <p>Premium racing-grade components.</p>
      </div>
      <div class="col-md-4">
        <img height="150" src="{{ asset('assets/images/logo/value-for-money.svg') }}" alt="High Quality Parts" class="why-image mb-3">
        <h5>Affordable Pricing</h5>
        <p>Competitive prices for enthusiasts.</p>
      </div>
      <div class="col-md-4">
        <img height="150" src="{{ asset('assets/images/logo/party-fun.svg') }}" alt="High Quality Parts" class="why-image mb-3">
        <h5>Trusted by Riders</h5>
        <p>Thousands of satisfied customers.</p>
      </div>
    </div>
  </div>
</section>

@push('styles')
<style>
  .why-image {
    filter: invert(50%);
  }
</style>
@endpush