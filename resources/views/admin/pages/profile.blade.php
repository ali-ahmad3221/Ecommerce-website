@extends('admin.index')
@section('title', 'admin profile')
@section('content')
    <!-- Login Section Begin -->
    <style>
        .color{
            color: #4b49ac;
        }
    </style>
    @if(session()->has('success'))
        <div class="alert alert-success">
            <p>{{ session()->get('success') }}</p>
        </div>
    @endif
    <section class="contact spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 mt-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            {{-- <div class="section-title text-center mb-4">
                                <h2 class="color">Update Account</h2>
                            </div> --}}

                            <!-- Profile Image -->
                            <div class="text-center my-4">
                                <img src="{{ asset('uploads/profiles/' . $user->picture) }}" alt="Account Image" class="img-fluid rounded-circle shadow" width="120">
                            </div>

                            <!-- Form Container -->
                            <div class="contact__form p-3">
                                <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Name Input -->
                                        <div class="col-lg-6 form-group">
                                            <label for="name" class="color">Name</label>
                                            <input type="text" class="form-control " name="name" value="{{ $user->name }}" required>
                                        </div>

                                        <!-- Email Input -->
                                        <div class="col-lg-6 form-group">
                                            <label for="email" class="color">Email</label>
                                            <input type="email" class="form-control color" name="email" value="{{ $user->email }}" readonly>
                                        </div>

                                        <!-- Profile Picture Upload -->
                                        <div class="col-lg-12 form-group">
                                            <label for="file" class="color">Profile Picture</label>
                                            <input type="file" class="form-control" name="file">
                                        </div>

                                        <!-- Password Input -->
                                        <div class="col-lg-12 form-group">
                                            <label for="password" class="color">Password</label>
                                            <input type="password" class="form-control color" name="password" value="">
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn site-btn text-white" style="background-color: #4b49ac;">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- login Section End -->
@endsection
