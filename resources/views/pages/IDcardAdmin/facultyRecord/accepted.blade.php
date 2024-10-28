@extends('layout.idcardadminlayout')


@section('content')

<h1 class="text-center my-5">Accepted Records Of Staff</h1>

 <!-- Search Form -->
 <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('facultyrecords.asearch') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search Staff records..." aria-label="Search Staff records" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
    </div>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Student Name</th>
                <th>Relationship</th>
                <th>Father/Husband</th>
                <th>Department</th>
                <th>Duration</th>
                <th>Student Id No</th>
                <th>Student Email</th>
                <th>Student DoB</th>
                <th>Student Blood Group</th>
                <th>Student Contact No</th>
                <th>Student Emergency No</th>
                <th>Student Address</th>
                <th>Student NIC No</th>
                <th>Accepted</th>
                <th>Submission Time</th>
                <th>View Student</th>
            </tr>
        </thead>
        <tbody>
          @foreach($acceptedStaffs as $staff)
          @if($staff->accepted==1)
            <tr>
                <td>{{ $staff->id }}</td>
                <td><img class="img-fluid " src="{{ asset('/storage/'.$staff->staff_photo) }}" alt="staff photo"></td>
                <td>{{ $staff->staff_name }}</td>
                <td>{{ $staff->relationship_status }}</td>
                <td>{{ $staff->father_husband }}</td>
                <td>{{ $staff->department }}</td>
                <td>{{ $staff->duration }}</td>
                <td>{{ $staff->staff_id_no }}</td>
                <td>{{ $staff->staff_email }}</td>
                <td>{{ $staff->staff_dob }}</td>
                <td>{{ $staff->staff_bg }}</td>
                <td>{{ $staff->staff_contact_no }}</td>
                <td>{{ $staff->staff_emergency_contact_no }}</td>
                <td>{{ $staff->staff_address }}</td>
                <td>{{ $staff->staff_nic_no }}</td>
                <td>{{ $staff->accepted ? 'Yes' : 'No' }}</td>
                <td>{{ $staff->created_at }}</td>
                <td class="d-flex flex-column flex-start row-gap-2"> 
                    <a href="{{ route('facultyrecords.show', $staff->id) }}" class="btn btn-info btn-sm">View Details</a>
                    <a href="{{ route('faculty.sendMessage', ['id' => $staff->user_id]) }}" class="btn btn-success mx-2">Message</a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection
