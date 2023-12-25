@extends('backend.master')
@section('content')

    <div class="section-header">
        <h1>Contact</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('contacts.index') }}">Contact</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="card">
                @php
                    $route = isset($contact) ? route('contacts.update',$contact->id) : route('contacts.store');
                @endphp
                <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
                    @csrf
                    @isset($contact)
                        @method('PUT')
                    @endisset
                    <div class="card-header">
                        <h4>{{ isset($contact) ? "Edit Contact" : 'Add Contact' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-lg-4">
                                <label for="name">Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="name"
                                       placeholder="Name" id="name"
                                       value="{{ isset($contact) ? $contact->name : old('name') }}">
                                <span class="text-danger"> {{ $errors->first('name') }} </span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="contact_type">Contact Type <strong class="text-danger">*</strong></label>
                                <select class="form-control" name="contact_type" id="contact_type">
                                    <option value="1">Customer</option>
                                    <option value="0">Supplier</option>
                                </select>
                                <span class="text-danger"> {{ $errors->first('contact_type') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Email"
                                       value="{{ isset($contact) ? $contact->email : old('email') }}">
                                <span class="text-danger"> {{ $errors->first('email') }} </span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="phone">Phone <strong class="text-danger">*</strong></label>
                                <input type="tel" class="form-control" name="phone" id="phone"
                                       placeholder="Phone"
                                       value="{{ isset($contact) ? $contact->phone : old('phone') }}">
                                <span class="text-danger"> {{ $errors->first('phone') }} </span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="alternate_phone">Alternative Phone</label>
                                <input type="tel" class="form-control" name="alternate_phone" id="alternate_phone"
                                       placeholder="Alternative Phone"
                                       value="{{ isset($contact) ? $contact->phone : old('alternate_phone') }}">
                                <span class="text-danger"> {{ $errors->first('alternate_phone') }} </span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                                <span class="text-danger"> {{ $errors->first('image') }} </span>
                            </div>

                                <div class="form-group col-lg-12">
                                    <label for="address">Address </label>
                                    <input type="text" class="form-control" name="address"
                                           placeholder="Address" id="address"
                                           value="{{ isset($contact) ? $contact->address : old('address') }}">
                                    <span class="text-danger"> {{ $errors->first('address') }} </span>
                                </div>

                            <div class="col-lg-12">
                                <label for="note">Notes </label>
                                <textarea class="summernote" id="note"
                                          name="note">{{ isset($contact) ? $contact->note : old('note') }}</textarea>
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
