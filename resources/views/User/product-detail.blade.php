@extends('User.LayoutTrangChu')
@section('content')
<style>
  @media screen and (max-width:1030px) {
    .a {
      margin-top: 50px;
    }
  }

  @media screen and (max-width:750px) {
    .a {
      margin-top: 100px;
    }
  }

  .product-detail-img {
    flex: 1;
  }

  .product-detail-intro {
    flex: 1;
  }
</style>
<script>
  $(document).ready(function(){
    //var listImage=document.querySelectorAll("main-img-product");
    var listImage=document.querySelectorAll(".list-img");
    listImage.forEach(img => {
      var a = $(img).attr('src');
      $(img).click(function(){
        $('.main-img-product').attr('src',a);
      })
    });
  })
</script>
<!-- Danh mục sản phẩm-->
<div class="container-fluid pdt">
  <div class="row a ">
    <div>
      <nav class="navbar mb-3 navbar-light bg-light justify-content-between">
        <h3 style="color:black"></h3>
        <form class="form-inline d-flex">
          <!-- <input class="form-control mr-sm-2" type="text" id="nameProductSearch" placeholder="Search" aria-label="Search"> -->
          <!-- <button class="btn btn-outline-success my-2 my-sm-0 ml-3" id="buttonSearch" type="button">Search</button> -->
        </form>
      </nav>
      @foreach ($productDetail as $row )
      <div class="product-detail d-flex">
        <div style="position:relative;max-height:550px">
          <div class="d-flex flex-column justify-content-center img-slide mt-3"
            style="max-height:550px;overflow:hidden">
            @foreach ($productListImg as $result )
            <div style=" max-width:140px"><img class="img-fluid p-2 list-img"
                src="{{ asset('assets/img-add-pro/'.$result->image) }}"></div>
            @endforeach

          </div>
          <button style="position:absolute;bottom:-40px;left:40px" class="btn btn-white "><i
              class="fa-solid fa-angle-down fa-xl"></i></button>
          <button style="position:absolute;top:-10px;left:40px" class="btn btn-white "><i
              class="fa-solid fa-angle-up fa-xl"></i></button>
        </div>
        <div class="d-flex justify-content-between">
          <div class="product-detail-img ms-2">
            {{-- Ảnh sản phẩm --}}
            <img class="img-float main-img-product" id="main-img-product"
              style="max-width:800px;max-height:600px;border:1px solid  #EA9E1E;border-radius:5px"
              src="{{ asset('assets/img-add-pro/'.$productMainImg) }}">
          </div>
          <div class="product-detail-intro ms-5">
            <p>
              {{-- Tên sản phẩm --}}
            <h4>
              {{ $row->namePro }}
            </h4>
            </p>
            {{-- Mã sản phẩm --}}
            <p><strong>Mã sản phẩm : </strong>
              {{ $row->idPro }}
            </p>
            <p><strong>Lượt mua: </strong>324</p>
            <span class="rating secondary-font">
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              <i class="fa-solid fa-star text-warning"></i>
              5.0</span>
            @if (!$row->discount>0) <p class="card-text text-danger">Giá: {{ $row->cost }}</p>
            @else
            <p>
              <span>Giá gốc:
                <i class="card-text text-danger text-decoration-line-through">{{ number_format( $row->cost) }} đ</i>
              </span>
            </p>
            <p class="card-text text-danger">{{ number_format($row->cost - ($row->cost * $row->discount) / 100); }}đ</p>
            @endif

            <!-- Button trigger modal -->
            <button type="button" style="width:20% ;margin-left:10px;margin-bottom:20px" id="cartSucess"
              class="btn btn-danger mt-3">
              <a style="text-decoration:none;color:white" href="{{ route('user.add',['id'=>$row->idPro]) }}">
                Mua
              </a>

            </button>

          </div>
        </div>
      </div>

      <div class="mt-3">
        <ul class="nav nav-tabs" style="cursor:pointer">
          <li class="nav-item" style="font-weight:bold">
            <a class="nav-link" id="mota" style="text-decoration:none;color:black" aria-current="page">Mô tả sản
              phẩm</a>
          </li>
          <li class="nav-item" style="font-weight:bold">
            <a class="nav-link" id="comment" style="text-decoration:none;color:black">Bình luận</a>
          </li>
        </ul>
        <!-- Mô tả sản phẩm -->
        <div class="thongtinchitiet mt-3" style="padding-bottom:50px">
          <?php echo $row->description ?>

        </div>
        <!--  Bình luận sản phẩm -->
        <div class="comment mt-3">
          <!--           <iframe style="width:100%" src="../../Project-petcare-php/user/Views/Comment.php"></iframe>
 -->
          @if (Auth::guard('customer')->check())
          <!-- box comment -->
          <form method="post" action="{{ route('user.comment',['id'=>$row->idPro]) }}">
            @csrf
            @method('post')
            <input placeholder="Nhập bình luận của bạn" style="width:100%;border-radius:10px;height:50px" name="comment"
              required>
            <button class="btn btn-primary mt-3 float-end" type="submit">Bình luận</button>
          </form>
          @else
          <a href="{{ route('user.login') }}">Hãy đăng nhập để có thể bình luận</a>
          @endif
          <!-- Danh sách các bình luận -->
          {{-- @if (Auth::guard('customer')->check()) --}}
          <div class="container" style="width:70%;height:300px;margin-top:20px;overflow-y:auto;overflow-x:hidden">
            <div class="list-comment mt-5" style="background-color:#EEEEEE;border-radius:6px" width="80%">
              @foreach ($comment as $cmt )
              <div class="d-flex mt-3 ms-5">
                {{-- avt user --}}
                <div class="me-4">
                  <img style="width:50px;height:50px;margin-left:40px;margin-top:10px;border-radius:20px"
                    class="img-fluid rounded text-center"
                    src="{{ asset('assets/img-avt-customer/'.$cmt->getAvtCus($cmt->idCus)) }}">
                </div>

                <div class=""
                  style="margin-bottom:20px;box-shadow: 2px 2px 2px gray;margin-top:10px;background-color:#FFFFFF;border-radius:10px;width:60%">
                  <span style="font-weight:bold;font-size:15px;color:blue" class="user-name">{{
                    $cmt->getNameUser($cmt->idCus) }}</span>
                  <span style="font-weight:lighter" class="comment-time">{{ $cmt->created_at }}</span>
                  <div style="margin-left:40px" class="noidung">{{ $cmt->title }}</div>
                  <br>
                </div>
              </div>
              @endforeach


            </div>

            <!-- end danh sách bình luận -->

          </div>


        </div>
      </div>
      <script>
        $(document).ready(function() {
          $(".comment").hide();

          $("#comment").click(function() {
            $(".thongtinchitiet").hide();
            $(".comment").show();
          })
          $("#mota").click(function() {
            $(".thongtinchitiet").show();
            $(".comment").hide();
          })
        })
      </script>
      <!-- modal thông báo thêm hàng vào giỏ  -->
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
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
              <button type="button" class="btn btn-success" data-bs-dismiss="modal">Xác nhận</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End mục sản phẩm-->
@endforeach


<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="cartSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>

<!--footer end-->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script>
  const toastTrigger = document.getElementById('liveToastBtn');
  const toastLiveExample = document.getElementById('liveToast');

  if (toastTrigger) {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastTrigger.addEventListener('click', () => {
      toastBootstrap.show()
    })
  }
</script>
@endsection