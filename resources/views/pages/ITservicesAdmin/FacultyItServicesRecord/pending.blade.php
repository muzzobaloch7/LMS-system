@extends('layout.itadminlayout')

@section('content')
<h1 class="text-center my-5">Pending Records Of Faculty</h1>

 <!-- Search Form -->
 <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('faculty-it-services.psearch') }}" method="GET" class="input-group">
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
            @if($faculty->accepted==0)
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
                <td>@if( $faculty->accepted )
                    Yes
                    @endif
                    @if( !$faculty->accepted )
                    No
                    @endif
                </td>
                <td>{{ $faculty->created_at }}</td>
                <td class="d-flex flex-column flex-start row-gap-2"> 
                    <a href="{{ route('faculty-it-services.show', $faculty->id) }}" class="btn btn-info btn-sm">View Details</a>
                    <a href="{{ route('faculty-it-services.sendMessage', ['id' => $faculty->user_id]) }}" class="btn btn-success mx-2">Message</a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection

