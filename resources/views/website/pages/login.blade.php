@extends('website.index')
@section('content')
    <!-- Login Section Begin -->
    <section class="contact spad">
        <div class="container">
            {{-- @if(session()->has('success'))
                <div class="alert alert-success">
                    <p>{{ session()->get('success') }}</p>
                </div>
            @endif --}}
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="section-title">
                        <h2>Login Your Account</h2>
                    </div>
                    <div class="contact__form">
                        <form action="{{route('login.user')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="email" name="email" placeholder="Enter Email" required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name="password" placeholder="Enter Password">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="site-btn">Login</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ url('auth/google') }}" class="text-white rounded-md">
                            <img  src="{{asset('assets/img/google.png')}}" alt="" srcset="" height="50">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Section End -->
@endsection
