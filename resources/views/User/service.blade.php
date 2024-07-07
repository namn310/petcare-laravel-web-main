@extends('User.LayoutTrangChu')

@section('content')

<!-- Dịch vụ-->
<div style="margin-top:180px">
  @foreach ($service as $row )
  <div class=" service container text-center mb-2">
    <h2>
      {{ $row->name }}
    </h2>
    <i class="fa-solid fa-heart"></i>
    <h4>Bảng giá dịch vụ</h4>
    <img class="img-fluid" src="{{ asset('assets/img-dichvu/'.$row->image) }}">
    <button type="button" class="btn btn-danger mt-3"><a style="text-decoration: none;color:white"
        href="{{ route('user.book') }}">Đăng ký ngay</a></button>
    <hr>
  </div>

  @endforeach

  
</div>
<!--hẾT DỊCH VỤ-->
<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection