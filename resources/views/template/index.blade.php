@extends('template.layout')
@section('slide')
    <section class="slide_home" style="margin-bottom: 20px;">
        <style>
            .mySlides {display:none;}
        </style>
        <div class="w3-content w3-display-container tp_container" style="">
            <img class="mySlides" src="https://image.yes24.vn/Upload/ImageMain/Master/Main_A1_20190403_ta1.jpg" style="width:100%">
            <img class="mySlides" src="https://image.yes24.vn/Upload/ImageMain/Master/Main_A3_HOT_20190411_ta.jpg" style="width:100%">
            <img class="mySlides" src="https://image.yes24.vn/Upload/ImageMain/Master/Main_A5_HOT_20190408_ta.jpg" style="width:100%">
            <img class="mySlides" src="https://image.yes24.vn/Upload/ImageMain/Master/Main_A6_HOT_20190410_ta.jpg" style="width:100%">

            <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
        </div>
    </section>
@stop
@section('content')
    <section>
        <div class="tp_container">
            <div class="product_list">
                <div class="title_heading">
                    <h2><img src="{{ asset('images/new.png') }}" style="width: 40px;height: 40px" alt="">Sản phẩm mới</h2>
                </div>
                <div class="width-100 flex" style="flex-wrap: wrap;">
                    @for($i = 1; $i <= 10 ; $i ++)
                        <div class="product_item">
                            <a href="{{ route('demo.detail') }}" class="product_item_img">
                                <img src="{{ asset('images/giay_demo.png') }}" alt="">
                            </a>
                            <h3 class="product_item_name"><a href="">Giày thể thao </a></h3>
                            <p class="product_item_description">Nồi thủy tinh Luminarc Amberline Trianon Eclipse 1.5L C2321 Nồi thủy tinh Luminarc Amberline Trianon Eclipse 1.5L C2321</p>
                            <div class="product_price">
                                <span class="product_price-new">210.000đ</span>
                                <span class="product_price-old">290.000đ</span>
                                <span class="product_price-sale">(4%)</span>
                            </div>
                        </div>
                    @endfor
                    <div class="clearfloat"></div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="tp_container">
            <div class="product_list">
                <div class="title_heading">
                    <h2><img src="{{ asset('images/new.png') }}" style="width: 40px;height: 40px" alt="">Gợi ý cho bạn</h2>
                </div>
                <div class="width-100 flex" style="flex-wrap: wrap;">
                    @for($i = 1; $i <= 10 ; $i ++)
                        <div class="product_item">
                            <a href="{{ route('demo.detail') }}" class="product_item_img">
                                <img src="{{ asset('images/giay_demo.png') }}" alt="">
                            </a>
                            <h3 class="product_item_name"><a href="">Giày thể thao </a></h3>
                            <p class="product_item_description">Nồi thủy tinh Luminarc Amberline Trianon Eclipse 1.5L C2321 Nồi thủy tinh Luminarc Amberline Trianon Eclipse 1.5L C2321</p>
                            <div class="product_price">
                                <span class="product_price-new">210.000đ</span>
                                <span class="product_price-old">290.000đ</span>
                                <span class="product_price-sale">(4%)</span>
                            </div>
                        </div>
                    @endfor
                    <div class="clearfloat"></div>
                </div>
            </div>
        </div>
    </section>
@stop