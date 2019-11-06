@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <h1 style="margin-top: 15px;font-size: 20px">Danh sách bài viết</h1>
                @include('components.article')
            </div>
            <div class="col-sm-3">
                <h4 style="margin-top: 15px">Bài viết nổi bật</h4>
                <div class="list_article_hot">
                    @include('components.article_hot')
                </div>
            </div>
        </div>
    </div>
@stop