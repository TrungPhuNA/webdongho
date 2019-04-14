<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Demo Giao diện</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&amp;subset=vietnamese" rel="stylesheet">
</head>
<body>

<section style="background-color: white">
    <div class="tp_container" id="header_top" style="margin-top: 0">
        <header class="header_top">
            <div class="nav_top width-100">
                <ul class="float-right">
                    <li><a href=""><i class="far fa-address-book"></i>Kiểm tra đơn hàng</a></li>
                    <li><a href=""><i class="fas fa-phone"></i>Chăm sóc khách hàng</a></li>
                    <li><a href=""><i class="fas fa-bell"></i>Thông báo</a></li>
                </ul>
                <div class="clearfloat"></div>
            </div>
            <div class="header_content width-100 flex">
                <div class="width-20 header_content_left">
                    <a href="" class="header_content_logo">
                        <img src="https://image.yes24.vn/upload/image/ci.png" alt="">
                    </a>
                </div>
                <div class="width-30 header_content_search">
                    <form action="" class="flex">
                        <input type="text" placeholder="Bạn tìm gì hôm nay?">
                        <button><i class="fas fa-search"></i> </button>
                    </form>
                </div>
                <div class="width-50 header_content_right">
                    <ul class="float-right">
                        <li>
                            <a href="" class="flex"><i class="fas fa-car-side"></i> <span>Sản phẩm đã xem</span></a>
                        </li>
                        <li>
                            <a href="" class="flex"><i class="fas fa-radiation-alt"></i> <span>Khuyến mãi</span></a>
                        </li>
                        <li class="">
                            <div class="nav_user">
                                <span><i class="fas fa-user-plus"></i></span>
                                <p><a href="">Đăng ký</a> <br><a href="">Đăng nhập</a></p>
                            </div>
                        </li>
                        <li>
                            <a href="" class="shopping_nav"><i class="fas fa-cart-arrow-down"></i><span>2</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
    </div>
</section>

<section id="scrollMenu" style="border-bottom: 1px solid #dedede;background-color: white">
    <div class="tp_container" style="margin-top: 0">
        <nav class="main_menu">
            <ul class="float-left">
                <li><a href=""><i class="fas fa-home"></i> Trang chủ</a></li>
                <li><a href=""><i class="fas fa-database"></i> Sản phẩm</a></li>
                <li><a href=""><i class="fas fa-pen"></i> Tin tức</a></li>
                <li><a href=""><i class="fas fa-address-card"></i> Giới thiệu</a></li>
                <li><a href=""><i class="fas fa-file-signature"></i> Liên hệ</a></li>
            </ul>
            <div class="clearfloat"></div>
        </nav>
    </div>
</section>
@yield('slide')
@yield('content')
<section class="footer tp_container_fluid">
    <div class="box_footer">
        <div class="width-100 footer_top flex">
            <div class="width-25 footer_top_item">
                <h5>Chăm sóc khách hàng</h5>
                <ul>
                    <li><a href="">Trung tâm trợ giúp</a></li>
                    <li><a href="">Hướng dẫn mua hàng</a></li>
                    <li><a href="">Chinh sách bảo hành</a></li>
                    <li><a href="">Chăm sóc khách hàng</a></li>
                </ul>
            </div>
            <div class="width-25 footer_top_item">
                <h5>Về chúng tôi</h5>
                <ul>
                    <li><a href="">Giới thiệu Cty</a></li>
                    <li><a href="">Tuyển dụng</a></li>
                    <li><a href="">Điều khoản sử dụng</a></li>
                    <li><a href=""></a></li>
                </ul>
            </div>
            <div class="width-25 footer_top_item">
                <h5>Thanh toán</h5>
                <p><span></span><span></span></p>
            </div>
            <div class="width-25 footer_top_item">
                <h5>Đăng ký nhận tin khuyến mãi</h5>
                <form action="" class="flex">
                    <input type="text" placeholder="Email ...">
                    <button type="submit">Nam</button>
                    <button type="submit">Nữ</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer_nav">
        <ul class="">
            <li><a href="">Giới thiệu</a></li>
            <li><a href="">Quy định sử dụng</a></li>
            <li><a href="">Quản lý thông tin cá nhân</a></li>
            <li><a href="">Tin tức</a></li>
            <li><a href="">Tuyển dụng</a></li>
            <li><a href="">Đối tác</a></li>
        </ul>
    </div>
    <div class="footer_bottom">
        <p>Copyright © <a href="">TrungPhuNA</a> 2019</p>
    </div>
</section>

</body>
</html>

<script>

	//slide
	var slideIndex = 1;
	showDivs(slideIndex);

	function plusDivs(n) {
		showDivs(slideIndex += n);
	}

	function showDivs(n) {
		var i;
		var x = document.getElementsByClassName("mySlides");
		if (n > x.length) {slideIndex = 1}
		if (n < 1) {slideIndex = x.length}
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		x[slideIndex-1].style.display = "block";
	}

	//fix
	// When the user scrolls the page, execute myFunction
	window.onscroll = function() {myFunction()};
	var header = document.getElementById("scrollMenu");
	var sticky = header.offsetTop;
	function myFunction() {
		console.log(sticky);
		if (window.pageYOffset > sticky) {
			header.classList.add("fix_menu");
		} else {
			header.classList.remove("fix_menu");
		}
	}

</script>