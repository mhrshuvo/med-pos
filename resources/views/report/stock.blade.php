@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>POS</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('stock') }}">Stock</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Stock</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Medicine Name</th>
                                    <th scope="col">Sale Price (BDT)</th>
                                    <th scope="col">Purchase Price (BDT)</th>
                                    <th scope="col">In Qty</th>
                                    <th scope="col">Out Qty</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Stock Sale Price</th>
                                    <th scope="col">Stock Purchase Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($medicines as $key=> $medicine)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $medicine->name }}</td>
                                        <td>{{ $medicine->price }}</td>
                                        <td>{{ $medicine->purchase_price }}</td>
                                        <td>{{ $medicine->purchases->sum('quantity') }}</td>
                                        <td>{{ $medicine->invoices->sum('quantity') }}</td>
                                        <td>{{ $medicine->stocks->sum('quantity') }}</td>
                                        <td>{{ $medicine->invoices->sum('sub_total') }}</td>
                                        <td>{{ $medicine->purchases->sum('sub_total') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        (function ($) {
            'use strict';

            $(document).ready(function (){

            });
        })(jQuery);
    </script>
@endpush
