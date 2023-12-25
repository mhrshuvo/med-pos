@extends('backend.master')
@section('content')

    <div class="section-header">
        <h1>Medicine</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('medicines.index') }}">Medicine</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="card">
                @php
                    $route = isset($medicine) ? route('medicines.update',$medicine->id) : route('medicines.store');
                @endphp
                <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
                    @csrf
                    @isset($medicine)
                        @method('PUT')
                    @endisset
                    <div class="card-header">
                        <h4>{{ isset($medicine) ? "Edit Medicine" : 'Add Medicine' }}</h4>
                    </div>
                    <input type="hidden" name="contact_type" value="1">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="name">Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="name"
                                       placeholder="Name" id="name"
                                       value="{{ isset($medicine) ? $medicine->name : old('name') }}">
                                <span class="text-danger"> {{ $errors->first('name') }} </span>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="generic_name">Generic Name </label>
                                <input type="text" class="form-control" name="generic_name"
                                       placeholder="Name" id="generic_name"
                                       value="{{ isset($medicine) ? $medicine->generic_name : old('generic_name') }}">
                                <span class="text-danger"> {{ $errors->first('generic_name') }} </span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="category_id">Category <strong class="text-danger">*</strong></label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">Select One</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($medicine) && $medicine->category_id == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"> {{ $errors->first('category_id') }} </span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="type_id">Type <strong class="text-danger">*</strong></label>
                                <select class="form-control" name="type_id" id="type_id">
                                    <option value="">Select One</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ isset($medicine) && $medicine->type_id == $type->id ? 'selected' : ''  }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"> {{ $errors->first('type_id') }} </span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="unit_id">Unit <strong class="text-danger">*</strong></label>
                                <select class="form-control" name="unit_id" id="unit_id">
                                    <option value="">Select One</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" {{ isset($medicine) && $medicine->unit_id == $unit->id ? 'selected' : ''  }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"> {{ $errors->first('unit_id') }} </span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="price">Price <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="price"
                                       placeholder="Price" id="price"
                                       value="{{ isset($medicine) ? $medicine->price : old('price') }}">
                                <span class="text-danger"> {{ $errors->first('price') }} </span>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="purchase_price">Purchase Price <strong
                                        class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="purchase_price"
                                       placeholder="Purchase Price" id="purchase_price"
                                       value="{{ isset($medicine) ? $medicine->purchase_price : old('purchase_price') }}">
                                <span class="text-danger"> {{ $errors->first('purchase_price') }} </span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                                <span class="text-danger"> {{ $errors->first('image') }} </span>
                            </div>

                            <div class="col-lg-12">
                                <label for="details">Details </label>
                                <textarea class="summernote" id="details"
                                          name="details">{{ isset($medicine) ? $medicine->details : old('details') }}</textarea>
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
