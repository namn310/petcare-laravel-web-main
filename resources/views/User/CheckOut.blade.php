@extends('User.LayoutTrangChu')
@section('content')
<style>
  .img {
    width: 30%;
    height: 30%;
  }
</style>
<script>
  function UpdateCart(count,id){
   $.get(
    'route('user.cartupdate')'
   )
  }
</script>
@if (session('status'))
<script>
  $.toast({
                          heading: 'Success',
                          text: '{{ session('status') }}',
                          showHideTransition: 'slide',
                          icon: 'success',
                          position: 'bottom-right'
                          })
</script>
@endif
<div class="container-fluid" style="margin-top:150px" style="background-color:#C0C0C0;height:max-height">

  <div class="table-responsive">
    <h3 class="text-center text-header" style="color:#EA9E1E">GIỎ HÀNG <i class="fa-solid fa-cart-arrow-down"
        style="color:red"></i></h3>
    <form method="post" action="{{ route('user.cartupdate') }}">
      @csrf
      <table class="table table-bordered align-middle text-center  p-3">
        <thead>
          <th class="image-fluid img">Ảnh sản phẩm</th>
          <th class="name">Tên sản phẩm</th>
          <th class="price">Giá</th>
          <th>Giảm giá</th>
          <th class="quantity">Số lượng</th>
          <th class="price">Thành tiền</th>
          <th></th>
        </thead>
        @if (session('cart'))
        <!-- Nếu có giỏ hàng thì hiện ra -->
        <tbody>
          <!-- Danh sách giỏ hàng -->
          @foreach ($cartItem as $cart )
          {{-- <form method="post"> --}}
            <tr>
              <td>
                <img style="max-width:200px" class="image-fluid img"
                  src="{{ asset('assets/img-add-pro/'.$cart['image']) }}">
              </td>

              <td>
                <input value="{{ $cart['idPro'] }}" name="id{{ $cart['idPro'] }}" hidden>
                {{ $cart['name'] }}
              </td>

              <td>
                {{number_format($cart['cost'])}}đ
              </td>
              <td>
                {{$cart['discount']}}%
              </td>

              <td class="">
                <input style="width:30%" type="number" name="idPro{{ $cart['idPro'] }}" id="idPro{{ $cart['idPro'] }}"
                  min="1" value="{{ $cart['count'] }}" required="không để trống">
              </td>
              @if ($cart['discount']>0)
              <td>
                <p><b>
                    {{ number_format($cart['count'] * ($cart['cost'] - ($cart['cost'] * $cart['discount']) / 100))
                    }}₫
                  </b></p>
              </td>
              @else
              <td>
                <p><b>
                    {{ number_format($cart['count'] * ($cart['cost']))}}đ
                  </b></p>
              </td>
              @endif

              <td>
                <a class="text-danger" href="{{ route('user.delete',['id'=>$cart['idPro']]) }}"><i
                    class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
        </tbody>
        <tr class="mt-2">
          {{-- Button destroy cart --}}
          <td colspan="4"><button type="button" class="btn btn-danger" data-bs-toggle="modal"
              data-bs-target="#destroyCart" class="btn btn-danger"><a style="text-decoration:none;color:white">Xóa
                toàn
                bộ</a></button></td>
          <!-- Modal destroy cart -->
          <div class="modal fade" id="destroyCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Bạn có chắc chắn xóa giỏ hàng không ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                  <button type="button" class="btn btn-danger"><a style="text-decoration:none;color:white"
                      href="{{ route('user.destroyCart') }}">Đồng ý </a></button>
                </div>
              </div>
            </div>
          </div>
          <td> <a href="{{ route('user.home') }}" style="text-decoration:none ;color:white" class="btn btn-primary">Tiếp
              tục mua
              hàng</a></td>
          {{-- button update count --}}
          <td>
            <button type="submit" class="btn btn-success">Cập nhật</button>
          </td>

        </tr>


      </table>
    </form>
  </div>

  <!-- Tính tiền giỏ hàng -->


  <div class="total-cart mb-3 text-end">
    <h4 class="text-end">Tổng tiền thanh toán:
      {{ number_format($cartTotal)}}đ
    </h4> <br>

    <a style="text-decoration:none;color:white" href="{{ route('user.checkout') }}"><button
        class="btn btn-primary">Thanh toán</button></a>

  </div>
  @endif

</div>
<br>
<div>
  <hr>
</div>


