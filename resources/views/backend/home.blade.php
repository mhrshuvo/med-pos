@extends('backend.master')
@section('content')
    <div class="row">
        @if (auth()->user()->role_id == 1)
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pharmacists</h4>
                        </div>
                        <div class="card-body">
                            {{ $pharmacists }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-laptop-medical"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Medicines</h4>
                    </div>
                    <div class="card-body">
                        {{ $medicines }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Suppliers</h4>
                    </div>
                    <div class="card-body">
                        {{ $suppliers }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Customers</h4>
                    </div>
                    <div class="card-body">
                        {{ $customers }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-battery-quarter"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Purchase (Quantity)</h4>
                    </div>
                    <div class="card-body">
                        {{ $purchases->sum('total_quantity') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-battery-quarter"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Sale (Quantity)</h4>
                    </div>
                    <div class="card-body">
                        {{ $invoices->sum('total_quantity') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Purchase</h4>
                    </div>
                    <div class="card-body">
                        {{ $purchases->sum('total_amount') }} BDT
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Sale (Quantity)</h4>
                    </div>
                    <div class="card-body">
                        {{ $invoices->sum('total_amount') }} BDT
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user()->role_id == 1)
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Income</h4>
                        </div>
                        <div class="card-body">
                            {{ $income }} BDT
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Expense</h4>
                        </div>
                        <div class="card-body">
                            {{ $expense }} BDT
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Profit</h4>
                        </div>
                        <div class="card-body">
                            {{ $income - $expense }} BDT
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
