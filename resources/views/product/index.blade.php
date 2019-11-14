@extends('layouts.master')
@section('title_page',$cateProduct->c_name ?? "Tìm Kiếm")
@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    @include('components.sidebar')
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">

                    <!-- store products -->
                    <div class="row">
                        @if (isset($cateProduct))
                            <h1 style="font-size: 20px;margin-top: 10px">{{ $cateProduct->c_name }}</h1>
                        @endif
                        @foreach($products as $product)
                            <div class="col-md-4 col-xs-6">
                                @include('components.product_item_v1',['product' => $product])
                            </div>
                        @endforeach
                    </div>
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        {!! $products->appends($query)->links() !!}
                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@stop
