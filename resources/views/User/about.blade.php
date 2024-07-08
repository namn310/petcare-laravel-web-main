@extends('User.LayoutTrangChu')
@section('content')
<div class="contentabout">

  <div class="service text-center text-capitalize">
    <h3>GIỚI THIỆU</h3>
    <i class="fa-solid fa-heart"></i>
    <p>PET LIKE US AND SO WILL YOU</p>

  </div>
  <div class="about container d-flex justify-content-around mt-3">
    <div class="about-left d-flex flex-column justify-content-between">
      <div class="about-left-1 text-right">
        <span>
          <h3>Cung Cấp Sản Phẩm Với Mức Giá Phải Chăng <i class="fa-brands fa-shopify" style="color:red"></i></h3>
          <p>Ngoài các yếu tố về chất lượng sản phẩm, cửa hàng uy tín, chuyên nghiệp cần mang đến sản phẩm với mức giá
            cả
            phải chăng</p>
        </span>
      </div>
      <div class="about-left-2 text-right">
        <span>
          <h3>Nhân Viên Tư Vấn Nhiệt Tình, Am Hiểu Về Thú Cưng <i class="fa-brands fa-shopify" style="color:red"></i>
          </h3>
          <p>Bên cạnh các sản phẩm chất lượng, nhân viên của cửa hàng cũng có trình độ chuyên nghiệp về chuyên môn cũng
            như trong quá trình phục vụ khách hàng</p>
        </span>
      </div>
    </div>
    <div>
      <span><img class="img-fluid rounded-circle" src="{{ asset('assets/img/img-about.jpg') }}"></span>
    </div>
    <div class="about-right d-flex flex-column justify-content-between">
      <div class="about-right-1 text-left">
        <span>
          <h3>Cung Cấp Sản Phẩm Chất Lượng <i class="fa-brands fa-shopify" style="color:red"></i></h3>
          <p>Một trong những tiêu chí quan trọng của cửa hàng là mang đến những sản phẩm uy tín chất lượng đến khách
            hàng
          </p>
        </span>
      </div>
      <div class="about-right-2 text-left">
        <span>
          <h3>Cung Cấp Sản Phẩm Đa Dạng, Phong Phú <i class="fa-brands fa-shopify" style="color:red"></i></h3>
          <p>Mỗi loại thú cưng đều có nét riêng biệt của chúng nên cửa hàng chúng tôi có đầy đủ các mặt hàng để đáp ứng
            nhu cầu của từng loại thú cưng</p>
        </span>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection