<section id="products" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-4">Our Products</h2>

    <div class="row g-4" id="product-list">
      @push('scripts')
      <script>
        $(function() {

          // Dummy products (sementara)
          let products = [{
              id: 1,
              name: 'Racing Brake Kit',
              price: 'Rp 950.000',
              original_price: 'Rp 1.200.000',
              description: 'High performance brake system.',
              image: '/assets/images/product-1.jpg'
            },
            {
              id: 2,
              name: 'Exhaust System',
              price: 'Rp 1.500.000',
              original_price: '',
              description: 'Lightweight racing exhaust.',
              image: '/assets/images/product-2.jpg'
            }
          ];

          // Render products
          $.each(products, function(_, product) {
            $('#product-list').append(`
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="${product.image}" class="card-img-top">
                    <div class="card-body">
                        <h6 class="fw-bold">${product.name}</h6>
                        <p class="mb-1 text-danger fw-bold">${product.price}</p>
                        <button class="btn btn-outline-danger btn-sm w-100 btn-preview"
                            data-product='${JSON.stringify(product)}'>
                            Preview
                        </button>
                    </div>
                </div>
            </div>
        `);
          });

          // Preview modal
          $(document).on('click', '.btn-preview', function() {
            let product = $(this).data('product');

            $('#productName').text(product.name);
            $('#productImage').attr('src', product.image);
            $('#productPrice').html(`
            <span class="fw-bold text-danger">${product.price}</span>
            ${product.original_price ? `<small class="text-muted text-decoration-line-through ms-2">${product.original_price}</small>` : ''}
        `);
            $('#productDescription').text(product.description);

            $('#productModal').modal('show');
          });

        });
      </script>
      @endpush

    </div>
  </div>
</section>