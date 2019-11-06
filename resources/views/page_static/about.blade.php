@extends('layouts.master')
@section('content')
    <div class="main-contact-area">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="contact-us-area">
                          <h2 style="margin-top: 15px">{{ isset($page) ? $page->ps_name : 'Đang cập nhật' }}</h2>
                        <div style="margin-bottom: 15px">{!! isset($page) ? $page->ps_content : 'Đang cập nhật' !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop