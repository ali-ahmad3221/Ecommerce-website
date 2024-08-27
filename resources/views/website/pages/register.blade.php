@extends('website.index')
@section('content')
    <!-- Login Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="section-title">
                        <h2>Create New Account</h2>
                    </div>
                    <div class="contact__form">
                        <form action="{{route('register.page')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Customer Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Enter Email" required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" name="file"  readonly>
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name="password" placeholder="Enter Password">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="site-btn">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Section End -->
@endsection