<!-- Nếu có danh sách lịch hiện thì sẽ hiện ra ở đây

  <div class="booking mt-5 mb-4 text-center">
    <h3 style="color:#EA9E1E">ĐẶT LỊCH</h3>
    <i class="container">Nếu bạn muốn sửa thông tin lịch đã đặt thì bấm sửa để thay đổi lịch hẹn! Sau khi chúng tôi nhận được thông báo đặt lịch nhân viên sẽ liên hệ với bạn. Vui lòng thanh toán với nhân viên để bảo đảm việc đặt lịch !</i>
    <i>Nếu khách hàng có nhu cầu thay đổi lịch hẹn sau khi lịch hẹn đã được phê duyệt, xin vui lòng liên hệ với chúng tôi qua <b>hotline: 012345678</b> để được hỗ trợ</i>
    <div class="container-fluid">

      <table class="table table-bordered align-middle text-center  p-3">
        <thead>
          <th>Tên Boss</th>
          <th>Loại</th>
          <th>Tên dịch vụ</th>
          <th>Tên gói</th>
          <th>Cân nặng của Boss</th>
          <th>Lịch đặt</th>
          <th class="text-center d-flex flex-wrap"></th>
        </thead>

        <tbody class="booking-detail text-center">

       
            <tr>

              <td>

                <input class="form-control" name="Bossname" value="">

              </td>
              <td>
                <input class="form-control" name="Bosstype" value=" ">
              </td>
              <td>
                <input class="form-control" name="dichvu" value=" ">
              </td>
              <td>
                <input class="form-control" name="goi" value="">
              </td>
              <td>
                <input class="form-control" name="weight" value="">
              </td>
              <td>
                <input class="form-control" name="date" value="">
              </td>
              <td class="text-center d-flex flex-wrap justify-content-around">
             
              <th><button class="btn btn-success">Đã duyệt</button></th>
        
              <a name="changeBook" href="index.php?controller=book&action=change&id=" class="changeBook" style="text-decoration:none"> <button type="submit" class="btn btn-primary">Sửa</button>
                <a class="mt-2" href="index.php?controller=book&action=delete&id=" style="text-decoration:none"> <button class="btn btn-danger ms-1" name="deleteBook">Xóa</button></a>

              </td>

            </tr>

        </tbody>
      </table>


    </div>

  </div>
 -->
<script>
  $(document).ready(function() {
    $(".formChangeBook").hide();
    $(".changeBook").click(function() {
      $(".formChangeBook").toggle();
    })
  })
</script>
{{-- <div class=" formChangeBook">
  <div class="form-changeBook d-flex justify-content-center align-items-center">
    <div class=" align-items-center d-flex justify-content-left ps-5">
      <form style="border:1px solid black;border-radius:5px" method="post" class="align-items-center"
        action="index.php?controller=book&action=create&id=" name=" booking_form">
        <div class="form-group pe-5 ps-5">
          <h6 class="text-center">Thay đổi lịch hẹn</h6>
          <label for="Bossname">Tên của Boss</label>
          <input type="text" style="min-width:300px" class="form-control bossname" id="Bossname" name="Bossname"
            placeholder="Nhập tên của boss">

        </div>
        <div class="form-group pe-5 ps-5">
          <label for="Bosstype">Boss là: </label>
          <input type="text" style="min-width:300px" class="form-control" id="Bosstype" name="Bosstype"
            placeholder="Chó, mèo ">

        </div>
        <div class="form-group pe-5 ps-5">
          <label for="Bosstype">Tên dịch vụ: </label>
          <input type="text" style="min-width:300px" class="form-control" id="Bosstype" name="dichvu"
            placeholder="Tên gói muốn đăng ký ">

        </div>
        <div class="form-group pe-5 ps-5">
          <label for="Bosstype">Tên gói: </label>
          <input type="text" style="min-width:300px" class="form-control" id="Bosstype" name="goi"
            placeholder="Tên gói muốn đăng ký ">

        </div>
        <div class="form-group pe-5 ps-5">
          <label for="Bossweight">Cân nặng(kg): </label>
          <input type="text" style="min-width:300px" class="form-control" id="Bossweight" name="weight"
            placeholder="Điền cân nặng của Boss">
        </div>
        <div class="form-group pe-5 ps-5">
          <label>Chọn lịch</label>
          <input name="date" style="min-width:300px" class="form-control" placeholder="Nhập lịch" required type="text">
        </div>
        <div class="align-items-center d-flex justify-content-center">
          <button type="submit" class="btn btn-danger mt-3 submit_booking mb-2">
            Thay đổi
          </button>
        </div>
      </form>
    </div>
  </div>
</div> --}}


{{-- <div class="container-fluid text-center">
  <img class="img-fluid" src="{{ asset('assets/img/618lwjSdN6L._AC_UF1000,1000_QL80_.jpg') }}">
</div> --}}
<style>
  .booking-detail input {
    border: none;

  }
