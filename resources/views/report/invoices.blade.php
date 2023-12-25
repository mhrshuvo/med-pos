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
                                    <th scope="col">Invoice No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Total Amount (BDT)</th>
                                    <th scope="col">Discount (BDt)</th>
                                    <th scope="col">Vat (BDT)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($invoices as $key=> $invoice)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><a href="{{ route('pos.show',$invoice->id) }}" target="_blank">{{ $invoice->invoice_no }}</a></td>
                                        <td>{{ @$invoice->contact->name }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->total_quantity }}</td>
                                        <td>{{ $invoice->total_amount }}</td>
                                        <td>{{ $invoice->discount_amount }}</td>
                                        <td>{{ $invoice->vat_amount }}</td>
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
@endpush
