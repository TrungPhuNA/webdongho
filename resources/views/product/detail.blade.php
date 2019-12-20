@extends('layouts.master')
@section('title_page',$productDetail->pro_name)
@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Sản phẩm</a></li>
                        <li><a href="#">{{ $cateProduct->c_name }}</a></li>
                        <li class="active">{{ $productDetail->pro_name }}</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 {{ count($images) ? 'col-md-push-2' : '' }}">
                    <div id="product-main-img">
                        @if ($images && count($images))
                            @foreach($images as $image)
                                <div class="product-preview">
                                    <img src="{{ pare_url_file($image->pi_slug) }}" alt="" style="height: 360px">
                                </div>
                            @endforeach
                        @else
                            <img src="{{ pare_url_file($productDetail->c_avatar) }}" alt="" class="img img-responsive" style="width: 100%;height: auto;max-height: 400px">
                        @endif
                    </div>
                </div>
                <!-- /Product main img -->
                <!-- Product thumb imgs -->
                @if ($images && count($images))
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        @foreach($images as $image)
                            <div class="product-preview">
                                <img src="{{ pare_url_file($image->pi_slug) }}" alt="" style="height: 120px">
                            </div>
                        @endforeach
                        {{----}}
                        {{--<div class="product-preview">--}}
                            {{--<img src="{{ asset('img/product01.png') }}" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="product-preview">--}}
                            {{--<img src="{{ asset('img/product03.png') }}" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="product-preview">--}}
                            {{--<img src="{{ asset('img/product06.png') }}" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="product-preview">--}}
                            {{--<img src="{{ asset('img/product08.png') }}" alt="">--}}
                        {{--</div>--}}
                    </div>
                </div>
                @endif
                <!-- /Product thumb imgs -->
                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $productDetail->pro_name }}</h2>
                        <div>
                            <h3 class="product-price">
                                @if ($productDetail->pro_sale)
                                    {{ number_format($productDetail->pro_price * (100 - $productDetail->pro_sale) / 100,0,',','.') }} VNĐ
                                    <del class="product-old-price">{{ number_format($productDetail->pro_price,0,',','.') }}</del> VNĐ</h4>
                                @else
                                    {{ number_format($productDetail->pro_price,0,',','.') }} VNĐ
                                @endif
                            </h3>
                            <span class="product-available">{{ $productDetail->supplier->s_name ?? "[N\A]" }}</span>
                        </div>
                        <p>{{ $productDetail->pro_description }}</p>
                        <div class="add-to-cart">
                            <form action="{{ route('add.shopping.cart', $productDetail->id) }}" method="GET">
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number">
                                        <input type="number" value="1" name="qty" min="1">
                                    </div>
                                </div>
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm giỏ hàng</button>
                            </form>
                        </div>

                        <ul class="product-links">
                            <li>Chia sẻ:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Product details -->
                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Mô tả sản phẩm</a></li>
                            {{--<li><a data-toggle="tab" href="#tab3">Đánh giá sản phẩm</a></li>--}}
                        </ul>
                        <!-- /product tab nav -->
                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $productDetail->pro_content !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    <!-- Section -->
    @if (isset($productSuggest))
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Sản phẩm liên quan</h3>
                    </div>
                </div>
                @foreach($productSuggest as $product)
                <!-- product -->
                    <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                            <img src="{{ pare_url_file($product->pro_avatar) }}" alt="{{ $product->pro_name }}" style="width: 263px;height: 263px">
                            <div class="product-label">
                                @if ($product->pro_sale)
                                    <span class="sale">-{{ $product->pro_sale }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name" style="height: 30px;max-height: 30px">
                                <a href="{{ route('get.detail.product',[$product->pro_slug, $product->id]) }}">{{ $product->pro_name }}</a>
                            </h3>
                            <h4 class="product-price">
                                @if ($product->pro_sale)
                                    {{ number_format($product->pro_price * (100 - $product->pro_sale) / 100,0,',','.') }} VNĐ
                                    <del class="product-old-price">{{ number_format($product->pro_price,0,',','.') }}</del> VNĐ
                                @else
                                {{ number_format($product->pro_price,0,',','.') }} VNĐ
                                @endif
                            </h4>
                            <div class="product-btns">
                                <a class="add-to-wishlist" href="{{ route('user.favorite.add', $product->id) }}">
                                    <i class="fa fa-heart-o"></i><span class="tooltipp"> Yêu thích</span>
                                </a>
                                <a href="{{ route('add.shopping.cart', $product->id) }}" title="Thêm giỏ hàng" class="add-to-compare"><i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /product -->
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    @endif
    <!-- /Section -->
@stop
