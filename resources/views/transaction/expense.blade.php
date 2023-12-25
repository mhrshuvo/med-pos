@extends('backend.master')
@section('content')
    <!-- Main Content -->

    <div class="section-header">
        <h1>Expense</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a
                    href="{{ route('expense.index') }}">Expense</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-4">
                @include('transaction.form')
            </div>
            <div class="col-lg-8">
                @include('transaction.table')
            </div>
        </div>
    </div>


@endsection
