@extends('layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-inner">
                        <ul>
                            <li class="home">
                                <a href="">Home</a>
                                <span><i class="fa fa-angle-right"></i></span>
                            </li>
                            <li class="home">
                                <a href="">Bài viết</a>
                                <span><i class="fa fa-angle-right"></i></span>
                            </li>
                            <li class="category3"><span>CÁCH CHÈN THÊM NHẠC VÀO POWERPOINT</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-contact-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="article_content">
                        <h1>CÁCH CHÈN THÊM NHẠC VÀO POWERPOINT</h1>
                        <p>Bạn muốn làm cho PowerPoint của mình thêm phần sinh động hơn cuốn hút hơn? Bạn có thể tham khảo cách chèn nhạc vào cho PowerPoint</p>
                        <div>
                            
                        </div>
                    </div>
                    @include('components.article')
                </div>
                <div class="col-sm-4">
                    RIGHT
                </div>
            </div>
        </div>
    </div>
@stop