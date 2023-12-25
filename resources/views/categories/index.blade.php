@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>Categories</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a
                    href="{{ route('categories.index') }}">Category</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-4">
                @include('categories.form')
            </div>
            <div class="col-lg-8">
                @include('categories.table')
            </div>
        </div>
    </div>
@endsection
