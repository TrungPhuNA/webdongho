@if ($categoryChildren && $categoryChildren->count())
<div class="aside">
    <h3 class="aside-title">Danh mục liên quan</h3>
    <div class="checkbox-filter">
        @foreach($categoryChildren as $cate)
            <div class="input-checkbox">
                <input type="checkbox" id="category-1">
                <label for="category-1">
                    <span></span>{{ $cate->c_name }}<small></small>
                </label>
            </div>
        @endforeach
    </div>
</div>
@endif
<!-- aside Widget -->
<div class="aside">
    <h3 class="aside-title">Price</h3>
    <div class="price-filter">
        <div id="price-slider"></div>
        <div class="input-number price-min">
            <input id="price-min" type="number">
            <span class="qty-up">+</span>
            <span class="qty-down">-</span>
        </div>
        <span>-</span>
        <div class="input-number price-max">
            <input id="price-max" type="number">
            <span class="qty-up">+</span>
            <span class="qty-down">-</span>
        </div>
    </div>
</div>
<!-- /aside Widget -->

<!-- aside Widget -->
@if ($suppliers && $suppliers->count())
<div class="aside">
    <h3 class="aside-title">Nhà cung cấp</h3>
    <div class="checkbox-filter">
        @foreach($suppliers as $supplier)
            <div class="input-checkbox">
                <a href="/">
                    <input type="checkbox" id="brand-1">
                    <label for="brand-1">
                        <span></span>
                        {{ $supplier->s_name }}
                        {{--<small>(578)</small>--}}
                    </label>
                </a>
            </div>
        @endforeach
    </div>
</div>
<!-- /aside Widget -->
@endif

@if ($productHot && $productHot->count())
<!-- aside Widget -->
<div class="aside">
    <h3 class="aside-title">Sản phẩm nổi bật</h3>
    @foreach($productHot as $product)
    <div class="product-widget">
        <div class="product-img">
            <img src="{{ pare_url_file($product->pro_avatar) }}" alt="" style="height: 67px">
        </div>
        <div class="product-body">
            <p class="product-category">{{ $product->category->c_name }}</p>
            <h3 class="product-name"><a href="#">{{ $product->pro_name }}</a></h3>
            <h4 class="product-price">
                @if ($product->pro_sale)
                    {{ number_format($product->pro_price * (100 - $product->pro_sale) * 100,0,',','.') }} VNĐ
                    <del class="product-old-price">{{ number_format($product->pro_price,0,',','.') }}</del> VNĐ
                @else
                {{ number_format($product->pro_price,0,',','.') }} VNĐ
                @endif
            </h4>
        </div>
    </div>
    @endforeach
</div>
@endif
<!-- /aside Widget -->