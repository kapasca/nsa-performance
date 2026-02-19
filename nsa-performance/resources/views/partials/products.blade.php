@push('styles')
<style>
  .product-card .card-body .price .text-muted {
    color: #aaaaaa !important;
    font-size: 0.8rem;
  }

  .product-card .card-title {
    font-size: 1rem;
  }
</style>
@endpush

<section id="products" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-4 font-audiowide text-black fs-2">Featured Products</h2>

    <div class="row g-4" id="productList">
      <!-- AJAX injected -->
    </div>
  </div>
</section>

@push('scripts')
<script>
  function productCardTemplate(product) {
    const hasDiscount = product.discount_price && product.discount_price < product.price;

    const mainPrice = hasDiscount ?
      product.discount_price :
      product.price;

    return `
      <div class="col-md-4 mb-4">
        <div class="card bg-dark text-white h-100 product-card" data-id="${product.id}">
          <img src="/assets/images/products/${product.image}" class="card-img-top">

          <div class="card-body">
            <h5 class="card-title">${product.name}</h5>

            <div class="price d-flex align-items-center">
              <span class="text-danger fw-bold">
                Rp ${Number(mainPrice).toLocaleString()}
              </span>

              ${
                hasDiscount
                  ? `<del class="text-muted ms-2">
                      Rp ${Number(product.price).toLocaleString()}
                     </del>`
                  : ''
              }
            </div>
          </div>
        </div>
      </div>
    `;
  }

  // Document ready
  $(function() {

    // Load featured products
    $.get('/api/products/featured', function(products) {
      let html = '';
      products.forEach(p => {
        html += productCardTemplate(p);
      });
      $('#productList').html(html);
    });

    // Click product → load modal
    $(document).on('click', '.product-card', function() {
      const productId = $(this).data('id');

      $('#productModal').modal('show');
      $('#productName').text('Loading...');
      $('#productDescription').text('');
      $('#productPrice').html('<span class="text-muted">Loading...</span>');
      $('#productPrice').html('');
      $('#productImage').attr('src', '').addClass('d-none');

      $.get(`/api/products/${productId}`)
        .done(function(product) {
          $('#productName').text(product.name);
          $('#productDescription').text(product.description);

          $('#productImage').attr('src', `/assets/images/products/${product.image}`).removeClass('d-none');

          const hasDiscount = product.discount_price && product.discount_price < product.price;
          const mainPrice = hasDiscount ? product.discount_price : product.price;

          $('#productPrice').html(`
            <span class="text-danger fw-bold">Rp ${Number(mainPrice).toLocaleString()}</span>
            ${hasDiscount ? `<del class="text-muted ms-2">Rp ${Number(product.price).toLocaleString()}</del>` : ''}
          `);
        })
        .fail(function() {
          $('#productName').text('Error');
          $('#productDescription').text('Failed to load product.');
          $('#productPrice').html('');
        });
    });

  });
</script>
@endpush