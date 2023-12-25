@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>Card</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
            <div class="breadcrumb-item">Card</div>
        </div>
    </div>
    <div class="section-body">

        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Medicine Name" name="medicine_name"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 pos_div">
                        <div class="row">

                                @foreach ($medicines as $item)
                                    <div class="col-lg-2 pos_area">
                                        <a href="javascript:void(0)" data-id="{{ $item->id }}">
                                            <div class="card pos_medicine">
                                                <img class="card-img-top" src="{{ asset($item->image) }}" width="200px"
                                                     alt="Card image cap">
                                                <div class="card-body">
                                                    <p class="card-text text-center">{{ $item->name }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                        </div>
                    </div>
                </div>
                <input type="hidden" name="purchase" value="0">
            </div>
            <div class="col-lg-6">
                @php
                $route = isset($pos) ? route('pos.update',$pos->id) : route('pos.store');
                @endphp
                <form action="{{ $route }}" method="post">@csrf
                    @isset ($pos)
                        @method('put')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="form-group w-100">
                                <select name="contact_id" id="contact_id" class="form-control">
                                    @foreach($contacts as $key=> $contact)
                                        <option value="{{ $contact->id }}" {{ isset($pos) && $pos->contact_id == $contact->id ? 'selected' : '' }}>{{ $contact->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered pos_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Medicine</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    @isset($pos)
                                        @include('pos.edit')
                                    @else
                                        @include('pos.create')
                                    @endisset
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center pb-3">
                            <a href="{{ route('pos.create') }}" class="btn btn-danger mr-2">Cancel</a>
                            <input type="submit" class="btn btn-primary mr-2" name="draft" value="Draft">
                            <a href="{{ route('pos.draft') }}" class="btn btn-warning mr-2">Draft List</a>
                            <button type="submit" class="btn btn-success">Pay Now</button>
                        </div>
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
