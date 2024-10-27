@extends('layout.itadminlayout')

@section('main-title')
    Staff Records
@endsection

@section('title')
Staff Records
@endsection
@section('quantity')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <div class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: #0b2f72; color: white; margin-right: 10px;">
                <i class="fas fa-chalkboard-teacher"></i> Total Staff Record: {{ $facultys->count() }} staff members
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

    <h1 style="text-align: center">Record Of Faculty</h1>

    <!-- Search Form -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('faculty-it-services.search') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search faculty records..." aria-label="Search faculty records" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Faculty ID</th>
                    <th>Faculty Name</th>
                    <th>Faculty Designation</th>
                    <th>Faculty Department</th>
                    <th>Faculty Status</th>
                    <th>Faculty ID No</th>
                    <th>Faculty Gender</th>
                    <th>Faculty Email</th>
                    <th>Faculty Contact No</th>
                    <th>Hostel Name</th>
                    <th>Floor No</th>
                    <th>Room No</th>
                    <th>IT Services</th>
                    <th>Accepted</th>
                    <th>Submission Time</th>
                    <th>View faculty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facultys as $faculty)
                <tr>
                    <td>{{ $faculty->id }}</td>
                    <td>{{ $faculty->faculty_name }}</td>
                    <td>{{ $faculty->faculty_designation }}</td>
                    <td>{{ $faculty->department }}</td>
                    <td>{{ $faculty->faculty_status }}</td>
                    <td>{{ $faculty->faculty_id_no }}</td>
                    <td>{{ $faculty->gender }}</td>
                    <td>{{ $faculty->faculty_email }}</td>
                    <td>{{ $faculty->faculty_contact_no }}</td>
                    <td>{{ $faculty->hostel_name }}</td>
                    <td>{{ $faculty->floor_no }}</td>
                    <td>{{ $faculty->room_no }}</td>
                    <td>{{ $faculty->it_services }}</td>
                    <td>{{ $faculty->accepted ? 'Yes' : 'No' }}</td>
                    <td>{{ $faculty->created_at }}</td>
                    <td><a href="{{ route('faculty-it-services.show', $faculty->id) }}" class="btn btn-primary btn-sm">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
