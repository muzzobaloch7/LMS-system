@extends('layout.idcardadminlayout')


@section('content')

<h1 class="text-center my-5">Accepted Records Of Student</h1>

 <!-- Search Form -->
 <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('studentrecords.asearch') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search student records..." aria-label="Search student records" aria-describedby="button-addon2">
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
                <th>Student Id no</th>
                <th>Student Email</th>
                <th>Student Contact No</th>
                <th>Accepted</th>
                <th>Submission Time</th>
                <th>View Student</th>
            </tr>
        </thead>
        <tbody>
          @foreach($acceptedStudents as $student)
          @if($student->accepted==1)
            <tr>
                <td>{{ $student->id }}</td>
                <td><img class="img-fluid " src="{{ asset('/storage/'.$student->student_photo) }}" alt="student photo"></td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->relationship_status }}</td>
                <td>{{ $student->father_husband }}</td>
                <td>{{ $student->student_id_no }}</td>
                <td>{{ $student->student_email }}</td>
                <td>{{ $student->student_contact_no }}</td>
                <td>{{ $student->accepted ? 'Yes' : 'No' }}</td>
                <td>{{ $student->created_at }}</td>
                <td class="d-flex flex-column flex-start row-gap-2"> 
                    <a href="{{ route('studentrecords.show', $student->id) }}" class="btn btn-info btn-sm">View Details</a>
                    
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection
