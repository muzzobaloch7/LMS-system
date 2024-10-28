@extends('layout.itadminlayout')
                @section('quantity')
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        
                        <div class="col-md-6 text-center mb-3">
                            <a href="{{ route('student-it-services.pending') }}" class="alert alert-warning shadow-sm d-inline-block" role="alert" style="background-color: cyan; color: black;  width: 100%; padding: 40px 20px; text-decoration: none;">
                                <i class="fas fa-user-graduate" style="font-size: 2rem;"></i> 
                                <div class="mt-2">Total Pending Students Record: <b>{{ $students->where('accepted', false)->count() }}</b> students</div>
                            </a>
                        </div>
                        <div class="col-md-6 text-center mb-3">
                            <a href="{{ route('faculty-it-services.pending') }}" class="alert alert-warning shadow-sm d-inline-block" role="alert" style="background-color: cyan; color: black;  width: 100%; padding: 40px 20px; text-decoration: none;">
                                <i class="fas fa-chalkboard-teacher" style="font-size: 2rem;"></i> 
                                <div class="mt-2">Total Pending Staff Record: <b>{{ $facultys->where('accepted', false)->count() }}</b> staff members</div>
                            </a>
                        </div>
                        <div class="col-md-6 text-center mb-3">
                            <a href="{{ route('student-it-services.accepted') }}" class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: #0b2f72; color: white;  width: 100%; padding: 40px 20px; text-decoration: none;">
                                <i class="fas fa-user-graduate" style="font-size: 2rem;"></i> 
                                <div class="mt-2">Total Accepted Students Record: <b>{{ $students->where('accepted',true)->count() }}</b> students</div>
                            </a>
                        </div>
                        <div class="col-md-6 text-center mb-3">
                            <a href="{{ route('faculty-it-services.accepted') }}" class="alert alert-info shadow-sm d-inline-block" role="alert" style="background-color: #0b2f72; color: white;  width: 100%; padding: 40px 20px; text-decoration: none;">
                                <i class="fas fa-chalkboard-teacher" style="font-size: 2rem;"></i> 
                                <div class="mt-2">Total Accepted Staff Record: <b>{{ $facultys->where('accepted',true)->count() }}</b> staff members</div>
                            </a>
                        </div>
                    </div>
                </div>
                @endsection
  





<!-- 

<h1 class="mt-5 mb-2" style="text-align: center">Record Of Faculty</h1>

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
                <td>@if( $faculty->accepted )
                    Yes
                    @endif
                    @if( !$faculty->accepted )
                    No
                    @endif
                </td>
                <td>{{ $faculty->created_at }}</td>
                <td><a href="{{ route('faculty-it-services.show', $faculty->id) }}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h1 class="mt-5 mb-2" style="text-align: center">Non-Accepted Record Of Faculty</h1>

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
                <th>Submission Time</th>
                <th>View faculty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facultys->where('accepted', false) as $faculty)
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
                <td>{{ $faculty->created_at }}</td>
                <td><a href="{{ route('faculty-it-services.show', $faculty->id) }}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h1 class="mt-5 mb-2" style="text-align: center">Record Of Student</h1>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Registration No</th>
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
                <th>Submission Time</th>
                <th>View Student</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->registration_no }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->student_id_no }}</td>
                <td>
                    @if($student->department == 1)
                        Computer Science
                    @elseif($student->department == 2)
                        Commerce
                    @elseif($student->department == 3)
                        Education
                    @elseif($student->department == 4)
                        BBA
                    @elseif($student->department == 5)
                        Chemistry
                    @elseif($student->department == 6)
                        English
                    @elseif($student->department == 7)
                        Economics
                    @endif
                </td>
                <td>
                    @if($student->degree_program == 1)
                        BSIT
                    @elseif($student->degree_program == 2)
                        BSDS
                    @elseif($student->degree_program == 3)
                        B.ED
                    @elseif($student->degree_program == 4)
                        B.COM
                    @elseif($student->degree_program == 5)
                        BBA
                    @elseif($student->degree_program == 6)
                        BS.Chemistry
                    @elseif($student->degree_program == 7)
                        BS.English
                    @elseif($student->degree_program == 8)
                        BS.Economic
                    @endif
                </td>
                <td>{{ $student->current_semester }}</td>
                <td>{{ $student->duration }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->student_email }}</td>
                <td>{{ $student->student_contact_no }}</td>
                <td>{{ $student->hostel_name }}</td>
                <td>{{ $student->floor_no }}</td>
                <td>{{ $student->room_no }}</td>
                <td>@if( $student->accepted )
                    Yes
                    @endif
                    @if( !$student->accepted )
                    No
                    @endif
                </td>
                <td>{{ $student->created_at }}</td>
                <td><a href="{{ route('student-it-services.show', $student->id) }}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h1 class="mt-5 mb-2" style="text-align: center">Non-Accepted Record Of Student</h1>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Registration No</th>
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
                <th>Submission Time</th>
                <th>View Student</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students->where('accepted', false) as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->registration_no }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->student_id_no }}</td>
                <td>
                    @if($student->department == 1)
                        Computer Science
                    @elseif($student->department == 2)
                        Commerce
                    @elseif($student->department == 3)
                        Education
                    @elseif($student->department == 4)
                        BBA
                    @elseif($student->department == 5)
                        Chemistry
                    @elseif($student->department == 6)
                        English
                    @elseif($student->department == 7)
                        Economics
                    @endif
                </td>
                <td>
                    @if($student->degree_program == 1)
                        BSIT
                    @elseif($student->degree_program == 2)
                        BSDS
                    @elseif($student->degree_program == 3)
                        B.ED
                    @elseif($student->degree_program == 4)
                        B.COM
                    @elseif($student->degree_program == 5)
                        BBA
                    @elseif($student->degree_program == 6)
                        BS.Chemistry
                    @elseif($student->degree_program == 7)
                        BS.English
                    @elseif($student->degree_program == 8)
                        BS.Economic
                    @endif
                </td>
                <td>{{ $student->current_semester }}</td>
                <td>{{ $student->duration }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->student_email }}</td>
                <td>{{ $student->student_contact_no }}</td>
                <td>{{ $student->hostel_name }}</td>
                <td>{{ $student->floor_no }}</td>
                <td>{{ $student->room_no }}</td>
                <td>{{ $student->created_at }}</td>
                <td><a href="{{ route('student-it-services.show', $student->id) }}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

 -->
