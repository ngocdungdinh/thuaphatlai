@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
{{ isset($category->name) ? $category->name : 'Trang Chủ' }} ::
@parent
@stop

{{-- Page content --}}
@section('content')
<section id="ccr-left-section" class="col-md-8">

    <div class="current-page">
        <a href="/"><i class="fa fa-home"></i> <i class="fa fa-angle-double-right"></i></a> {{ $category->name }}
    </div> <!-- / .current-page -->

    <section id="ccr-blog">

        @foreach ($posts as $key => $post)
        <article>
            @if ($post->media_id)
            <figure class="blog-thumbnails">
                <img src="{{ asset($post->mpath . '/270x190_crop/'. $post->mname) }}" alt="{{ $post->title }}">
            </figure> <!-- /.blog-thumbnails -->
            @endif
            <div class="blog-text" {{{ ($post->media_id) ? '' : 'style=width:100%' }}}>
                <h1><a href="{{ $post->url() }}">{{ $post->title }}</a></h1>
                <p>
                    {{ $post->excerpt }} 
                </p>

                <div class="meta-data">			
                    <a href="#" class="like"><i class="fa fa-thumbs-o-up"></i> 08</a>
                    <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>			
                    <span class="read-more"><a href="{{ $post->url() }}">Xem..</a></span>
                </div>
            </div> <!-- /.blog-text -->
        </article>
        @endforeach

        <div class="clearfix"></div>
        {{ $posts->links() }}
<!--        <nav class="nav-paging">
            
            <ul>
                
                <li><a href="#pre"><i class="fa fa-chevron-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><span class="current">3</span></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#next"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
        </nav>-->

    </section> <!-- /#ccr-blog -->

</section><!-- /.col-md-8 / #ccr-left-section -->
@stop