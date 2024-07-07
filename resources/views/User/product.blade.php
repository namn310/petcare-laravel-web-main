@extends('User.LayoutTrangChu')

@section('content')
<!-- main images -->
<div class="main_img mt-2">

</div>

<style>
  @media screen and (max-width:1030px) {
    .pdt {
      margin-top: 50px;
    }
  }

  @media screen and (max-width:750px) {
    .pdt {
      margin-top: 100px;
    }
  }
</style>
<!-- Danh mục sản phẩm-->
<div class=" container-fluid pdt">
  <div class="row">
    <div class="col-3 sm">
      {{-- <a href="{{ route('user.destroyCart') }}">click</a> --}}
      <h3 class="text-center mb-2">Danh mục sản phẩm</h3>
      <ul class="category list-group">
        <!-- Lấy dữ liệu bảng danh mục xuất ra danh mục -->
        @foreach ($category as $row )

        <li class="list-group-item"><a href="{{ route('user.product',['id'=>$row->idCat]) }}"> <button
              class="btn btn-white" style="width:100%">
              {{ $row->name }}
            </button></a></li>
        @endforeach
      </ul>
    </div>
    <div class="col-9 lg">
      <nav class="navbar mb-3 navbar-light bg-light justify-content-between">
        <h3 style="color:black">
          @foreach ($categoryName as $name )
          {{ $name->name }}
          @endforeach
        </h3>
        {{-- button tìm kiếm --}}
        <form class="form-inline d-flex">
          <input class="form-control mr-sm-2" type="text" id="nameProductSearch" placeholder="Search"
            aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0 ml-3" id="buttonSearch" type="button"><i
              class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </nav>
      {{-- Danh sách sản phẩm --}}
      <div class="product-list container d-flex align-items-start flex-wrap">
        <!-- Lấy dữ liệu từ bảng product để xuất ra sản phẩm -->
        @foreach ($product as $result )

        {{-- Thông tin sản phẩm --}}
        <div id="product-infor" class="card position-relative" style="width: 15rem;height:29rem" style="border:0px">
          {{-- giảm giá sản phẩm --}}
          @if ($result->discount>0)
          <div class="onsale position-absolute top-0 start-0">
            <span class="badge rounded-0 bg-danger"><i class="fa-solid fa-arrow-down"></i>
              {{ $result->discount }}%
            </span>
          </div>
          @endif
          <div>
            {{-- hình ảnh sản phẩm --}}
            <a id="img_pro" href="{{ route('user.productDetail',['id'=>$result->idPro]) }}"> <img
                class="card-img-top img-fluid p-2" style="max-height:20rem"
                src="{{ asset('assets/img-add-pro/'.$result->getImgProduct($result->idPro)) }}"
                alt="Card image cap"></a>
          </div>
          <div class="card-body" id="card-body">
            <h6 id="name-product" class="card-title">
              {{ $result->namePro }}

            </h6>
            <span class="rating secondary-font">
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              5.0</span>
            @if ($result->discount<=0) <p class="card-text text-danger">
              {{ number_format($result->cost) }}đ
              </p>
              @else
              <p class="card-text text-danger text-decoration-line-through">
                {{ number_format($result->cost) }}đ
              </p>
              <p class="card-text text-danger" style="margin-top:-15px">

                {{ number_format($result->cost - ($result->cost * $result->discount) / 100); }}đ
              </p>
              @endif
              <a href="{{ route('user.add',['id'=>$result->idPro]) }}" style="text-decoration:none;color:white"><button
                  type="submit" style="position:absolute;top:0;right:0" class="btn btn-white shadow-sm rounded-pill"><i
                    style="color:black" class="fa-solid fa-cart-shopping text-danger"></i></button></a>
          </div>
        </div>
        @endforeach

      </div>
      <!--
      <div class="mt-3 d-flex ">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>
      -->
    </div>
  </div>
</div>

<div class="modal fade" id="modalbuyproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Đã thêm sản phẩm vào giỏ hàng !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Xác nhận</button>
      </div>
    </div>
  </div>
</div>
<!-- End mục sản phẩm-->

<script src="js/script.js"></script>
<!-- Tìm kiếm sản phẩm -->
<script>
  //searchProduct
  $(document).ready(function() {
    $("#nameProductSearch").on("keyup", function() {
      var result = $("#nameProductSearch").val().toLowerCase();
      var nameProduct = document.querySelectorAll("#name-product");
      nameProduct.forEach((product) => {

        $(product).parent().parent().parent().filter(function() {
          $(product).parent().parent().toggle($(product).text().toLowerCase().indexOf(result) > -1);
        })

      })
    });
  });
</script>
@endsection