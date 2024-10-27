@extends('layout.adminpanellayout')
@section('title')
    Admin Panel
@endsection


@section('buttons')
<div class="container shadow-sm p-3" style="margin:70px 0 0 0">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin-panel.it-services') }}" class="btn btn-primary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">
                            <i class="fas fa-user-cog"></i> IT Services Records  
                        </a>
                        <a href="{{ route('admin-panel.id-card-services') }}" class="btn btn-secondary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">
                            <i class="fas fa-id-card"></i> Id Card Records  
                        </a>
                        <a href="{{ route('result-admin.index')}}" class="btn btn-info mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">
                            <i class="fas fa-graduation-cap"></i> Student Result  
                        </a>
                    </div>
                </div>
@endsection

@section('quantity')
<div class="container shadow-sm my-4 p-3">
    <div class="row" style="row-gap: 20px;">
        <div class="col-md-6">
            <div class="card border-0 shadow h-100">
                <div class="card-header" style="background-color: #0b2f72; color: white;">
                    <i class="fas fa-user-graduate"></i> Student IT Services Form Records
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Students IT Services Record</h5>
                    <p class="card-text">{{ $students->count() }} Students Form</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow h-100">
                <div class="card-header" style="background-color: #0b2f72; color: white;">
                    <i class="fas fa-chalkboard-teacher"></i> Staff IT Services Form Records
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Staff IT Services Record</h5>
                    <p class="card-text">{{ $facultys->count() }} Staff members Form</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow h-100">
                <div class="card-header" style="background-color: #0b2f72; color: white;">
                    <i class="fas fa-id-card"></i> Student ID Card Form Records
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Students Record</h5>
                    <p class="card-text">{{ $student->count() }} Student ID Card Form</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow h-100">
                <div class="card-header" style="background-color: #0b2f72; color: white;">
                    <i class="fas fa-id-card"></i> Staff ID Card Form Records
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Staff Record</h5>
                    <p class="card-text">{{ $staff->count() }} Staff ID Card Form</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
