@extends('admin.index')
@section('title', 'orders')
@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2 style="color: #4B49AC;">Orders Listing</h2>
        </div>

        <div style="overflow-x: auto;">
            <table class="table table-bordered text-center m-auto">
                <thead class="text-white fw-bold" style="background-color: #4b49ac; border:1px solid #4B49AC;">
                <tr>
                    <th>#</th>
                    <th>Customer Status</th>
                    <th>Bill</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Order Status</th>
                    <th> Order Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td id="id">{{$order?->id}}</td>
                            <td id="price">{{$order?->user_status}}</td>
                            <td id="type">{{$order?->bill}}</td>
                            <td id="cats">{{$order?->phone}}</td>
                            <td id="qty">{{$order?->address }}</td>

                            <td id="type">
                                @if ($order?->status === 'pending')
                                    <p class="text-primary">{{$order?->status}}</p>
                                @endif

                                @if ($order?->status === 'delivered')
                                    <p class="text-success">{{$order?->status}}</p>
                                @endif

                                @if ($order?->status === 'cancel')
                                    <p class="text-danger">{{$order?->status}}</p>
                                @endif
                            </td>

                            <td id="qty">{{ \Carbon\Carbon::parse($order?->created_at)->diffForHumans() }} at {{ $order?->created_at }}</td>

                            <td>
                                @if ($order->status === 'paid')
                                    <a href="{{route('change.status', ['order_id'=>$order->id,'order_status'=>'rejected'])}}" class="btn btn-danger btn-sm"> Reject </a>
                                    <a href="{{route('change.status', ['order_id'=>$order->id,'order_status'=>'accepted'])}}" class="btn btn-success btn-sm"> Accept </a>
                                @elseif ($order->status === 'accepted')
                                    <a href="{{route('change.status', ['order_id'=>$order->id,'order_status'=>'delivered'])}}" class="btn btn-success btn-sm"> Delivered </a>
                                @elseif ($order->status === 'delivered')
                                    <p class="btn btn-success btn-sm">Already Delivered </a>
                                @else
                                    <a href="{{route('change.status', ['order_id'=>$order->id,'order_status'=>'accepted'])}}" class="btn btn-primary btn-sm"> Accept </a>
                                @endif
                                <a class="badge badge-info badge-sm" data-toggle="modal" data-target="#viewProductModal" onclick="openViewProductModal(this)">
                                    <i class="fas">Order Detail</i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>No record found</p>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- View Product Modal -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel" style="color: #4B49AC;">Order Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card" style="max-width: 540px; margin: auto;">
                            <div class="row no-gutters">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                    </thead>
                                    <tbody id="orderDetailsTable">
                                        <tr>
                                            <td>1</td>
                                            <td>ajdfadl</td>
                                            <td>ajldfjald</td>
                                            <td>200</td>
                                            <td>20</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>ajdfadl</td>
                                            <td>ajldfjald</td>
                                            <td>200</td>
                                            <td>20</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>ajdfadl</td>
                                            <td>ajldfjald</td>
                                            <td>200</td>
                                            <td>20</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openViewProductModal(el) {
            let orderId = $(el).closest('tr').find('#id').text();

            $.ajax({
                url: 'order-details/' + orderId,
                method: 'Get',
                success: function(response){
                    $('#orderDetailsTable').empty();
                    if(response.orderDetails.length > 0){
                        $.each(response.orderDetails, function(index, detail){
                            $('#orderDetailsTable').append(`<tr><td>${index + 1}</td>
                                <td>${detail.title}</td> <td><img src="{{asset('uploads/products/')}}/${detail.picture}" alt="Product Image" width="50"></td>
                                <td>${detail.price}</td>
                                <td>${detail.qty}</td>
                                </tr>`);
                        })
                    }else{
                        $('#orderDetailsTable').append('<tr><td>No record found</td></tr>')
                    }
                },
                error: function(error){
                    console.error(error);
                    alert(error);
                }
            });
        }
    </script>

@endsection
