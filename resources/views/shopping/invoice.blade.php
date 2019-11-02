<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
    #invoice{
        padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .invoice table td,.invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,.invoice table .total,.invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px!important;
            overflow: hidden!important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice"  onclick="printPDf()" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            {{--<button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>--}}
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">{{ get_data_user('web','name') }}</a>
                        </h2>
                        <div>{{ $transaction->tr_address }}</div>
                        <div>{{ $transaction->tr_phone }}</div>
                        <div>{{ get_data_user('web','email') }}</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Tên Sản Phẩm</th>
                            <th class="text-right">Hình Ảnh</th>
                            <th class="text-right">Gía tiền</th>
                            <th class="text-right">Số Lượng</th>
                            <th class="text-right">Tổng Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($orders))
                            @foreach($orders as $key => $item)
                            <tr>
                                <td class="no">{{ $key + 1 }}</td>
                                <td class="text-left">
                                    <h3>
                                        <a target="_blank" href="">{{ isset($item->product->pro_name) ? $item->product->pro_name  : "[N\A]" }}</a>
                                    </h3>
                                    <p>{{ $item->pro_description }}</p>
                                </td>
                                <td>
                                    <img src="{{ asset(isset($item->product->pro_avatar) ? pare_url_file($item->product->pro_avatar)  : "[N\A]") }}" style="width: 60px;height: 60px" alt="">
                                </td>
                                <td class="unit">{{ number_format($item->or_price,0,',','.') }} VNĐ</td>
                                <td class="qty">{{ $item->or_qty }}</td>
                                <td class="total">{{ number_format($item->or_price * $item->or_qty,0,',','.') }} VNĐ</td>
                            </tr>
                            @endforeach
                        @endif

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2">Tổng Tiền</td>
                        <td>{{ number_format($transaction->tr_total,0,',','.') }} VNĐ</td>
                    </tr>
                    </tfoot>
                </table>
                
                <div class="notices">
                    <div>Chú ý:</div>
                    <div class="notice">Đơn hàng đang được xử lý và sẽ giao hàng trong thời gian sớm nhất</div>
                </div>
            </main>
            <footer>
                <a href="/">Về Trang Chủ</a>
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>

<script>
	function printPDf() {
		window.print();
	}
</script>