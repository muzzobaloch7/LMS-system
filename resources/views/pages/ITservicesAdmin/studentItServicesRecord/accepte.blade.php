@extends('layout.itadminlayout')

@section('content')
<h1 class="text-center my-5">Accepted Records Of Student</h1>

 <!-- Search Form -->
 <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('student-it-services.asearch') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search Student records..." aria-label="Search Student records" aria-describedby="button-addon2">
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
                <th>Id</th>
                <th>Registration No</th>
                <th>Student Name</th>
                <th>Student Roll no</th>
                <th>Student Email</th>
                <th>Student Contact No</th>
                <th>Accepted</th>
                <th>Submission Time</th>
                <th>View Student</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            @if($student->accepted==1)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->registration_no }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->student_id_no }}</td>
                
                <td>{{ $student->student_email }}</td>
                <td>{{ $student->student_contact_no }}</td>
                <td>@if( $student->accepted )
                    Yes
                    @endif
                    @if( !$student->accepted )
                    No
                    @endif
                </td>
                <td>{{ $student->created_at }}</td>
                <td class="d-flex flex-column flex-start row-gap-2"> 
                    <a href="{{ route('student-it-services.show', $student->id) }}" class="btn btn-info btn-sm">View Details</a>
                    
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $students->links() }}
    </div>
</div>

@endsection

