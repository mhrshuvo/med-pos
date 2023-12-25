@extends('backend.master')
@section('content')

    <div class="section-header">
        <h1>Purchase</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('purchase.index') }}">Purchases</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="card">
                @php
                    $route = isset($purchase) ? route('purchase.update',$purchase->id) : route('purchase.store');
                @endphp
                <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
                    @csrf
                    @isset($purchase)
                        @method('PUT')
                    @endisset
                    <div class="card-header">
                        <h4>{{ isset($purchase) ? "Edit Purchase" : 'Add Purchase' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="purchase" value="1">
                            <div class="form-group col-lg-3">
                                <label for="date">Date</label>
                                <input type="text" name="date" id="date" class="form-control datepicker">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="contact_id">Supplier <strong class="text-danger">*</strong></label>
                                <select class="form-control" name="contact_id" id="contact_id">
                                    <option value="">Select One</option>
                                    @foreach ($contacts as $contact)
                                        <option
                                            value="{{ $contact->id }}" {{ isset($purchase) && $purchase->contact_id == $contact->id ? 'selected' : ''  }}>{{ $contact->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"> {{ $errors->first('contact_id') }} </span>
                            </div>

                            <div class="form-group col-lg-3">
                                <div class="form-group">
                                    <label for="purchase_no">Purchase No. <strong class="text-danger">*</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                PO
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="purchase_no"
                                               placeholder="Purchase No" id="purchase_no"
                                               value="{{ isset($purchase) ? $purchase->purchase_no : old('purchase_no') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Purchase Medicine</h4>
                                        <div class="card-header-form">
                                            <a href="javascript:void(0)" class="btn btn-icon btn-primary add_row"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @isset($purchase)
                                            @include('purchase.edit')
                                        @else
                                            @include('purchase.create')
                                        @endisset
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <label for="notes">Details </label>
                                <textarea class="summernote" id="notes"
                                          name="notes">{!! isset($purchase) ? $purchase->notes : old('notes') !!}</textarea>
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
    @include('purchase.new_row')
@endsection
@push('js')
    @include('purchase.script')
@endpush
