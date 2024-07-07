@extends('Admin.Layout')
@section('content')
<div class="pagetitle">
  <h1>Trang chủ</h1>
  <!-- End Page Title -->
  @if (session('alert'))
  <script>
    $.toast({
                            heading: 'Thông báo',
                            text: '{{ session('alert') }}',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-center'
                            })
  </script>
  @endif
  <div class="main-content mt-4">
    <div class=" d-flex flex-wrap justify-content-around">

      <div class="widget d-flex mb-4"
        style="min-width:200px;min-height:50px;background-color: #FFFFFF;padding:10px;border-radius:10px;box-shadow: 2px 2px 2px blue">
        <div class="widget-icon me-2" style="width:50px">
          <i class="fa-solid fa-clipboard-user fa-2xl"></i>
        </div>
        <div class="widget-status">
          <h4 class="text-danger">Tổng khách hàng</h4>
          <p><b>{{ $CustomerTotal }} khách hàng</b></p>
          <p class="info-tong">Tổng số khách hàng được quản lý.</p>
        </div>
      </div>
      <div class="widget d-flex mb-4"
        style="min-width:200px;min-height:50px;background-color: #FFFFFF;padding:10px;border-radius:10px;box-shadow: 2px 2px 2px blue">
        <div class="widget-icon me-2" style="width:50px">
          <i class="fa-brands fa-product-hunt fa-2xl" style="color: #c1e65b;"></i>
        </div>
        <div class="widget-status">
          <h4 class="text-danger">Tổng sản phẩm</h4>
          <p><b>{{ $productTotal }} sản phẩm</b></p>
          <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
        </div>
      </div>
      <div class="widget d-flex mb-4"
        style="min-width:200px;min-height:50px;background-color: #FFFFFF;padding:10px;border-radius:10px;box-shadow: 2px 2px 2px blue">
        <div class="widget-icon me-2" style="width:50px">
          <i class="fa-solid fa-basket-shopping fa-2xl" style="color: #df3826;"></i>
        </div>
        <div class="widget-status">
          <h4 class="text-danger">Tổng đơn hàng</h4>
          <p><b> {{ $orderTotal }} đơn hàng</b></p>
        </div>
      </div>
      <div class="widget d-flex "
        style="min-width:200px;min-height:50px;background-color: #FFFFFF;padding:10px;border-radius:10px;box-shadow: 2px 2px 2px blue">
        <div class="widget-icon me-2" style="width:50px">
          <i class="fa-solid fa-house-crack fa-2xl" style="color: #f31616;"></i>
        </div>
        <div class="widget-status">
          <h4 class="text-danger">Sắp hết hàng</h4>
          <p><b>{{ $productOutTotal }} Sản phẩm</b></p>
          <p class="info-tong">Số sản phẩm cần nhập thêm.</p>
        </div>
      </div>

    </div>

    <div class="chart mt-5">
      <h3 class="mb-3 text-center">Thống kê doanh thu</h3>

      <canvas id="plots" style="width:100%;max-width:1000px"></canvas>
    </div>

  </div>

</div>

<style>
  #plots {
    margin: auto;
    background-color: #FFFFFF;
    box-shadow: 3px 3px 3px black;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  plots = document.getElementById("plots");

  var months = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"];
  var traffic = [65, 59, 80, 81, 56, 55, 60, "Triệu VNĐ"] //Stays on the Y-axis 
  new Chart(plots, {
    type: 'line',

    data: {
      labels: months,

      datasets: [{
        data: traffic,
        backgroundColor: '#FFFFFF',
        borderColor: 'black',

      }]
    },
  });
</script>
@endsection