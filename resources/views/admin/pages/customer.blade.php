@extends('admin.index')
@section('title', 'customers')
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2 style="color: #4B49AC;">Customer Listing</h2>
            {{-- <button class="btn text-white" style="background-color: #4B49AC;" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-plus"></i> Add Product
            </button> --}}
        </div>

        <table class="table table-bordered text-center">
            <thead class="text-white fw-bold" style="background-color: #4b49ac; border:1px solid #4B49AC;">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Picture</th>
                <th>Status</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td id="id">{{$customer?->id}}</td>
                        <td id="title">{{$customer?->name}}</td>
                        <td id="title">{{$customer?->email}}</td>
                        <td id="pic"><img src="{{asset('uploads/profiles/'.$customer->picture)}}" alt="product picture" srcset=""></td>
                        <td id="cats">{{$customer?->status}}</td>
                        <td id="type">{{$customer?->type}}</td>
                        <td>
                            @if($customer?->status != 'active')
                                <a href="{{route('customer.status', ['customer_id'=>$customer->id, 'status'=>'active'])}}" class="badge badge-success border border-success">Block</a>
                            @endif

                            @if($customer?->status != 'inactive')
                                <a href="{{route('customer.status', ['customer_id'=>$customer->id, 'status'=>'inactive'])}}" class="badge badge-danger border border-danger">Unblock</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <p>No record found</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
