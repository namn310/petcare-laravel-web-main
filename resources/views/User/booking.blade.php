@extends('User.LayoutTrangChu')
@section('content')
<!-- main images -->
@if (session('notice'))
<script>
  $.toast({
                        heading: 'Success',
                        text: '{{ session('notice') }}',
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
<!-- Booking -->
<div class="container mt-4 pdt">
  <h3 class="service text-capitalize">ĐẶT LỊCH NGAY</h3>
  <hr>
  <div class="row">
    <div class="col-4">
      <img src="{{ asset('assets/img/load2.gif') }}" class="w-100">

    </div>
    <div class="col-8 align-items-left d-flex justify-content-left ps-5">
      <form style="width:50%" method="post" class="align-items-center" action="{{ route('user.bookCreate') }}"
        name=" booking_form">
        @csrf
        @method('post')
        <div class="form-group">
          @if (!Auth('customer')->check())
          <p><a style="text-decoration:none" href="{{ route('user.login') }}">Vui lòng đăng nhập tài khoản để đặt
              lịch</a> </p>
          @endif
          <i class="text-danger">Vui lòng điền đầy đủ thông tin !</i>
          <br>
          <label for="Bossname">Tên của Boss</label>
          <input type="text" class="form-control bossname" id="Bossname" name="name" placeholder="Nhập tên của boss"
            required>

        </div>
        <div class="form-group">
          <label for="Bosstype">Boss là: </label>
          <input type="text" class="form-control" id="Bosstype" required name="type" placeholder="Chó, mèo ">

        </div>
        <div class="form-group">
          <label for="Bosstype">Tên dịch vụ: </label>
          <input type="text" class="form-control" id="Bosstype" required name="dichvu"
            placeholder="Tên dịch vụ muốn đăng ký ">

        </div>
        <div class="form-group">
          <label for="Bosstype">Tên gói: </label>
          <input type="text" class="form-control" id="Bosstype" required name="goi" placeholder="Tên gói muốn đăng ký ">

        </div>
        <div class="form-group">
          <label for="Bossweight">Cân nặng(kg): </label>
          <input type="text" class="form-control" id="Bossweight" required name="weight"
            placeholder="Điền cân nặng của Boss">
        </div>
        <div class="Date">
          <p>Chọn lịch</p>
          <input name="date" class="form-control" placeholder="Nhập lịch" required type="text">
        </div>
        <div class="form-group">
          <label for="Bossweight">Ghi chú (nếu có): </label>
          <input type="text" class="form-control" id="Bossweight" name="note" style="height:100px">
        </div>
        <div class="align-items-center d-flex justify-content-center">
          <button type="submit" class="btn btn-danger mt-3 submit_booking mb-2">
            Đặt lịch
          </button>
        </div>
      </form>
    </div>
    <!-- Button trigger modal -->


    {{--
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">

            <h3>Xác nhận đặt lịch</h3>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
            <a href="index.php?controller=book&action=create&id=<?php echo $customerId ?>"> <button type="button"
                class="btn btn-success" data-bs-dismiss="modal">Đồng ý</button></a>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
  --}}

</div>
</div>


<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection