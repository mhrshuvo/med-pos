@extends('backend.master')
@section('content')

    <div class="section-header">
        <h1>Setting</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('setting.index') }}">Contact</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="card">
                <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header">
                        <h4>Setting</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-lg-4">
                                <label for="site_tile">Site Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="site_tile"
                                       placeholder="Site Name" id="site_tile"
                                       value="{{ isset($setting) ? $setting->site_tile : old('site_tile') }}">
                                <span class="text-danger"> {{ $errors->first('site_tile') }} </span>
                            </div>


                            <div class="form-group col-lg-4">
                                <label for="pharmacy_name">Pharmacy Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="pharmacy_name" id="pharmacy_name"
                                       placeholder="Pharmacy Name"
                                       value="{{ isset($setting) ? $setting->pharmacy_name : old('pharmacy_name') }}">
                                <span class="text-danger"> {{ $errors->first('pharmacy_name') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Email"
                                       value="{{ isset($setting) ? $setting->email : old('email') }}">
                                <span class="text-danger"> {{ $errors->first('email') }} </span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="phone">Phone <strong class="text-danger">*</strong></label>
                                <input type="tel" class="form-control" name="phone" id="phone"
                                       placeholder="Phone"
                                       value="{{ isset($setting) ? $setting->phone : old('phone') }}">
                                <span class="text-danger"> {{ $errors->first('phone') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Logo</label>
                                <input type="file" class="form-control" name="logo">
                                <span class="text-danger"> {{ $errors->first('logo') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Favicon</label>
                                <input type="file" class="form-control" name="favicon">
                                <span class="text-danger"> {{ $errors->first('favicon') }} </span>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="address">Address </label>
                                <input type="text" class="form-control" name="address"
                                       placeholder="Address" id="address"
                                       value="{{ isset($setting) ? $setting->address : old('address') }}">
                                <span class="text-danger"> {{ $errors->first('address') }} </span>
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
