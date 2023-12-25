@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>Transactions</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a
                    href="{{ route('transactions.index') }}">Transactions</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>

                                <th scope="col">Title</th>
                                <th scope="col">Income</th>
                                <th scope="col">Expense</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transactions as $key=> $item)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->type == 1 ? $item->amount : '' }}</td>
                                    <td>{{ $item->type == 0 ? $item->amount : '' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td>{{ $transactions->where('type',1)->sum('amount') }}</td>
                                <td>{{ $transactions->where('type',0)->sum('amount') }}</td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="card-footer text-right">
                        {{ $transactions->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
