@extends('layout.itadminLayout')

@section('main-title')
    Student Records
@endsection
@section('title')
Student Records
@endsection
@section('quantity')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <div class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: #0b2f72; color: white; margin-right: 10px;">
                <i class="fas fa-user-graduate"></i> Total Students Record: {{ $students->count() }} students
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<h1 style="text-align: center">Record Of Students</h1>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Id </th>
                    <th>Registration No </th>
                    <th>Student Name</th>
                    <th>Student Roll no</th>
                    <th>Department</th>
                    <th>Degree Program</th>
                    <th>Current Semester</th>
                    <th>Duration</th>
                    <th>Gender</th>
                    <th>Student Email</th>
                    <th>Student Contact No</th>
                    <th>Hostel Name</th>
                    <th>Floor No</th>
                    <th>Room No</th>
                    <th>Accepted</th>
                    <th>Submission time</th>
                    <th>View Student</th>
                </tr>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->registration_no }}</td>
                    <td>{{ $student->student_name }}</td>
                    <td>{{ $student->student_id_no }}</td>
                    <td>{{ $student->department }}</td>
                    <td>{{ $student->current_semester }}</td>
                    <td>{{ $student->degree_program }}</td>
                    <td>{{ $student->duration }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->student_email }}</td>
                    <td>{{ $student->student_contact_no }}</td>
                    <td>{{ $student->hostel_name }}</td>
                    <td>{{ $student->floor_no }}</td>
                    <td>{{ $student->room_no }}</td>
                    <td>{{ $student->accepted }}</td>
                    <td>{{ $student->created_at }}</td>
                    <td>
                        @if($student)
                            <a href="{{ route('student-it-services.show', $student->id) }}" class="btn btn-primary btn-sm">View</a>
                        @else
                            <span class="text-danger">Not found</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
            @endsection
