<section id="videos" class="py-5 bg-dark text-white">
  <div class="container">
    <h2 class="text-center fw-bold mb-4 font-audiowide fs-2 text-danger">Watch in Action</h2>

    <div class="row g-4" id="videoList"></div>

    <div class="text-center mt-4 d-none" id="showMoreVideosWrapper">
      <button class="btn btn-outline-light btn-sm" id="btnShowMoreVideos">
        <i class="fas fa-chevron-down me-3"></i>Show More Videos
      </button>
    </div>
  </div>
</section>

@push('scripts')
<script>
  let videoOffset = 0;
  const videoLimit = 3;

  function loadVideos(isInitial = false) {
    if (isInitial) {
      videoOffset = 0;
      $('#videoList').html('');
    }
    
    function toEmbedUrl(url) {
      try {
        const u = new URL(url);
        const host = u.hostname.toLowerCase();

        if (host.includes('youtube.com') && u.pathname.includes('/shorts/')) {
          const videoId = u.pathname.split('/shorts/')[1];
          return `https://www.youtube.com/embed/${videoId}`;
        }

        if (host.includes('youtube.com')) {
          const v = u.searchParams.get('v');
          if (v) return `https://www.youtube.com/embed/${v}`;
          if (u.pathname.includes('/embed/')) return url;
        }

        if (host === 'youtu.be') {
          return `https://www.youtube.com/embed/${u.pathname.slice(1)}`;
        }

        return url;
      } catch (e) {
        return url;
      }
    }

    $.get('/api/videos/latest', {
      limit: videoLimit,
      offset: videoOffset
    }, function(videos) {
      videos.data.forEach(v => {
        const embed = toEmbedUrl(v.url || '');

        $('#videoList').append(`
          <div class="col-md-4">
            <div class="card bg-white border-0 h-100">
              <iframe class="card-img-top" width="100%" height="530" src="${embed}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <div class="card-body">
                <h5>${v.title}</h5>
                <p class="text-muted mb-0">${v.excerpt ?? ''}</p>
              </div>
            </div>
          </div>
        `);
      });

      videoOffset += videos.data.length;

      if (videoOffset < videos.total) {
        $('#showMoreVideosWrapper').removeClass('d-none');
      } else {
        $('#showMoreVideosWrapper').addClass('d-none');
      }
    });
  }

  $(function() {
    loadVideos(true);

    $('#btnShowMoreVideos').on('click', function() {
      loadVideos();
    });
  });
</script>
@endpush