</style>
<div id="pay-form">
  <div class="container mt-4 d-flex flex-column justify-content-center" id="pay-form">
    <div class="customer-detail bg-light" style="border:1px solid gray;border-radius:5px;padding:10px">
      <div class="mt-3"><strong>Thông tin khách hàng</strong></div>
      <form class="mt-4" method="post" action="{{ route('user.confirmCheckOut') }}">
        @csrf
        @method('POST')
        <input id="name" name="name" type="text" class="form-control mb-3" placeholder="Họ và tên" required>
        <input id="phonenumber" name="phone" type="text" class="form-control" placeholder="Số điện thoại" required>
        {{-- <div>
          <select onmouseenter="checkCity()" onmouseout="checkCity()" class="form-select form-select-sm mb-3" id="city"
            aria-label=".form-select-sm">
            <option value="" selected>Chọn tỉnh thành</option>
          </select>

          <select onmouseenter="checkDistrict()" onmouseout="checkDistrict()" class="form-select form-select-sm mb-3"
            id="district" aria-label=".form-select-sm">
            <option value="" selected>Chọn quận huyện</option>
          </select>

          <select onmouseenter="checkWard()" onmouseout="checkWard()" class="form-select form-select-sm" id="ward"
            aria-label=".form-select-sm">
            <option value="" selected>Chọn phường xã</option>
          </select>
        </div> --}}
        <input id="address" type="text" class="form-control mt-2" placeholder="Địa chỉ giao hàng" name="address"
          required>
        {{-- <input onclick="checkCustomerDetailEmail()" onkeyup="checkCustomerDetailEmail()" id="email" type="email"
          class="form-control" placeholder="Email" required> --}}
        <p>Ghi chú (nếu có)</p>
        <input id="description" type="text" name="note" class="form-control"
          style="width:100%;resize:none;border-radius:5px;min-height:100px">

        <div class="payment mt-5 bg-light" id="payment" style=" border:1px solid gray;border-radius:5px;padding:10px">
          <div class="mb-2">
            <strong>
              Chọn phương thức thanh toán
            </strong>
          </div>
          <div class="payment-1">
            <input type="radio" checked value="Thanh toán bằng phương thức COD" name="payment" id="payment">
            <label style="font-weight: bolder;" for="payment-1">Thanh toán bằng phương thức COD</label>
            <div class="payment1-detail">
              <p>
                - Quý khách vui lòng thanh toán toàn bộ giá trị đơn hàng cho nhân viên giao hàng
              </p>
              <span>
                <strong>Lưu ý: </strong>
                <p>Trong trường hợp có bất cứ vấn đề gì về đơn hàng sau khi thanh toán quý khách vui lòng liên hệ qua
                  bên tổng đài qua số Hotline: <strong>0912345669</strong></p>
              </span>
            </div>
          </div>

          <div class="payment-2">
            <input type="radio" value="Thanh toán bằng phương thức chuyển khoản" name="payment" id="payment">
            <label style="font-weight: bolder;" for="payment-2">Thanh toán bằng phương thức chuyển khoản</label>
            <div class="payment2-detail">
              <p>

                Chủ tài khoản: NGUYEN PHUONG NAM

              </p>
              <p>Số tài khoản: 0123456789</p>
              <p>Nội dung chuyển khoản: <span class="text-danger"> [Họ tên khách hàng + số điện thoại] - Vui lòng nhập
                  thông tin đúng với thông tin đã điền ở phía trên</span></p>
              <span>
                <strong>Lưu ý: </strong>
                <p>Trong trường hợp có bất cứ vấn đề gì về đơn hàng sau khi thanh toán quý khách vui lòng liên hệ qua
                  bên tổng đài qua số Hotline: <strong>0912345669</strong></p>
              </span>
            </div>
          </div>
          <button type="submit" style="width:15%" id="confirm-payment" class="btn btn-danger mt-3">
            Xác nhận thanh toán
          </button>
        </div>
      </form>
    </div>
  </div>


</div>




<!--footer end-->
<script src="{{ asset('assets/js/script.js') }}"></script>

{{-- <script>
  $('.checkout').click(function() {
    if (confirm('Xử lý đơn hàng thành công')) {
      window.location.href = 'index.php?controller=cart&action=checkout';
    }
  })
</script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
  $(document).ready(function() {
    $("#thanhtoan").click(function() {
      $("#pay-form").toggle();
    })
  })
</script>
<script>
  var citis = document.getElementById("city");
  var districts = document.getElementById("district");
  var wards = document.getElementById("ward");
  var Parameter = {
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
    method: "GET",
    responseType: "application/json",
  };
  var promise = axios(Parameter);
  promise.then(function(result) {
    renderCity(result.data);
  });

  function renderCity(data) {
    for (const x of data) {
      citis.options[citis.options.length] = new Option(x.Name, x.Id);
    }
    citis.onchange = function() {
      district.length = 1;
      ward.length = 1;
      if (this.value != "") {
        const result = data.filter(n => n.Id === this.value);

        for (const k of result[0].Districts) {
          district.options[district.options.length] = new Option(k.Name, k.Id);
        }
      }
    };
    district.onchange = function() {
      ward.length = 1;
      const dataCity = data.filter((n) => n.Id === citis.value);
      if (this.value != "") {
        const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

        for (const w of dataWards) {
          wards.options[wards.options.length] = new Option(w.Name, w.Id);
        }
      }
    };
  }
</script>
@endsection