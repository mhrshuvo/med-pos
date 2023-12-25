@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>Types</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a
                    href="{{ route('types.index') }}">Type</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-4">
                @include('types.form')
            </div>
            <div class="col-lg-8">
                @include('types.table')
            </div>
        </div>
    </div>
@endsection
