@extends('User.LayoutTrangChu')
@section('content')
<style>
    .order {
        flex: 1;
    }

    .booking {
        flex: 1;
    }

    @media screen and (max-width: 860px) {
        .orderUser {
            margin-top: 200px;
        }
    }
</style>
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
<div class="orderUser container d-flex flex-wrap" style="margin-top:180px">
    <div class="order me-2">
        <div class="text-center">
                <button type="button" class="btn btn-white position-relative">
                   <h3 class="text-center">Đơn hàng của bạn <span><i class="fa-solid fa-basket-shopping"
                                style="color: #ea1010;"></i></span></h3>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $OrderCount }}
                    </span>
                </button>
            </div>
        <hr>
        <div class="orderList d-flex flex-column" style="border-radius:5px">
            @foreach ( $Order as $order )
            <div class="orderItem đ-flex mb-4"
                style="background-color:white;border-radius:10px;box-shadow:2px 8px 0px #DCDCDC">
                @foreach ( $order->getOrderDetail($order->id) as $row )

                {{-- img producy --}}
                <div class="img-item d-flex p-2">
                    <img class="img-fluid" style="max-width:150px"
                        src="{{ asset('assets/img-add-pro/'.$row->getImgProduct($row->idPro)) }}">
                    {{-- product detail --}}
                    <div class="ms-2 text-wrapped">
                        <p style="font-weight:bolder">{{ $row->getProductName($row->idPro) }}</p>
                        <p class="text-end">x{{ $row->number }}</p>
                        @if ($row->getProductDiscount($row->idPro) !== '')
                        <span>
                            <p class="text-end"><span class="text-decoration-line-through">{{ number_format($row->price)
                                    }}</span><span class="text-danger ms-2">{{ number_format((
                                    ($row->price - ($row->price *
                                    ($row->getProductDiscount($row->idPro) / 100))))) }}</span></p>
                        </span>
                        @else
                        <p class="text-end"><span class="text-danger">{{ number_format($row->price)
                                }}</span>
                            @endif

                        <p class="text-end"><i class="fa-solid fa-shield-halved me-2" style="color: #fb183a;"></i>Thành
                            tiền: <span class="text-danger">{{ number_format(($row->number * ($row->price - ($row->price
                                *
                                ($row->getProductDiscount($row->idPro) / 100))))) }}đ</span> </p>
                        <p class="text-end"> <i class="fa-solid fa-bag-shopping text-danger"></i> Phương thức thanh
                            toán: <span style="font-weight:bold"> {{ $order->thanhtoan }}</span> </p>
                    </div>
                </div>
                <hr>
                @endforeach
                @if ($order->status==0)
                <div class="text-start"><button class="btn btn-danger m-2">Chờ xác nhận</button> </div>
                @else
                <div class="text-start"><button class="btn btn-success m-2">Đơn hàng đang được giao</button> </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="booking" style="margin-left: 80px">
        <div class="text-center">
            <button type="button" class="btn btn-white position-relative">
                <h3 class="text-center">Lịch hẹn của bạn <i class="fa-solid fa-calendar-days text-primary"></i></h3>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $bookingCount }}
                </span>
            </button>
        </div>
        @if ($bookingCount>0)

        @foreach ($bookingForm as $book )
        <div style="border:1px solid black" class="mb-3">
            <p style="font-weight:bolder" class="text-start mt-3 ms-3"> ID Lịch hẹn: {{ $book->id }}</p>
            <p style="font-weight:bolder" class="text-start mt-3 ms-3"> Thời gian tạo: {{ $book->created_at }}</p>
            <div class=" align-items-center d-flex justify-content-center ms-3 me-3">
                <form style="width:100%" method="post" class="align-items-center"
                    action="{{ route('user.updateBooking',['id'=>$book->id]) }}" name=" booking_form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <br>
                        <label for="Bossname">Tên của Boss</label>
                        <input type="text" class="form-control bossname" value="{{ $book->name }}" id="Bossname"
                            name="name" placeholder="Nhập tên của boss" required>
                    </div>
                    <div class="form-group">
                        <label for="Bosstype">Boss là: </label>
                        <input type="text" class="form-control" id="Bosstype" required name="type"
                            value="{{ $book->type }}" placeholder="Chó, mèo ">

                    </div>
                    <div class="form-group">
                        <label for="Bosstype">Tên dịch vụ: </label>
                        <input type="text" class="form-control" id="Bosstype" value="{{ $book->name_service }}" required
                            name="dichvu" placeholder="Tên dịch vụ muốn đăng ký ">

                    </div>
                    <div class="form-group">
                        <label for="Bosstype">Tên gói: </label>
                        <input type="text" class="form-control" id="Bosstype" value="{{ $book->goi }}" required
                            name="goi" placeholder="Tên gói muốn đăng ký ">

                    </div>
                    <div class="form-group">
                        <label for="Bossweight">Cân nặng(kg): </label>
                        <input type="text" class="form-control" id="Bossweight" value="{{ $book->weight }}" required
                            name="weight" placeholder="Điền cân nặng của Boss">
                    </div>
                    <div class="Date">
                        <p>Chọn lịch</p>
                        <input name="date" class="form-control" placeholder="Nhập lịch" value="{{ $book->date }}"
                            required type="text">
                    </div>
                    <div class="form-group">
                        <label for="Bossweight">Ghi chú (nếu có): </label>
                        <input type="text" class="form-control" id="Bossweight" value="{{ $book->note }}" name="note"
                            style="height:100px">
                    </div>
                    @if ($book->status>0)
                    <button class="btn btn-success mt-3 mb-2">Cửa hàng đã xác nhận lịch hẹn của bạn !</button>
                    @else
                    <div class="align-items-center d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mt-3 submit_booking mb-2">
                            Chỉnh sửa
                        </button>
                        {{-- cancel --}}
                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete-book{{ $book->id }}"
                            class="btn btn-danger mt-3 submit_booking mb-2 ms-2">
                            Hủy lịch hẹn
                        </button>
                        <!-- Modal xóa -->
                        <div class="modal fade" id="delete-book{{ $book->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có muốn hủy lịch hẹn không ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary"> @csrf<a
                                                href="{{ route('user.destroyBook',['id'=>$book->id]) }}"
                                                style="text-decoration:none;color:white">Đồng
                                                ý</a></button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                </form>
            </div>
        </div>
        @endforeach
        @else
        <p class="ms-3 mt-3">Hiện tại bạn chưa có lịch hẹn nào.<a style="text-decoration:none"
                href="{{ route('user.book') }}">Đăng ký lịch hẹn để có được trải nghiệm tốt nhất</a></p>
        @endif
    </div>
</div>
@endsection