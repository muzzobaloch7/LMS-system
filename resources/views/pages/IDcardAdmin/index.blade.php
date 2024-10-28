@extends('layout.idcardadminlayout')


@section('quantity')

<div class="container mt-4">
    <div class="row justify-content-center">
        
        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('studentrecords.pending') }}" class="alert alert-warning shadow-sm d-inline-block" role="alert" style="background-color: cyan; color: black;  width: 100%; padding: 40px 20px; text-decoration: none;">
                <i class="fas fa-user-graduate" style="font-size: 2rem;"></i> 
                <div class="mt-2">Total Pending Students Record: <b>{{ $students->where('accepted', false)->count() }}</b> students</div>
            </a>
        </div>
        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('facultyrecords.pending') }}" class="alert alert-warning shadow-sm d-inline-block" role="alert" style="background-color: cyan; color: black;  width: 100%; padding: 40px 20px; text-decoration: none;">
                <i class="fas fa-chalkboard-teacher" style="font-size: 2rem;"></i> 
                <div class="mt-2">Total Pending Staff Record: <b>{{ $staff->where('accepted', false)->count() }}</b> staff members</div>
            </a>
        </div>
        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('studentrecords.accepted') }}" class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: #0b2f72; color: white;  width: 100%; padding: 40px 20px; text-decoration: none;">
                <i class="fas fa-user-graduate" style="font-size: 2rem;"></i> 
                <div class="mt-2">Total Accepted Students Record: <b>{{ $students->where('accepted',true)->count() }}</b> students</div>
            </a>
        </div>
        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('facultyrecords.accepted') }}" class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: #0b2f72; color: white;  width: 100%; padding: 40px 20px; text-decoration: none;">
                <i class="fas fa-chalkboard-teacher" style="font-size: 2rem;"></i> 
                <div class="mt-2">Total Accepted Staff Record: <b>{{ $students->where('accepted',true)->count() }}</b> staff members</div>
            </a>
        </div>
    </div>
</div>

{{-- <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('studentrecords.accepted') }}" class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: #0b2f72; color: white; width: 90%; padding: 40px 20px; text-decoration: none;">
                <i class="fas fa-user-graduate" style="font-size: 2rem;"></i>
                <div class="mt-2">Total Accepted Students Record: <b>{{ $students->where('accepted',true)->count() }}</b> students</div>
            </a>
        </div>
        <div class="col-md-6 text-center mb-3">
            <a href="{{ route('studentrecords.pending') }}" class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: cyan; color: black; width: 90%; padding: 40px 20px; text-decoration: none;">
                <i class="fas fa-user-graduate" style="font-size: 2rem;"></i>
                <div class="mt-2">Total Pending Students Record: <b>{{ $students->where('accepted',false)->count() }}</b> students</div>
            </a>
        </div>
    </div>
</div> --}}
@endsection
