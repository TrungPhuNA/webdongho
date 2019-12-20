<div class="product">
    <div class="product-img">
        <img src="{{ pare_url_file($product->pro_avatar) }}" alt="" style="width: 263px;height: 263px">
        <div class="product-label">
            @if ($product->pro_sale)
                <span class="sale">-{{ $product->pro_sale }}%</span>
            @endif
            <span class="new">Hot</span>
        </div>
    </div>
    <div class="product-body">
        <p class="product-category">{{ $product->category->c_name ?? "[N\A]" }}</p>
        <h3 class="product-name" style="min-height: 40px">
            <a href="{{ route('get.detail.product',[$product->pro_slug, $product->id]) }}">{{ $product->pro_name }}</a>
        </h3>
        <h4 class="product-price" style="font-size: 14px;">
            @if ($product->pro_sale)
                {{ number_format($product->pro_price * (100 - $product->pro_sale) / 100,0,',','.') }} VNĐ
                <del class="product-old-price">{{ number_format($product->pro_price,0,',','.') }}</del> VNĐ</h4>
            @else
                {{ number_format($product->pro_price,0,',','.') }} VNĐ
            @endif
            <div class="product-btns">
                <a class="add-to-wishlist" href="{{ route('user.favorite.add', $product->id) }}">
                    <i class="fa fa-heart-o"></i><span class="tooltipp"> Yêu thích</span>
                </a>
                <a href="{{ route('add.shopping.cart', $product->id) }}" title="Thêm giỏ hàng" class="add-to-compare"><i class="fa fa-shopping-cart"></i>
                </a>
            </div>
    </div>
</div>
