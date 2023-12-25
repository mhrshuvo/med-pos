@extends('backend.master')
@section('content')
    <div class="section-header">
        <h1>Contact</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a
                    href="{{ route('contacts.create') }}">Contact Create</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                @include('contacts.table')
            </div>
        </div>
    </div>
@endsection
