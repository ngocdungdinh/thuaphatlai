@extends('frontend/layouts/default')

{{-- Page title --}}

@section('title')

{{ $post->title }} ::

@parent

@stop


{{-- Update the Meta Title --}}

@section('meta_title')


@parent

@stop


{{-- Update the Meta Description --}}

@section('meta_description')


@parent

@stop


{{-- Update the Meta Keywords --}}

@section('meta_keywords')


@parent

@stop


{{-- Page content --}}

@section('content')

<section id="ccr-left-section" class="col-md-8">

    <div class="current-page">
        <a href="#"><i class="fa fa-home"></i> <i class="fa fa-angle-double-right"></i></a> <a href="/{{ $category->slug }}">{{ $category->name }} <i class="fa fa-angle-double-right"></i></a> {{ $post->title }}
    </div> <!-- / .current-page -->

    <article id="ccr-article">
        <h1><a href="#" >{{ $post->title }}</a></h1>

        <div class="article-like-comment-date">	
            Đăng bởi <a href="#author">Admin</a> lúc <time datetime="2014-02-17">2014-09-17</time> trong mục <a href="#category">Giới thiệu</a>

            <a class="like" href="#"><i class="fa fa-thumbs-o-up"></i> 08</a>
            <a class="comments" href="#"><i class="fa fa-comments-o"></i> 49</a>

        </div> <!-- /.article-like-comment-date -->

        <p>
            {{ $post->excerpt }}
        </p>
        
        {{ $post->content }}
        
        <div class="article-tags">
            Tag: <a href="#tag1">Giới thiệu</a>, <a href="#tag2">Thừa phát lại</a>, <a href="#tag3">Đông Dương</a>
        </div>

    </article> <!-- /#ccr-single-post -->


    <section id="ccr-article-related-post">
        <div class="ccr-gallery-ttile">
            <span class="bottom"></span>
            <p>Bài viết liên quan</p>
        </div> <!-- .ccr-gallery-ttile -->
        <ul>
            @foreach($category_posts as $cpost)
            <li>
                <div class="ccr-thumbnail">
                    <img src="{{ asset($cpost->mpath . '/170x100_crop/'. $cpost->mname) }}" alt="{{ $cpost->title }}">
                    <p><a href="#">Read More</a></p>
                </div>
                <h5><a href="/{{ $category->slug }}/{{ $cpost->slug }}">{{ $cpost->title }}</a></h5>
            </li>
            @endforeach
        </ul>

    </section> <!-- /#ccr-article-related-post -->

    <section class="bottom-border"></section> <!-- /#bottom-border -->

<!--    <section id="ccr-commnet">
        <div class="ccr-gallery-ttile">
            <span class="bottom"></span>
            <p>Bình luận</p>
        </div>  .ccr-gallery-ttile 

        <ol class="commentlist">
            <li  class="comment">
                <article>
                    <div class="comment-authore">
                        <img src="img/no-profile.jpg" alt="Avatar">
                        <a href="#">Lisa</a>
                    </div>
                    <div class="comment-content">
                        Lorem idivsum dolor sit amet, consectetur adipisicing elit. Sapiente, repellendus, omnis, ullam fugit repudiandae reiciendis velit ad consequuntur porro laudantium delectus nulla nemo assumenda sunt culpa voluptatum deleniti dolore fugiat.
                    </div>
                    <div class="reply"><a href="#">Trả lời</a></div>
                    <div class="comment-meta"> 08 February; 2014</div>
                </article>
                <ul class="children">
                    <li class="comment">
                        <article>
                            <div class="comment-authore">
                                <img src="img/no-profile.jpg" alt="Avatar">
                                <a href="#">Joly</a>
                            </div>
                            <div class="comment-content">
                                Lorem idivsum dolor sit amet, consectetur adipisicing elit. Sapiente, repellendus, omnis, ullam fugit repudiandae reiciendis velit ad consequuntur porro laudantium delectus nulla nemo assumenda sunt culpa voluptatum deleniti dolore fugiat.
                            </div>
                            <div class="reply"><a href="#">Trả lời</a></div>
                            <div class="comment-meta"> 08 February; 2014</div>
                        </article>

                    </li>  /.comment 
                </ul>  /.children 
            </li>  /.comment 
            <li  class="comment">
                <article>
                    <div class="comment-authore">
                        <img src="img/no-profile.jpg" alt="Avatar">
                        <a href="#">Hena</a>
                    </div>
                    <div class="comment-content">
                        Lorem idivsum dolor sit amet, consectetur adipisicing elit. Sapiente, repellendus, omnis, ullam fugit repudiandae reiciendis velit ad consequuntur porro laudantium delectus nulla nemo assumenda sunt culpa voluptatum deleniti dolore fugiat.
                    </div>
                    <div class="reply"><a href="#">Trả lời</a></div>
                    <div class="comment-meta"> 08 February; 2014</div>
                </article>
                <ul class="children">
                    <li class="comment">
                        <article>
                            <div class="comment-authore">
                                <img src="img/no-profile.jpg" alt="Avatar">
                                <a href="#">Joly</a>
                            </div>
                            <div class="comment-content">
                                Lorem idivsum dolor sit amet, consectetur adipisicing elit. Sapiente, repellendus, omnis, ullam fugit repudiandae reiciendis velit ad consequuntur porro laudantium delectus nulla nemo assumenda sunt culpa voluptatum deleniti dolore fugiat.
                            </div>
                            <div class="reply"><a href="#">Trả lời</a></div>
                            <div class="comment-meta"> 08 February; 2014</div>
                        </article>
                        <ul class="children">
                            <li class="comment">
                                <article>
                                    <div class="comment-authore">
                                        <img src="img/no-profile.jpg" alt="Avatar">
                                        <a href="#">Hena</a>
                                    </div>
                                    <div class="comment-content">
                                        Lorem idivsum dolor sit amet, consectetur adipisicing elit. Sapiente, repellendus, omnis, ullam fugit repudiandae reiciendis velit ad consequuntur porro laudantium delectus nulla nemo assumenda sunt culpa voluptatum deleniti dolore fugiat.
                                    </div>
                                    <div class="reply"><a href="#">Trả lời</a></div>
                                    <div class="comment-meta"> 08 February; 2014</div>
                                </article>

                            </li>  /.comment 
                        </ul>  /.children 

                    </li>  /.comment 
                </ul>  /.children 
            </li>  /.comment 
        </ol>  /.commentlist 



    </section>  /#ccr-commnet -->



    <section class="bottom-border"></section> <!-- /#bottom-border -->

    <section id="ccr-respond">
        <div class="ccr-gallery-ttile">
            <span class="bottom"></span>
            <p>Gửi bình luận</p>
        </div> <!-- .ccr-gallery-ttile -->
        <div id="respond">
            <form action="#" method="post" id="commentform">
                <input id="author" name="author" type="text" placeholder="Họ tên" value="" required>
                <input id="email" name="email" type="email" placeholder="Email" value="" required>
                <input id="url" name="url" type="url" placeholder="Website" value="">
                <textarea id="comment" name="comment" placeholder="Nội dung" rows="8" required></textarea>
                <input name="submit" type="submit" id="submit" value="Gửi">

            </form> <!-- /#commentform -->

        </div> <!-- /#respond -->

    </section> <!-- /#ccr-respond -->





</section><!-- /.col-md-8 / #ccr-left-section -->
@stop