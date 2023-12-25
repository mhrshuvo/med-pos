@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>Purchase Invoice</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Purchase Invoice</a></div>
        </div>
    </div>
    @php
        $supplier = $purchase->contact;
        $paid_amount = $purchase->payment ? $purchase->payment->amount : 0;
    @endphp
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-12 d-flex justify-content-between">
                <h3>Invoice No : {{ $purchase->invoice_no }}</h3>
                <div>
                    <a href="javascript:void(0)" class="btn btn-primary downloadBtn"><i class="fas fa-print"></i> Print
                        Invoice</a>
                    @if ($purchase->payment && $purchase->payment->amount < $purchase->total_amount)
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#payment_modal"
                           class="btn btn-primary"><i class="fas fa-dollar-sign"></i> Payment</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-10" id="printableArea">
                <div class="bg-white p-3">
                    <div class="heading text-center">
                        <img src="{{ asset('uploads/image/logo.png') }}" width="250" height="58" alt="">
                        <h4 class="text-black-50 pt-4">{{ $setting->pharmacy_name }}</h4>
                        <p class="text-muted">{{ $purchase->invoice_no }}</p>
                    </div>
                    <table class="table table-borderless print_invoice">
                        <thead>
                        <tr>
                            <th class="header">BILLING FROM</th>
                            <th class="text-right header">BILLING TO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>{{ $supplier->name }}</th>
                            <th class="text-right">{{ $setting->pharmacy_name }}</th>
                        </tr>
                        <tr>
                            <td>{{ $supplier->address }}</td>
                            <td class="text-right">{{ $setting->address }}</td>
                        </tr>
                        <tr>
                            <td>{{ $supplier->email }}</td>
                            <td class="text-right">{{ $setting->email }}</td>
                        </tr>
                        <tr>
                            <td>P
                                : {{ $supplier->phone }} {{ $supplier->alternate_phone ? ','.$supplier->alternate_phone : '' }}</td>
                            <td class="text-right">P: {{ $setting->phone }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">DATE <p>{{ $purchase->date }}</p></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                        <tr class="border-bottom">
                            <th scope="col">Medicine</th>
                            <th scope="col">Price (BDT)</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal (BDT)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchase->items as $key => $item)
                            <tr>
                                <td>{{ @$item->medicine->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->sub_total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">Net Total</td>
                            <td>{{ $purchase->items->sum('sub_total') }} BDT</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Vat</td>
                            <td>{{ $purchase->vat_amount }} BDT</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Discount</td>
                            <td>{{ $purchase->discount_amount }} BDT</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Total Amount</td>
                            <td>{{ $purchase->total_amount }} BDT</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Paid Amount</td>
                            <td>{{ $paid_amount }} BDT</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Due Amount</td>
                            <td>{{ $purchase->total_amount - $paid_amount }} BDT</td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="pt-5">
                        <h6>Notes</h6>
                        {!! $purchase->notes !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payment_modal">Purchase Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('invoice.amount') }}" method="POST">@csrf
                    <div class="modal-body">
                        <h4>Paid Amount {{ $purchase->payment ? $purchase->payment->amount : 0 }} BDT</h4>

                        <input type="hidden" name="id" value="{{ $purchase->id }}">
                        <input type="hidden" name="type" value="pos">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" max="{{ $purchase->total_amount - $paid_amount }}" step="0.1" id="amount" name="amount">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        (function ($) {
            'use strict';

            $(document).ready(function () {
                $(document).on('click', '.downloadBtn', function () {
                    pdf('printableArea');
                });
            });

            function pdf(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
                setTimeout(function () {
                    window.location.reload();
                }, 15000);
            }
        })(jQuery)
    </script>
@endpush
