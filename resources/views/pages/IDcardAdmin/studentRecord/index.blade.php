
@extends('layout.idcardadminlayout')

@section('title')
    Student Record
@endsection

@section('content')

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Student Name</th>
                <th>Relationship</th>
                <th>Father/Husband</th>
                <th>Department</th>
                <th>Duration</th>
                <th>Student Id no</th>
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
            @foreach($students as $student)
            @if($student->accepted == 1)
            <tr>
                <td>{{ $student->id }}</td>
                <td><img style="width: 75px; height: 75px;" src="{{ asset('/storage/'.$student->student_photo) }}" alt="student photo"></td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->relationship_status }}</td>
                <td>{{ $student->father_husband }}</td>
                <td>{{ $student->department }}</td>
                <td>{{ $student->duration }}</td>
                <td>{{ $student->student_id_no }}</td>
                <td>{{ $student->student_email }}</td>
                <td>{{ $student->student_dob }}</td>
                <td>{{ $student->student_bg }}</td>
                <td>{{ $student->student_contact_no }}</td>
                <td>{{ $student->student_emergency_contact_no }}</td>
                <td>{{ $student->student_address }}</td>
                <td>{{ $student->student_nic_no }}</td>
                <td>@if( $student->accepted )
                        Yes
                    @endif
                    @if( !$student->accepted )
                        No
                    @endif
                </td>
                <td>{{ $student->created_at}}</td>
                <td><a href="{{ route('studentrecords.show', $student->id) }}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection
