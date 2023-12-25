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
                                    <th scope="col">Batch Id</th>
                                    <th scope="col">Expiry Date</th>
                                    <th scope="col">Stock</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($stocks as $key=> $stock)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ @$stock->medicine->name }}</td>
                                        <td>{{ $stock->batch_id }}</td>
                                        <td>{{ $stock->expiry_date }}</td>
                                        <td>{{ $stock->quantity }}</td>
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
