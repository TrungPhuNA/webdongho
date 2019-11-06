@if ($categoryChildren && $categoryChildren->count())
<div class="aside">
    <h3 class="aside-title">Danh mục liên quan</h3>
    <div class="checkbox-filter">
        @foreach($categoryChildren as $cate)
            <div class="input-checkbox">
                <a href="{{ route('get.list.product', [$cate->c_slug, $cate->id]) }}" class="js-reload">
                    <input type="checkbox" id="category-{{ $cate->id }}">
                    <label for="category-{{ $cate->id }}">
                        <span></span>{{ $cate->c_name }}<small></small>
                    </label>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- aside Widget -->
@if ($suppliers && $suppliers->count())
<div class="aside">
    <h3 class="aside-title">Nhà cung cấp</h3>
    <div class="checkbox-filter">
        @foreach($suppliers as $supplier)
            <div class="input-checkbox">
                <a href="{{ request()->fullUrlWithQuery(['s' => $supplier->id]) }}" class="js-reload">
                    <input type="checkbox" id="brand-{{ $supplier->id }}">
                    <label for="brand-{{ $supplier->id }}">
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