@extends('layouts.main')

@section('title')
  {{ $title = "Home" }}
@endsection

@section('hero')
  <div class="container">
    <div class="row">
      <div class="col-xl-4">
        <h2 data-aos="fade-up">Who are we?</h2>
        <blockquote data-aos="fade-up" data-aos-delay="100">
          <p>Due to COVID-19 pandemic, countless school are having trouble conducting lessons. We are now here to aid those schools to request help from the public. Start registering now to join us in this mission. </p>
        </blockquote>
        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="/register" class="btn-get-started">Register Now</a> &nbsp; &nbsp;
          <a href="/about" class="btn-get-started" style="background-color:#36718c">More Info</a>
        </div>

      </div>
    </div>
  </div>
@endsection

@section("main")

  <!-- ======= Recent Blog Posts Section ======= -->
  <section id="recent-posts" class="recent-posts">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Recent Blog Posts</h2>

      </div>

      <div class="row gy-5">

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="post-box">
            <div class="post-img"><img src="/img/blog/blog-1.jpg" class="img-fluid" alt=""></div>
            <div class="meta">
              <span class="post-date">Tue, December 12</span>
              <span class="post-author"> / Julia Parker</span>
            </div>
            <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>
            <p>Illum voluptas ab enim placeat. Adipisci enim velit nulla. Vel omnis laudantium. Asperiores eum ipsa est officiis. Modi qui magni est...</p>
            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="post-box">
            <div class="post-img"><img src="/img/blog/blog-2.jpg" class="img-fluid" alt=""></div>
            <div class="meta">
              <span class="post-date">Fri, September 05</span>
              <span class="post-author"> / Mario Douglas</span>
            </div>
            <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>
            <p>Voluptatem nesciunt omnis libero autem tempora enim ut ipsam id. Odit quia ab eum assumenda. Quisquam omnis doloribus...</p>
            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="post-box">
            <div class="post-img"><img src="/img/blog/blog-3.jpg" class="img-fluid" alt=""></div>
            <div class="meta">
              <span class="post-date">Tue, July 27</span>
              <span class="post-author"> / Lisa Hunter</span>
            </div>
            <h3 class="post-title">Quia assumenda est et veritati</h3>
            <p>Quia nam eaque omnis explicabo similique eum quaerat similique laboriosam. Quis omnis repellat sed quae consectetur magnam...</p>
            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="post-box">
            <div class="post-img"><img src="/img/blog/blog-4.jpg" class="img-fluid" alt=""></div>
            <div class="meta">
              <span class="post-date">Tue, Sep 16</span>
              <span class="post-author"> / Mario Douglas</span>
            </div>
            <h3 class="post-title">Pariatur quia facilis similique deleniti</h3>
            <p>Et consequatur eveniet nam voluptas commodi cumque ea est ex. Aut quis omnis sint ipsum earum quia eligendi...</p>
            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Recent Blog Posts Section -->
  
  <!-- ======= Call To Action Section ======= -->
  <section id="call-to-action" class="call-to-action">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h3>Ut fugiat aliquam aut non</h3>
          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
            <a href="#" class="cta-btn" style="outline: 0px">Call To Action</a>
        </div>
      </div>
    </div>
  </section><!-- End Call To Action Section -->

@endsection