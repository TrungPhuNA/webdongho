@extends('layouts.master')
@section('content')

{{--    @include('home.components.campaign')--}}
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Sản phẩm nổi bật</h3>
                    </div>
                </div>
                <!-- /section title -->
                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @if (isset($productHot))
                                    <!-- product -->
                                        @foreach($productHot as $product)
                                             @include('components.product_item_v1',['product' => $product])
                                        @endforeach
                                    @endif
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    {{--@include('home.components.deal')--}}
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Sản phẩm mới</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab2">Xem thêm</a></li>
                                {{--<li><a data-toggle="tab" href="#tab2">Smartphones</a></li>--}}
                                {{--<li><a data-toggle="tab" href="#tab2">Cameras</a></li>--}}
                                {{--<li><a data-toggle="tab" href="#tab2">Accessories</a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->
                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach($productNews as $product)
                                    <!-- product -->
                                        @include('components.product_item_v1',['product' => $product])
                                    <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION Danh mục nổi bật -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                @foreach($categoriesHome as $category)
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">{{ $category->c_name }}</h4>
                        {{--<div class="section-nav">--}}
                            {{--<div id="slick-nav-3" class="products-slick-nav"></div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        @if ($category->products)
                            @php
                                $products = $category->products()->limit(6)->orderByDesc('id')->get();
                            @endphp
                            @foreach($products->chunk(3) as $product)
                                <div>
                                    @foreach($product as $item)
                                    <!-- product widget -->
                                        <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->pro_name }}"
                                                 style="width: 60px;height: 60px">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $category->c_name }}</p>
                                            <h3 class="product-name">
                                                <a href="{{ route('get.detail.product',[$item->pro_slug, $item->id]) }}">
                                                    {{ $item->pro_name }}
                                                </a>
                                            </h3>
                                            <h4 class="product-price">
                                                @if ($item->pro_sale)
                                                    {{ number_format($item->pro_price * (100 - $item->pro_sale) / 100,0,',','.') }} VNĐ
                                                    <del class="product-old-price">{{ number_format($item->pro_price,0,',','.') }}</del> VNĐ
                                                @else
                                                {{ number_format($item->pro_price,0,',','.') }} VNĐ
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                    @endforeach
                                </div>
                            @endforeach

                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->
@stop