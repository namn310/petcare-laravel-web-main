@extends('Admin.Layout')
@section('content')
<div class="pagetitle">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="font-size: 22px;">
            <li class="breadcrumb-item"><a href="{{ route('admin.order') }}">Danh sách đơn hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Xem chi tiết</li>
        </ol>
    </nav>

</div><!-- End Page Title -->
<div class="container-fluid border border-primary rounded">
    @foreach ($Order as $order )
    <div class="p-4">
        <div class="name d-inline-block">
            <span>
                <p>Họ và tên: <b>{{ $order->getCus($order->idCus) }} </b></p>
            </span>
        </div>
        <div class="local ">
            <span>
                <p>Địa chỉ: <b>{{ $order->address }}</b></p>
            </span>
        </div>
        <div class="phone mt-4">
            <span>
                <p>Số điện thoại: <b> {{ $order->getPhone($order->idCus) }}</b></p>
            </span>
        </div>
        <div class="date mt-4">
            <span>
                <p>Ngày đặt: <b>{{ $order->created_at }}</b></p>
            </span>
        </div>
        <div class="local mt-4">
            <span>
                <p>Trạng thái </p>
                @if ($order->status >0)
                <button class="btn btn-success">Đã giao hàng</button>
                @else
                <button class="btn btn-danger">Chưa giao hàng</button>
                @endif




            </span>
        </div>
        <div class="order-detail mt-4">
            <table class="table table-bordered table-hover text-center">
                <tr>
                    <th style="width: 100px;">Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Giảm giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>

                </tr>
                @foreach ($OrderDetail as $row )
                <tr>
                    <td>
                        <img class="img-fluid" src="{{ asset('assets/img-add-pro/'.$row->getImgProduct($row->idPro)) }}"
                            style="">
                    </td>
                    <td>
                        {{ $row->getProductName($row->idPro) }}
                    </td>
                    <td>
                        {{ $row->price }}
                    </td>

                    <td>
                        {{ $row->getProductDiscount($row->idPro) }}%
                    </td>

                    <td>{{ $row->number }} </td>

                    @if ($row->getProductDiscount($row->idPro)>0)
                    <td>
                        {{ number_format(($row->number * ($row->price - ($row->price *
                        ($row->getProductDiscount($row->idPro) / 100))))) }}đ
                    </td>
                    @else
                    <td>
                        {{ number_format($row->number * $row->price) }}đ
                    </td>
                    @endif
                </tr>
                @endforeach

            </table>
        </div>
        <h4 class="text-end text-danger"><b>Tổng tiền: {{ number_format( $totalPrice) }}đ</b></h4>
    </div>
    @endforeach
</div>


<!-- ======= Footer ======= -->

@endsection