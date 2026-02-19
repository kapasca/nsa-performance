<section id="articles" class="py-5 bg-white text-black">
  <div class="container">
    <h2 class="text-center fw-bold mb-4 font-audiowide text-black fs-2">
      Latest Articles
    </h2>

    <div class="row g-4" id="articleList"></div>

    <div class="text-center mt-4 d-none" id="showMoreArticlesWrapper">
      <button class="btn btn-outline-dark btn-sm" id="btnShowMoreArticles">
        <i class="fas fa-chevron-down me-2"></i>Show More Articles
      </button>
    </div>
  </div>
</section>

@push('scripts')
<script>
  let articleOffset = 0;
  const articleLimit = 3;

  function articleCardTemplate(article) {
    return `
      <div class="col-md-4">
        <a href="/articles/${article.slug}" class="text-decoration-none text-dark">
          <div class="card bg-white h-100 border">
            <div class="card-body">
              <h5 class="fw-bold">${article.title}</h5>
              <p class="text-muted mb-0">
                ${article.excerpt ?? ''}
              </p>
            </div>
          </div>
        </a>
      </div>
    `;
  }

  function loadLatestArticles(isInitial = false) {
    if (isInitial) {
      articleOffset = 0;
      $('#articleList').html('');
    }

    $.get('/api/articles/latest', {
      limit: articleLimit,
      offset: articleOffset
    }, function(res) {

      res.data.forEach(a => {
        $('#articleList').append(articleCardTemplate(a));
      });

      articleOffset += res.data.length;

      if (articleOffset < res.total) {
        $('#showMoreArticlesWrapper').removeClass('d-none');
      } else {
        $('#showMoreArticlesWrapper').addClass('d-none');
      }
    });
  }

  $(function() {
    loadLatestArticles(true);

    $('#btnShowMoreArticles').on('click', function() {
      loadLatestArticles();
    });
  });
</script>
@endpush