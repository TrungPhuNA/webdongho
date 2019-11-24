@if ($orders)
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th style="width: 30%">Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Trạn Thái</th>
            <th>Thành tiền</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
		<?php $i = 1 ?>
        @foreach($orders as  $key => $order)
            <tr>
                <td>#{{ $i }}</td>
                <td><a href="{{ route('get.detail.product',[str_slug($order->product->pro_name),$order->or_product_id]) }}" target="_blank">{{ isset($order->product->pro_name) ? $order->product->pro_name : '' }}</a></td>
                <td>
                    <img style="width: 80px;height: 60px" src="{{ isset($order->product->pro_avatar) ? pare_url_file($order->product->pro_avatar) : ''}}" alt="">
                </td>
                <td>{{ number_format($order->or_price,0,',','.') }}đ x {{ $order->or_qty }}</td>
                <td>
                    @php
                        $date = date_create($order->product->pro_warranty);
                        $day_1 = date_format($date, 'Y-m-d');
                        $day_2 = date('Y-m-d') ; //current date
                        $days = (strtotime($day_1) - strtotime($day_2)) / (60 * 60 * 24);
                    @endphp
                    @if ($days <= 0 )
                        <span class="label-danger label">Hết bảo hành</span>
                    @else
                        <span class="label-info label">{{ $order->product->pro_warranty }}</span>
                    @endif
                </td>
                <td>{{ number_format($order->or_price * $order->or_qty,0,',','.') }} đ</td>
                <td>
                    <a href=""><i class="fa fa-trash-o"></i> Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
