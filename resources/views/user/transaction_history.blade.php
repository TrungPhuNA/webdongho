@extends('layouts.master')
@section('content')
    <div class="our-product-area new-product">
        <div class="container">
            <div class="area-title">
                <h2 style="margin-top: 20px">Lịch sử giao dịch</h2>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Thông tin khách hàng</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng thái</th>
                    <th style="width: 15%">PT Thanh toán</th>
{{--                    <th>Thao tác</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>#{{ $transaction->id }}</td>
                        <td>
                            <p><b style="display: inline-block;width: 70px">Name </b>{{ isset($transaction->user->name) ? $transaction->user->name : '[N\A]' }}</p>
                            <p><b style="display: inline-block;width: 70px">Address </b>{{ $transaction->tr_address }}</p>
                            <p><b style="display: inline-block;width: 70px">Phone </b>{{ isset($transaction->user->phone) ? $transaction->user->phone : "[N\A]" }}</p>
                            <p><b style="display: inline-block;width: 70px">Time </b>{{ $transaction->created_at->format('d-m-Y') }}</p>
                        </td>
                        <td>{{ number_format($transaction->tr_total,0,',','.') }} VNĐ</td>
                        <td>
                            @if ( $transaction->tr_status == 1)
                                <a href="#" class="label-success label">Đã xử lý</a>
                            @else
                                <a href="#" class="label label-default">Chờ xử lý</a>
                            @endif
                        </td>
                        <td>
                            @if ($transaction->tr_type == \App\Models\Transaction::TYPE_CART)
                                <span class="label-primary label">Thường</span>
                            @else
                                <span class="label-success label">Online</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {!! $transactions->links() !!}
            </div>
        </div>
    </div>
@stop
