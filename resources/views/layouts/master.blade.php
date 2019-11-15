<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title_page','Trang chủ')</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>
</head>
<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> 0986.420.994</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> phupt.humg.94@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Nghệ An</a></li>
                @if (get_data_user('web'))
                <li><a href="#"><i class="fa fa-user"></i> Xin Chào {{ get_data_user('web','name') }}</a></li>
                <li><a href="{{ route('user.update.info') }}"><i class="fa fa-user"></i> Thông tin tài khoản </a></li>
                <li><a href="{{ route('get.logout.user') }}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                @else
                    <li><a href="{{ route('get.register') }}"><i class="fa fa-registered"></i> Đăng ký</a></li>
                    <li><a href="{{ route('get.login') }}"><i class="fa fa-user-circle"></i> Đăng nhập</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->
    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="/" class="logo">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->
                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form action="{{ route('get.search') }}" method="GET" style="display: flex">
                            <select class="input-select" name="c">
                                <option value="0">All Categories</option>
                                @foreach($categoriesAll as $cate)
                                    <option value="{{ $cate->id }}" {{ Request::get('cate') == $cate->id ? "selected='selected'" : "" }}>{{ $cate->c_name }}</option>
                                @endforeach
                            </select>
                            <input class="input" placeholder="Nhập từ khoá tìm kiếm" name="k" value="{{ Request::get('k') }}">
                            <button class="search-btn">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->
                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        {{--<div>--}}
                            {{--<a href="#">--}}
                                {{--<i class="fa fa-heart-o"></i>--}}
                                {{--<div class="qty">2</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        <!-- /Wishlist -->
                        <!-- Cart -->
                        <div class="dropdown">
                            <a  href="{{ route('get.list.shopping.cart') }}"  title="Giỏ hàng của bạn">
                                <i class="fa fa-shopping-cart"></i>
                                <div class="qty">{{ \Cart::instance('cart')->count() }}</div>
                            </a>
                        </div>
                        <!-- /Cart -->
                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}"><a href="/">Trang chủ</a></li>
                <li>
                    <a href="#">Sản phẩm</a>
                    <ul>
                        @if (isset($categories))
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('get.list.product', [$category->c_slug, $category->id]) }}"
                                       title="{{ $category->c_name }}">
                                        {{ $category->c_name }}
                                    </a>
                                    @if ($submenus = $category->children)
                                        <ul>
                                            @foreach($submenus as $sub)
                                                <li>
                                                    <a href="{{ route('get.list.product', [$sub->c_slug, $sub->id]) }}"
                                                       title="{{ $sub->c_name }}">
                                                        {{ $sub->c_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{ route('get.list.article') }}">Bài viết</a>
                    <ul>
                        @foreach($menus as $menu)
                        <li><a href="{{ route('get.list.article.menu',$menu->m_slug) }}">{{ $menu->m_name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="{{ Route::currentRouteName() == 'get.about_us' ? 'active' : '' }}"><a href="{{ route('get.about_us') }}" title="Về chúng tôi">Giới thiệu</a></li>
                <li class="{{ Route::currentRouteName() == 'get.contact' ? 'active' : '' }}"><a href="{{ route('get.contact') }}" title="Liên hệ">Liên hệ</a></li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
@yield('content')

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Giới thiệu</h3>
                        <p>Đây là đồ án tốt nghiệp. Là thành quả của quá trình nghiên cứu của tôi trong suốt thời gian qua. Và đồng thời
                            được sự hướng dẫn tận tình của giáo viên hướng dẫn.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>Hà Nội</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>0988111222</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>supportwatch@email.com</a></li>
                        </ul>
                    </div>
                </div>
                @if (isset($categoriesHot))
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Danh mục nổi bật</h3>
                        <ul class="footer-links">
                            @foreach($categoriesHot as $cateHot)
                            <li>
                                <a href="{{ route('get.list.product', [$cateHot->c_slug, $cateHot->id]) }}">{{ $cateHot->c_name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <div class="clearfix visible-xs"></div>
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Về chúng tôi</h3>
                        <ul class="footer-links">
                            <li><a href="{{ route('get.giaohang') }}">Thông tin giao hàng</a></li>
                            <li><a href="{{ route('get.baomat') }}">Bảo mật</a></li>
                            <li><a href="{{ route('get.dieukhoansudung') }}">Điều khoản sử dụng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Tài khoản của bạn</h3>
                        <ul class="footer-links">
                            <li><a href="{{ route('user.update.info') }}">Thông tin tài khoản</a></li>
                            <li><a href="{{ route('get.transaction.history') }}">Lịch sử giao dịch</a></li>
                            <li><a href="{{ route('user.list.product_wishlist') }}">Sản phẩm yêu thích</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->
    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                    </ul>
                    <span class="copyright">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                    target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->
<!-- jQuery Plugins -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/nouislider.min.js') }}"></script>
<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
