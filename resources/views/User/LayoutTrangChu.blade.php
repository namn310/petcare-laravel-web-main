<?php
use Illuminate\Support\Facades\DB;
use App\Models\product;
if(session('cart')){
    $total = 0;
        foreach (session('cart') as $row) {
            $total += 1;
        }   }
$product=product::select()->get();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/PetCARE.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/user-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user1.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- toast message --}}
    <script src="
        https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.js
        "></script>
    <link href="
        https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.css
        " rel="stylesheet">
</head>

<body>
    <!--Header -->
    <div class="header container-fluid mb-3 fixed-top">

        <div class="d-flex justify-content-between bg-dark  py-2 px-lg-5 ">
            <div class=" text-left  mb-2 mb-lg-0 d-inline-flex">
                <a class="text-white px-3" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-white px-3" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-white px-3" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-white px-3" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-white px-3" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
            <div class=" d-inline-flex align-items-right justify-content-end px-0">
                <div class="d-inline-flex align-items-center ">
                    <a class="text-white px-3" href=""><i class="fa-solid fa-phone mx-1"></i>0123456789</a>
                </div>
            </div>
        </div>
        <div class="row navbar navbar-dark bg-white shadow">
            <nav class="navbar navbar-expand-md ">
                <div class="container-fluid">
                    <div class="nav-brand ps-5 text-center" style="width: 200px;">
                        <img class="img cursor: pointer; w-25" src="{{ asset('assets/img/PetCARE.png') }}">
                        <a class="navbar-brand mx-0" href="{{ route('user.home') }}" style="color: #F7A98F;">PetCare</a>
                    </div>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">PetCare</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link mx-lg-2 " aria-current="page"
                                        href="{{ route('user.home') }}">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-lg-2 " href="{{ route('user.about') }}">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-lg-2 " href="{{ route('user.service') }}">Dịch vụ</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link mx-lg-2 "
                                        href="{{ route('user.product',['id'=>DB::table('categories')->first()->idCat]) }}">Sản
                                        phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-lg-2 " href="{{ route('user.book') }}">Đặt lịch</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-lg-2 " href="{{ route('user.contact') }}">Liên hệ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-lg-2" href="{{ route('user.cart') }}">Giỏ hàng <i
                                            class="fa-solid fa-cart-shopping ms-1"></i>
                                        @if (session('cart') && Auth::guard('customer')->check())

                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{
                                            $total
                                            }}
                                        </span>
                                        @endif
                                    </a>
                                </li>
                        </div>
                    </div>

                    <button class="btn text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    @if (!Auth::guard('customer')->check())
                    <a style="text-decoration:none;color:black" class="me-2 ms-2" href="{{ route('user.login') }}">Đăng
                        Nhập</a><span></span>
                    @else
                    <div class="nav-item dropdown">
                        <a class=" login-button dropdown-toggle" style="width:190px" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <small><i class="fa-solid fa-user"></i> {{ Auth::guard('customer')->user()->name }}</small>
                        </a>
                        <ul class="dropdown-menu" style="top:60px">
                            <li><a class="dropdown-item" href="{{ route('user.orderView') }}"><i
                                        class="fa-solid fa-cart-shopping pe-2" style="color: #cf1717;"></i>Đơn hàng</a>
                            </li>
                            <li>
                                @csrf<a class="dropdown-item" href="{{ route('user.infor') }}"><i
                                        class="fa-solid fa-gear pe-2"></i>Cài đặt</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.changePassForm') }}"><i
                                        class="fa-solid fa-key pe-2 text-primary"></i>Đổi mật khẩu</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}">Đăng Xuất<i
                                        class="fa-solid fa-right-from-bracket text-secondary ps-2"></i></a></li>
                        </ul>
                    </div>
                    @endif
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
        <div>
            <div class="row my-2" style="overflow-y:hidden">
                <div class="col-4"></div>
                <div class="col-4">
                    <div class="collapse mb-1" id="collapseExample">
                        <div class="input-group flex-nowrap" role=" search">
                            <input id="search_pro" class="form-control me-2" type="search"
                                placeholder="Tìm kiếm sản phẩm" aria-label="Search">

                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div id="list-search-product" class="d-flex text-center mt-1 flex-wrap"
                style="overflow-y:visible;overflow-x:hidden;max-height:300px;width:400px">
                @foreach ($product as $row)
                <div class="listPro bg-white" style="display:none">
                    <div style="border-bottom:1px solid black;height:50px;width:400px;padding-left:10px;padding-right:20px "
                        class="d-flex justify-content-start bg-white ">
                        <a style="text-decoration:none" href="{{ route('user.productDetail',['id'=>$row->idPro]) }}">
                            <img src="{{ asset('assets/img-add-pro/'.$row->getImgProduct($row->idPro)) }}"
                                class="img-fluid" style="max-width:100%;height:100%"></a>
                        <p id="product-name-search" class="ms-3">
                            {{ $row->namePro }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @yield('content');
    <script>
        //searchProduct
        $(document).ready(function() {
            $("#search_pro").click(function() {
                $(".listPro").toggle();
            })
            $("#search_pro").on("keyup", function() {
                var q = $("#search_pro").val();
                // var product = document.querySelectorAll("#product-name-search");
                var productName = document.querySelectorAll("#product-name-search");
                //console.log(productName);
                productName.forEach((a) => {
                    $(a).parent().filter(function() {
                        var b = $(a).text();
                        $(a).parent().parent().toggle($(a).text().toLowerCase().indexOf(q) > -1)
                    });
                    //console.log(a.parentElement.parentElement);
                })

                /*productName.forEach((a) => {
                    $(a).parent().filter(function() {
                        $(a).parent().toggle($(a).text().toLowerCase().indexOf(q) > -1)
                    });
                });*/
            });
        });
    </script>
    <style>
        .img_product_search {
            flex: 1;
        }

        .name_product_search {
            flex: 3;
        }
    </style>
    <!-- 
<div class="menu-phone" >
    <div><a href="index1.html">Trang chủ </a></div>
    <div><a href="about.html">Giới thiệu  </a></div>
    <div><a href="service.html">Dịch vụ </a></div>
    <div><a href="product.html">Sản phẩm </a></div>
    <div><a href="booking.html">Đặt lịch </a></div>
    <div><a href="cart.html"><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</a></div>
</div>-->
    <!--header end-->

    <!--footer-->

    <div class="container-fluid d-flex justify-content-around flex-wrap bg-dark mt-5">
        <div class="footer1 d-flex align-items-center flex-column p-3">
            <h1 class="mb-3 mt-4  text-capitalize" style="color:#F7A98F">PetCare</h1>
            <p class="text-white">Giờ hoạt động: 8AM-10PM</p>
        </div>
        <div class="footer2 mt-3 text-white d-flex flex-column justify-content-between p-3">
            <h3>Get in touch</h3>
            <span>
                <h6><i class="fa-solid fa-envelope-circle-check fa-lg me-3"
                        style="color: #ffffff;"></i>petcare@gmail.com
                </h6>
            </span>
            <span>
                <h6><i class="fa-solid fa-phone fa-lg me-4" style="color: #ffffff;"></i>0912345678</h6>
            </span>
            <span>
                <h6><i class="fa-solid fa-location-dot fa-lg me-4" style="color: #ffffff;"></i>Láng Thượng, Đống Đa, Hà
                    Nội
                </h6>
            </span>
        </div>
        <div class="footer3 d-flex text-white flex-column mt-3 justify-content-between p-3 text-center">
            <h3>Popular links</h3>
            <a href="#"><i class="fa-brands fa-facebook fa-lg me-3" style="color: #ffffff;"></i></a>
            <a href="#"><i class="fa-brands fa-instagram fa-lg me-3" style="color: #ffffff;"></i></a>
            <a href="#"><i class="fa-brands fa-youtube fa-lg me-3" style="color: #ffffff;"></i></a>
        </div>

    </div>

    <!--footer end-->
</body>
<script href="{{ asset('assets/js/script.js') }}"></script>

</html>