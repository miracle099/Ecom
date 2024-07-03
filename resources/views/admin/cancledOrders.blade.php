@extends('layout.admin')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Cancled Orders</h4>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered align-middle table-nowrap mb-0" id="customerTable">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                            <th>Payment Method</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($cancledOrders as $cancledOrder)
                                        <tr>
                                            <td>
                                                {{ $cancledOrder->name}}
                                            </td>

                                            <td>{{ $cancledOrder->email}}</td>

                                            <td>
                                                <p class="text-reset">{{ $cancledOrder->address}}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="/productFolder/{{ $cancledOrder->productImage }}" alt="" class="avatar-xxs rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">{{ $cancledOrder->productName}}</div>
                                                </div>
                                            </td>
                                            <td>{{ $cancledOrder->productQuantity}}</td>
                                            <td>{{ number_format($cancledOrder->unitPrice) }}</td>
                                            <td>{{ number_format($cancledOrder->totalPrice) }}</td>
                                            <td>{{ $cancledOrder->paymentStatus}}</td>
                                            <td>{{ $cancledOrder->created_at->format('m d, y: h:ia') }}</td>
                                            <td>
                                                <span class="badge bg-warning-subtle text-warning ">{{ $cancledOrder->deliveryStatus }}</span>
                                            </td>

                                            <td>
                                                <a href="{{ route('approvedOrder', $cancledOrder->id) }}" onclick="return confirm('Are you sure you want to Approve this order')" class="btn btn-success text-bg-light">Approve</a>
                                                <a href="{{ route('disapprovedOrder', $cancledOrder->id) }}" onclick="return confirm('Are you sure you want to DisApprove this order')" class="btn btn-danger text-bg-light">Dellete</a>
                                            </td>

                                        </tr>

                                    @endforeach
                                        <!-- end tr -->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Toner.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>


@endsection