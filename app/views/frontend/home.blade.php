@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Trang chủ ::
@parent
@stop

{{-- Page content --}}
@section('content')
<section id="ccr-left-section" class="col-md-8">
    <div class="ccr-last-update">
        <div class="update-ribon">Mới cập nhật</div> <!-- /.update-ribon -->
        <span class="update-ribon-right"></span> <!-- /.update-ribon-left -->
        <div class="update-news-text" id="update-news-text">
            <ul id="latestUpdate">
                @foreach($new_update as $new)
                    <li><a href="{{ $new->url() }}">{{ $new->title }}</a></li>
                @endforeach
            </ul>
        </div> <!-- /.update-text -->

        <div class="update-right-border"></div> <!-- /.update-right-border -->
    </div> <!-- / .ccr-last-update -->


    <section id="ccr-slide-main" class="carousel slide" data-ride="carousel">				

        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php $i=0; ?>
            @foreach ($aboutus as $intro)
            <div class="item <?php echo ($i==0)?'active':''; ?>">
                <div class="container slide-element">
                    <img src="{{ asset($intro->mpath . '/770x436_crop/'. $intro->mname) }}" alt="{{ $intro->title }}">
                    <p><a href="{{ $intro->url() }}">{{ $intro->title }}</a></p>
                </div> <!-- /.slide-element -->
            </div> <!--  /.item -->
            <?php $i++; ?>
            @endforeach
        </div> <!-- /.carousel-inner -->

        <!-- slider nav -->
        <a class="carousel-control left" href="#ccr-slide-main" data-slide="prev"><i class="fa fa-arrow-left"></i></a>
        <a class="carousel-control right" href="#ccr-slide-main" data-slide="next"><i class="fa fa-arrow-right"></i></a>

        <ol class="carousel-indicators">
            <li data-target="#ccr-slide-main" data-slide-to="0" class="active"></li>
            <li data-target="#ccr-slide-main" data-slide-to="1"></li>
            <li data-target="#ccr-slide-main" data-slide-to="2"></li>
            <li data-target="#ccr-slide-main" data-slide-to="3"></li>
        </ol> <!-- /.carousel-indicators -->


    </section><!-- /#ccr-slide-main -->




    <section id="ccr-latest-post-gallery">
        <div class="ccr-gallery-ttile">
            <span></span> 
            <p>Dịch vụ</p>
        </div><!-- .ccr-gallery-ttile -->


        <ul class="ccr-latest-post">
            @foreach ($services as $service)
            <?php
            $s_cat = Category::where('id', $service->category_id)->first();
            ?>
            <li>
                <div class="ccr-thumbnail">
                    <img src="{{ asset($service->mpath . '/370x252_crop/'. $service->mname) }}" alt="{{ $service->title }}">
                    <p><a href="/{{ $s_cat->slug }}/{{ $service->slug }}">Chi tiết</a></p>
                </div>
                <h4><a href="/{{ $s_cat->slug }}/{{ $service->slug }}">{{ $service->title }}</a></h4>
            </li>
            @endforeach
        </ul> <!-- /.ccr-latest-post -->

    </section> <!--  /#ccr-latest-post-gallery  -->

    <section class="bottom-border">
    </section> <!-- /#bottom-border -->




    <section id="ccr-world-news">
        <div class="ccr-gallery-ttile">
            <span></span> 
            <p>Tin tức - Sự kiện</p>
        </div> <!-- .ccr-gallery-ttile -->
        <?php
        $top_news = array_shift($block_news);
        ?>
        <section class="featured-world-news">
            <div class="featured-world-news-img"><img src="{{ asset($top_news->mpath . '/370x252_crop/'. $top_news->mname) }}" alt="{{ $top_news->title }}"></div>
            <div class="featured-world-news-post">
                <h5>{{ $top_news->title }}</h5>
                {{ $top_news->excerpt }}
                <div class="like-comment-readmore">
                    <i class="fa fa-thumbs-o-up"> 08</i>
                    <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                    <a class="read-more" href="/tin-tuc-su-kien/{{ $top_news->slug }}">Xem</a>
                </div> <!-- /.like-comment-readmore -->
            </div>
        </section> <!-- /#featured-world-news -->

        <ul>
            @foreach ($block_news as $news)
            <li>
                <div class="ccr-thumbnail">
                    <img src="{{ asset($news->mpath . '/170x100_crop/'. $news->mname) }}" alt="{{ $news->title }}">
                    <p><a href="/tin-tuc-su-kien/{{ $news->slug }}">Xem</a></p>
                </div>
                <h5><a href="/tin-tuc-su-kien/{{ $news->slug }}" title="{{$news->title}}">{{ Str::words($news->title, 8) }}</a></h5>
            </li>
            @endforeach
        </ul>

    </section> <!-- / #ccr-world-news -->




    <section class="bottom-border"></section>

<!--    <section id="ccr-sports-gallery">
        <div class="ccr-gallery-ttile">
            <span></span> 
            <p>Tư vấn - Hỏi đáp</p>
        </div>  .ccr-gallery-ttile 

        <section class="featured-sports-news">
            <div class="featured-sports-newss-img"><img src="{{ asset('assets/img/sports-thumb-1.jpg') }}" alt="Thumb"></div>
            <div class="featured-sports-news-post">
                <h5>Featured Sports News Post Title</h5>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, quod, nostrum, corrupti, maxime quis doloribus debitis id consectetur laudantium iure aperiam soluta consequuntur modi accusamus molestias. Ab veniam atque eius...
                <div class="like-comment-readmore">
                    <i class="fa fa-thumbs-o-up"> 08</i>
                    <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                    <a class="read-more" href="chitiet.html">Chi tiết</a>
                </div>  /.like-comment-readmore 
            </div>
        </section>  /#featured-sports-news 

        <ul>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-2.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-3.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-4.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-5.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-6.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-7.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-8.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-9.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-10.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
            <li>

                <div class="ccr-thumbnail">
                    <img src="{{ asset('assets/img/sports-thumb-11.jpg') }}" alt="thumbnail-small-1.jpg">
                    <p><a href="chitiet.html">Chi tiết</a></p>
                </div>
                <h5><a href="chitiet.html">Lorem ipsum is simply dummy text...</a></h5>
            </li>
        </ul>					

    </section>  /#ccr-sports-gallery -->

    <section class="bottom-border"></section>








</section><!-- /.col-md-8 / #ccr-left-section -->
@stop