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
    <h2 class="text-center fw-bold mb-4 font-audiowide text-black fs-2">
      Featured Products
    </h2>

    <div class="row g-4" id="productList"></div>

    <div class="text-center mt-4 d-none" id="showMoreWrapper">
      <button class="btn btn-outline-danger btn-sm" id="btnShowMore">
        <i class="fas fa-chevron-down me-3"></i>Show More Products
      </button>
    </div>
  </div>
</section>

@push('scripts')
<script>
  let featuredOffset = 0;
  const featuredLimit = 3;

  function loadFeaturedProducts(isInitial = false) {
    if (isInitial) {
      featuredOffset = 0;
      $('#productList').html('');
    }
    
    $.get('/api/products/featured', {
      limit: featuredLimit,
      offset: featuredOffset
    }, function(res) {
      const products = res.data;
      const total = res.total;

      products.forEach(p => {
        $('#productList').append(productCardTemplate(p));
      });

      featuredOffset += products.length;

      if (featuredOffset < total) {
        $('#showMoreWrapper').removeClass('d-none');
      } else {
        $('#showMoreWrapper').addClass('d-none');
      }
    });
  }

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

            <div class="price">
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

  $(function() {

    // Initial load (max 3)
    loadFeaturedProducts(true);

    // Show more
    $('#btnShowMore').on('click', function() {
      loadFeaturedProducts();
    });

    // Product modal
    $(document).on('click', '.product-card', function() {
      const productId = $(this).data('id');

      $('#productModal').modal('show');
      $('#productName').text('Loading...');
      $('#productDescription').text('');
      $('#productPrice').html('<span class="text-muted">Loading...</span>');
      $('#productImage').addClass('d-none');

      $.get(`/api/products/${productId}`)
        .done(function(product) {
          const hasDiscount = product.discount_price && product.discount_price < product.price;
          const mainPrice = hasDiscount ? product.discount_price : product.price;

          $('#productName').text(product.name);
          $('#productDescription').text(product.description);

          $('#productImage')
            .attr('src', `/assets/images/products/${product.image}`)
            .removeClass('d-none');

          $('#productPrice').html(`
            <span class="text-danger fw-bold">
              Rp ${Number(mainPrice).toLocaleString()}
            </span>
            ${hasDiscount
              ? `<del class="text-muted ms-2">
                  Rp ${Number(product.price).toLocaleString()}
                 </del>`
              : ''
            }
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