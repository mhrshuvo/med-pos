@extends('backend.master')
@section('content')

    <div class="section-header">
        <h1>Pharmacist</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Pharmacists</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="card">
                @php
                    $route = isset($user) ? route('users.update',$user->id) : route('users.store');
                @endphp
                <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
                    @csrf
                    @isset($user)
                        @method('PUT')
                    @endisset
                    <div class="card-header">
                        <h4>{{ isset($user) ? "Edit Pharmacist" : 'Add Pharmacist' }}</h4>
                    </div>
                    <input type="hidden" name="role_id" value="2">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="name">Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="name"
                                       placeholder="Name" id="name"
                                       value="{{ isset($user) ? $user->name : old('name') }}">
                                <span class="text-danger"> {{ $errors->first('name') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="email">Email <strong class="text-danger">*</strong></label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Email"
                                       value="{{ isset($user) ? $user->email : old('email') }}">
                                <span class="text-danger"> {{ $errors->first('email') }} </span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="username">Username <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="username" id="username"
                                       placeholder="Email"
                                       value="{{ isset($user) ? $user->username : old('username') }}">
                                <span class="text-danger"> {{ $errors->first('username') }} </span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="password">Password <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Password">
                                <span class="text-danger"> {{ $errors->first('password') }} </span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="password_confirmation">Password Confirmation <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                       placeholder="Confirm Password">
                                <span class="text-danger"> {{ $errors->first('password') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="phone">Phone <strong class="text-danger">*</strong></label>
                                <input type="tel" class="form-control" name="phone" id="phone"
                                       placeholder="Phone"
                                       value="{{ isset($user) ? $user->phone : old('phone') }}">
                                <span class="text-danger"> {{ $errors->first('phone') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                                <span class="text-danger"> {{ $errors->first('image') }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
