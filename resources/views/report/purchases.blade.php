@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>Purchase</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Purchase Report</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Purchase Report</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Purchase No</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Total Amount (BDT)</th>
                                    <th scope="col">Discount (BDt)</th>
                                    <th scope="col">Vat (BDT)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($purchases as $key=> $purchase)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><a href="{{ route('purchase.show',$purchase->id) }}" target="_blank">PO - {{ $purchase->purchase_no }}</a></td>
                                        <td>{{ @$purchase->contact->name }}</td>
                                        <td>{{ $purchase->date }}</td>
                                        <td>{{ $purchase->total_quantity }}</td>
                                        <td>{{ $purchase->total_amount }}</td>
                                        <td>{{ $purchase->discount_amount }}</td>
                                        <td>{{ $purchase->vat_amount }}</td>
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
