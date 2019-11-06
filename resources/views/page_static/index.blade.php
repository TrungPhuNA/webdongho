@extends('layouts.master')
@section('content')
    <div class="breadcrumbs" style="padding: 10px 0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-inner">
                        <ul>
                            <li class="home">
                                <a href="/">Home</a>
                                <span><i class="fa fa-angle-right"></i></span>
                            </li>
                            <li class="category3"><span>{{ isset($page->ps_name) ? $page->ps_name : '' }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-contact-area">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="contact-us-area" style="padding: 10px 0">
                        <h2 style="margin-top: 15px">{{ isset($page) ? $page->ps_name : 'Đang cập nhật' }}</h2>
                        <div style="margin-bottom: 15px">{!! isset($page) ? $page->ps_content : 'Đang cập nhật' !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop