@extends('website.index')
@section('content')
    <!-- Login Section Begin -->
    @if(session()->has('success'))
        <div class="alert alert-success">
            <p>{{ session()->get('success') }}</p>
        </div>
    @endif
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="section-title">
                        <h2>MY All Orders</h2>
                    </div>
                     <!-- Add Image Below the Heading -->

                    <div class="contact__form">
                        <div class="table">
                           <table class="table border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bill</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th colspan="2">View Products</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>1</td>
                                            <td>200</td>
                                            <td>adfjaldj</td>
                                            <td>aldfj</td>
                                            <td>030345767</td>
                                            <td>cancelled</td>
                                            <td>03/30</td>
                                            <td colspan="2">
                                                <button class="badge bg-primary text-white">Product</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>No record found</p>
                                    @endforelse
                                </tbody>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Section End -->
@endsection
