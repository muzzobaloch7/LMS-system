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
            @if($student->accepted==1)
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
                <td class="d-flex flex-column flex-start row-gap-2"> 
                    <a href="{{ route('student-it-services.show', $student->id) }}" class="btn btn-info btn-sm">View Details</a>
                    <a href="{{ route('student-it-services.sendMessage', ['id' => $student->user_id]) }}" class="btn btn-success mx-2">Message</a>
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
