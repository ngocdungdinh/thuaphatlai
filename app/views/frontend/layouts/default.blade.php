<!doctype html>
<html lang="en">
    <head>
        <meta name="google-site-verification" content="azXHCS1hkCVModVZZStyPKQ-zT72BvmKIO97DJutgRc" />
        <meta charset="UTF-8">
        <meta name="keywords" content="Thua phat lai, Thua phat lai ha noi, Thua phat lại Dong Duong, các văn phòng thừa phát lại, Van phong thua phat lai tai Ha Noi, thua phat lai, văn phòng thừa phát lại tại hà nội, Chức năng thừa phát lại, quyền hạn thừa phát lại, thành lập thừa phát lại tại Hà Nội, thừa phát lại đông dương" />
        <meta name="description" content="Thua phat lai, Thua phat lai ha noi, Thua phat lại Dong Duong, thừa phát lại đông dương, các văn phòng thừa phát lại, Van phong thua phat lai tai Ha Noi, thua phat lai, văn phòng thừa phát lại tại hà nội, Chức năng thừa phát lại, quyền hạn thừa phát lại, thành lập thừa phát lại tại Hà Nội" >
        <meta name="author" content="dungdn" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @section('title')
            Thừa phát lại Đông Dương
            @show
        </title>
        <?php $canonical = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
        <link rel="canonical" href="{{ $canonical }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-green.css') }}">
        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>




        <header id="ccr-header">
        <!--	<section id="ccr-nav-top" class="fullwidth">
                <div class="">
                    <div class="container">
                        <nav class="top-menu">
                            
        
                            
                        </nav>  /.top-menu 
                    </div>
                </div>	
            </section>   /#ccr-nav-top  -->



            <section id="ccr-site-title">
                <div class="container">
                    <div class="site-logo">
                        <a href="./" class="navbar-brand">
                            <img src="{{ asset('assets/img/logo_final.png') }}" alt="Side Logo" />
                        </a>
                    </div> <!-- / .navbar-header -->

                    <div class="add-space">
                        728 x 90 px Banner
                    </div> <!-- / .adspace -->

                </div>	<!-- /.container -->
            </section> <!-- / #ccr-site-title -->



            <section id="ccr-nav-main">
                <nav class="main-menu">
                    <div class="container">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".ccr-nav-main">
                                <i class="fa fa-bars"></i>
                            </button> <!-- /.navbar-toggle -->
                        </div> <!-- / .navbar-header -->

                        <div class="collapse navbar-collapse ccr-nav-main">
                            <ul class="nav navbar-nav">
                                <li><a class="active" href="/">Trang chủ</a></li>
                                @foreach($categories as $menu)
                                    @if($menu->parent_id == 0)
                                    <li class="dropdown">
                                        <a href="{{ route('view-category', $menu->slug) }}">{{ $menu->name }} <!--<i class="fa fa-caret-down"></i>--></a>
                                        <ul class="sub-menu">
                                            @foreach($categories as $submenu)
                                                @if($submenu->parent_id == $menu->id)
                                                    <li><a href="{{ route('view-category', $submenu->slug) }}">{{ $submenu->name }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                @endforeach
                                <li><a href="#">Liên hệ</a></li>
                            </ul> <!-- /  .nav -->
                        </div><!-- /  .collapse .navbar-collapse  -->

                        <div id="currentTime" class="pull-right current-time">
                            <i class="fa fa-clock-o"></i> 
                            <?php
                            $dt = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                            echo $dt->format('h:i A');
                            ?>


                        </div><!-- / #currentTime -->

                    </div>	<!-- /.container -->
                </nav> <!-- /.main-menu -->
            </section> <!-- / #ccr-nav-main -->



            <section id="ccr-nav-below-main">
                <nav class="second-menu">
                    <div class="container">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".ccr-nav-below-main">
                                <i class="fa fa-bars"></i>
                            </button> <!-- /.navbar-toggle -->
                        </div> <!-- / .navbar-header -->
                    </div><!-- /.container -->
                </nav><!-- /.second-menu -->
            </section><!-- / #ccr-nav-below-main -->

        </header> <!-- /#ccr-header -->

        <section id="ccr-main-section">
    <div class="container">

        @yield('content')

        <aside id="ccr-right-section" class="col-md-4 ccr-home">

            <section id="sidebar-popular-post">
                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><strong>Bài viết nổi bật</strong></p>
                </div> <!-- .ccr-gallery-ttile -->
                <ul>
                    @foreach ($featured_posts as $featured)
                    <li>
                        <img src="{{ asset($featured->mpath . '/170x100_crop/'. $featured->mname) }}" alt="{{ $featured->title }}">
                        <a href="{{ $featured->url() }}">{{ $featured->title }}</a>
                        <div class="date-like-comment">
                            <span class="date"><time datetime="{{ date("H:i - d/m/Y",strtotime($featured->created_at)) }}">{{ date("H:i - d/m/Y",strtotime($featured->created_at)) }}</time></span>
                            <a class="like" href="#"><i class="fa fa-thumbs-o-up"></i> 08</a>
                            <a class="comments" href="#"><i class="fa fa-comments-o"></i> 49</a>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </section> <!-- /#sidebar-popular-post -->

            <section id="sidebar-video-post">
                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><strong>Video Sự kiện</strong></p>
                </div> <!-- .ccr-gallery-ttile -->

                <div class="sidebar-video">
                    <iframe width="340" height="195" src="https://www.youtube.com/embed/j8lM8IfOnIw" frameborder="0" allowfullscreen></iframe>
                    Chương trình Kinh doanh & Pháp luật phát sóng định kỳ vào 17h30' Thứ bảy, phát lại vào 09h00' Chủ nhật trên Kênh VTV2 - Đài Truyền hình Việt Nam.
                </div>
                <div class="date-like-comment">
                    <a href="#" class="like"><i class="fa fa-thumbs-o-up"></i> 08</a>
                    <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                </div>
            </section>  <!-- /#sidebar-video-post -->

<!--			<section id="ccr-calender">

                <table id="calendar">
                <caption >February 2014</caption>
                <thead data-iceapc="1">
                <tr>
                    <th scope="col" title="Monday">M</th>
                    <th scope="col" title="Tuesday">T</th>
                    <th scope="col" title="Wednesday">W</th>
                    <th scope="col" title="Thursday">T</th>
                    <th scope="col" title="Friday">F</th>
                    <th scope="col" title="Saturday">S</th>
                    <th scope="col" title="Sunday">S</th>
                </tr>
                </thead>

                <tfoot data-iceapc="4">
                <tr data-iceapc="3">
                    <td colspan="3" id="prev"><a href="#" title="Previous">&laquo; Jan</a></td>
                    <td class="pad">&nbsp;</td>
                    <td colspan="3" id="next" class="pad"><a href="#" title="Next">Mar &raquo;</a></td>
                </tr>
                </tfoot>

                <tbody>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td>1</td><td >2</td>
                </tr>
                <tr>
                    <td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td>
                </tr>
                <tr>
                    <td>10</td><td>11</td><td>12</td><td>13</td><td><a href="#" title="Post">14</a></td><td>15</td><td>16</td>
                </tr>
                <tr>
                    <td>17</td><td id="today">18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td>
                </tr>
                <tr>
                    <td>24</td><td>25</td><td>26</td><td>27</td><td>28</td>
                    <td></td><td></td>
                </tr>
                </tbody>
                </table>

            </section>-->


            <section id="sidebar-older-post">
                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><strong>Bài xem nhiều</strong></p>
                </div> <!-- .ccr-gallery-ttile -->
                <ul>
                    @foreach ($hot_posts as $hot)
                    <li>
                        <img src="{{ asset($hot->mpath . '/170x100_crop/'. $hot->mname) }}" alt="{{ $hot->title }}">
                        <a href="{{ $hot->url() }}">{{ $hot->title }}</a>
                        <div class="date-like-comment">
                            <span class="date"><time datetime="{{ date("H:i - d/m/Y",strtotime($hot->created_at)) }}">{{ date("H:i - d/m/Y",strtotime($hot->created_at)) }}</time></span>
                            <a class="like" href="#"><i class="fa fa-thumbs-o-up"></i> 08</a>
                            <a class="comments" href="#"><i class="fa fa-comments-o"></i> 49</a>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </section> <!-- /#sidebar-older-post -->

            <section id="sidebar-entertainment-post">
                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><strong>Sự kiện - Hoạt động</strong></p>
                </div> <!-- .ccr-gallery-ttile -->

                <div class="sidebar-entertainment">
                    <img src="{{ asset('assets/img/entertainment.jpg') }}" alt="entertainment">
                    <a href="chitiet.html">Miss Joly loves you to share her tell. Are you ready?</a>
                </div>
                <div class="date-like-comment">
                    <a href="#" class="like"><i class="fa fa-thumbs-o-up"></i> 08</a>
                    <a href="#" class="comments"><i class="fa fa-comments-o"></i> 49</a>
                </div>
            </section>  <!-- /#sidebar-entertainment-post -->


            <section id="ccr-sidebar-add-place">
                <div class="sidebar-add-place">
                    370x250 px
                </div> 
            </section> <!-- /#ccr-sidebar-add-place -->


            <section id="ccr-sidebar-newslater">

                <div class="ccr-gallery-ttile">
                    <span></span> 
                    <p><label for="sb-newslater"><strong>Đăng ký nhận tin</strong></label></p>
                </div> <!-- .ccr-gallery-ttile -->

                <div class="sidebar-newslater-form">
                    <form class="ccr-gallery-ttile" action="#">
                        <input type="email" id="sb-newslater" name="sb-newslater" placeholder="Enter your email address" required>
                        <button type="submit">Đăng ký</button>

                    </form>
                </div> <!-- /.sidebar-newslater-form -->

            </section> <!-- /#ccr-sidebar-newslater -->

            <section id="social-buttons">
                <ul>
                    <li>
                        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>

                        <p><span class="bubble"></span><span class="count">202</span> Like</p>
                    </li>
                    <li>
                        <a href="#"  class="linkedin"><i class="fa fa-linkedin"></i></a>
                        <p><span class="bubble"></span><span class="count">202</span> Like</p>
                    </li>
                    <li>
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <p><span class="bubble"></span><span class="count">202</span> Follow</p>
                    </li>
                    <li>
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <p><span class="bubble"></span><span class="count">202</span> Like</p>
                    </li>
                </ul>

            </section>  <!-- /#social-buttons -->

        </aside><!-- / .col-md-4  / #ccr-right-section -->


    </div><!-- /.container -->
</section><!-- / #ccr-main-section -->

<aside id="ccr-footer-sidebar" style="height: 50px; min-height: 50px;">

</aside> <!-- /#ccr-footer-sidebar -->

        <footer id="ccr-footer">
            <div class="container">
                <div class="copyright">
                    &copy; 2014, Copyrights <a href="http://thuaphatlaidongduong.vn">Thừa phát lại Đông Dương</a>. All Rights Reserved
                </div> <!-- /.copyright -->

                <div class="footer-social-icons">
                    <ul>
                        <li>
                            <a href="#"  class="google-plus"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <li >
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li >
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li >
                            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>

                </div><!--  /.cocial-icons -->

            </div> <!-- /.container -->
        </footer>  <!-- /#ccr-footer -->


        <script src="{{ asset('assets/js/jquery-1.9.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-56982431-2', 'auto');
          ga('send', 'pageview');

        </script>
    </body>
</html>