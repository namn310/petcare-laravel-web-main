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
@if (session('error'))
<script>
  $.toast({
                          heading: 'Error',
                          text: '{{ session('error') }}',
                          showHideTransition: 'slide',
                          icon: 'error',
                          position: 'bottom-right'
                          })
</script>
@endif
<div class="container-fluid cartView" style="height:max-height">
  {{-- cartSmallView --}}
  <div class="cartSmallView mt-2">
    <section class="h-100" style="background-color: #d2c9ff;margin-bottom:50px">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12">
            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
              <div class="card-body p-0">
                <div class="row g-0">
                  <div class="col-lg-8">
                    <form method="post" action="{{ route('user.cartupdate') }}">
                      @csrf
                      <div class="p-5">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                          <h3 class="fw-bold mb-0">Shopping Cart <i class="fa-solid fa-cart-plus"></i></h3>
                          <h6 class="mb-0 text-muted">{{ $cartCount }} sản phẩm</h6>
                        </div>
                        <hr class="my-4">
                        @foreach ($cartItem as $row )
                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                          <div class="col-md-2 col-lg-2 col-xl-3">
                            <img src="{{ asset('assets/img-add-pro/'.$row['image']) }}" class="img-fluid rounded-3"
                              alt="Cotton T-shirt">
                          </div>
                          <div class="col-md-3 col-lg-3 col-xl-3">
                            {{-- <h6 class="text-muted">Shirt</h6> --}}
                            <h6 class="mb-0"><input value="{{ $row['idPro'] }}" name="id{{ $row['idPro'] }}" hidden>
                              {{ $row['name'] }}</h6>
                          </div>
                          <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                            <input style="width:30%" type="number" name="idPro{{ $row['idPro'] }}"
                              id="idPro{{ $row['idPro'] }}" min="1" value="{{ $row['count'] }}"
                              required="không để trống">

                          </div>
                          <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                            @if ($row['discount']>0)
                            <h6 class="mb-0">{{ number_format($row['count'] * ($row['cost'] - ($row['cost'] *
                              $row['discount']) / 100))
                              }}₫</h6>
                            @else
                            <h6 class="mb-0">{{ number_format($row['count'] * ($row['cost']))}}đ</h6>
                            @endif

                          </div>
                          <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                            <a href="{{ route('user.delete',['id'=>$row['idPro']]) }}" class="text-muted"><i
                                class="fas fa-times"></i></a>
                          </div>
                        </div>

                        <hr class="my-4">

                        @endforeach
                        <div class="pt-3 text-end">
                          <button type="submit" class="btn btn-dark"><i class="fa-solid fa-box-archive"></i> Cập nhật
                          </button>
                        </div>
                        <div class="pt-2">
                          <h6 class="mb-0"><a href="{{ route('user.home') }}" class="text-body"><i
                                class="fas fa-long-arrow-alt-left me-2"></i>Back
                              to shop</a></h6>

                        </div>
                      </div>
                    </form>
                  </div>
                  @if(session('cart'))
                  <div class="col-lg-4 bg-body-tertiary">
                    <div class="p-5">
                      <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                      <hr class="my-4">

                      {{-- <div class="d-flex justify-content-between mb-4">
                        <h5 class="text-uppercase">items 3</h5>
                        <h5>€ 132.00</h5>
                      </div> --}}

                      {{-- <h5 class="text-uppercase mb-3">Shipping</h5>

                      <div class="mb-4 pb-2">
                        <select data-mdb-select-init>
                          <option value="1">Standard-Delivery- €5.00</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                          <option value="4">Four</option>
                        </select>
                      </div> --}}

                      <h5 class="text-uppercase mb-3">Voucher</h5>

                      <div class="mb-5">
                        <div data-mdb-input-init class="form-outline">
                          <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Examplea2">Enter your code</label>
                        </div>
                      </div>

                      <hr class="my-4">

                      <div class="d-flex justify-content-between mb-5">
                        <h5 class="text-uppercase">Tổng tiền</h5>
                        <h5>{{ number_format($cartTotal) }}đ</h5>
                      </div>

                      <a style="text-decoration:none;color:white" href="{{ route('user.checkout') }}"><button class="buttonThanhToan"
                          type="button"><span class="shadow"></span>
                          <span class="edge"></span>
                          <span class="front text"> Thanh toán
                          </span></button></a>

                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <style>
    @media (min-width: 1025px) {
      .h-custom {
        height: 100vh !important;
      }
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
      top: 13px;
    }
  </style>
</div>


{{--
<div class="booking mt-5 mb-4 text-center">
  <h3 style="color:#EA9E1E">ĐẶT LỊCH</h3>
  <i class="container">Nếu bạn muốn sửa thông tin lịch đã đặt thì bấm sửa để thay đổi lịch hẹn! Sau khi chúng tôi nhận
    được thông báo đặt lịch nhân viên sẽ liên hệ với bạn. Vui lòng thanh toán với nhân viên để bảo đảm việc đặt lịch
    !</i>
  <i>Nếu khách hàng có nhu cầu thay đổi lịch hẹn sau khi lịch hẹn đã được phê duyệt, xin vui lòng liên hệ với chúng tôi
    qua <b>hotline: 012345678</b> để được hỗ trợ</i>
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

          <a name="changeBook" href="index.php?controller=book&action=change&id=" class="changeBook"
            style="text-decoration:none"> <button type="submit" class="btn btn-primary">Sửa</button>
            <a class="mt-2" href="index.php?controller=book&action=delete&id=" style="text-decoration:none"> <button
                class="btn btn-danger ms-1" name="deleteBook">Xóa</button></a>

            </td>

        </tr>

      </tbody>
    </table>


  </div>

</div> --}}

<script>
  $(document).ready(function() {
    $(".formChangeBook").hide();
    $(".changeBook").click(function() {
      $(".formChangeBook").toggle();
    })
  })
</script>

<div class="container-fluid text-center">
  <img class="img-fluid" src="{{ asset('assets/img/618lwjSdN6L._AC_UF1000,1000_QL80_.jpg') }}">
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection