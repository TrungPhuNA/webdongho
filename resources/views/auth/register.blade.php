@extends('layouts.master')
@section('title_page','Đăng nhập')
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Đăng ký</a></li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <div class="row">
        <div class="col-sm-12" >
            <div style="max-width: 500px;margin: 0 auto;padding-bottom: 100px">
                <form method="post" class="login" action="">
                    @csrf
                    <div class="form-fields">
                        <h2>Đăng ký</h2>
                        <div class="form-group">
                            <label for="username">Họ tên <span class="required">*</span></label>
                            <input type="text" required class="input-text form-control" name="name" id="username" value="">
                        </div>
                        <div class="form-group">
                            <label for="username">Email <span class="required">*</span></label>
                            <input type="text" required class="input-text form-control" name="email" id="username" value="">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="required">*</span></label>
                            <input class="input-text form-control" required type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="username">Số điện thoại <span class="required">*</span></label>
                            <input type="text" required class="input-text form-control" name="phone" id="username" value="">
                        </div>
                    </div>
                    <div class="form-action">
                        <div class="actions-log">
                            <input type="submit" class="btn btn-success" name="login" value="Đăng ký">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop