<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" >
  <title>Single Student Data</title>
  <style>
    .photo-preview {
      display: block;
      margin-top: 10px;
      max-width: 200px;
      max-height: 200px;
      border-radius: 10px; /* Apply border radius */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Apply box shadow for 3D effect */
      border: 2px solid #ccc; /* Add border for separation */
    }
    .photo-upload-container {
      border-radius: 15px; /* Apply border radius */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Apply box shadow for 3D effect */
      padding: 20px; /* Add some padding */
      background-color: #fff; /* Ensure background color is white */
    }
    .photo-container {
      border-radius: 15px; /* Apply border radius */
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Apply box shadow for 3D effect */
      padding: 10px; /* Add some padding */
      background-color: #f9f9f9; /* Light background for separation */
      margin-top: 10px; /* Space above the photo container */
    }
  </style>
</head>
<body>
  <section class="header-section text-center mb-4">
    <div>
      <img class="uni-logo" style =" width:400px; left:3px;" src="{{asset('images/ug-logo.png')}}" alt="University Logo" class="img-fluid">
    </div>
    <div class="title-div">
      <h1>UNIVERSITY OF GWADAR</h1>
      <h2>STUDENT IDENTITY CARD</h2>
    </div>
  </section>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
  @endif

  @if(session('reject'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('reject') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
  @endif

  <section class="form-section container photo-upload-container">
    <div class="text-center">
      <img src="{{ asset('/storage/'.$students->student_photo) }}" class="photo-preview" alt="Student Photo">
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Name:</strong> {{ $students->student_name }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>{{ $students->relationship_status }}:</strong> {{ $students->father_husband }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Department:</strong> 
        @switch($students->first()->department)
                @case(1)
                    Computer Science
                    @break
                @case(2)
                    Management Science
                    @break
                @case(3)
                Education
                    @break
                @case(4)
                Economics
                    @break
                @case(5)
                English
                    @break
                @case(6)
                Chemistry
                    @break
                @case(7)
                Commerce
                    @break
            @endswitch
      </p>
      </div>
      <div class="col-md-6">
        <p><strong>Session:</strong> {{ $students->duration }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Student ID:</strong> {{ $students->student_id_no }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>Email:</strong> {{ $students->student_email }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Date of Birth:</strong> {{ $students->student_dob }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>Blood Group:</strong> {{ $students->student_bg }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Contact No:</strong> {{ $students->student_contact_no }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>Emergency Contact No:</strong> {{ $students->student_emergency_contact_no }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Address:</strong> {{ $students->student_address }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>National Identity No:</strong> {{ $students->student_nic_no }}</p>
      </div>
    </div>
    @if($students->accepted === 0)
    <div class="button-container d-flex justify-content-center">
      <a href="{{ route('admin-panel.id-card-services') }}" class="btn btn-primary" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">Back</a>
      <button class="btn btn-success mx-2" type="button" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;" data-bs-toggle="modal" data-bs-target="#acceptModal">Accept</button>
      <button class="btn btn-danger " type="button" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
      </div>
    </div>
    @else
    <div class="button-container d-flex justify-content-center">
      <a href="{{ route('admin-panel.id-card-services') }}" class="btn btn-primary">Back</a>
    </div>
    @endif
  </section>

  <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="acceptModalLabel">Enter Rejection Reason</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('card-acception.message') }}" method="POST" class="p-4 border rounded bg-light shadow">
          @csrf
          <h4 class="mb-4 text-center">Send Message</h4>
          <div class="form-group mb-3">
              <label for="sender_name" class="form-label">Sender name:</label>
              <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{auth()->user()->name}}" required readonly>
          </div>
          <div class="form-group mb-3">
              <label for="reciever_id" class="form-label">Receiver ID:</label>
              <input type="text" class="form-control" id="reciever_id" name="reciever_id" value="{{$students->first()->user_id}}" required readonly>
          </div>
          <div class="form-group mb-3">
              <label for="message" class="form-label">Message:</label>
              <textarea class="form-control" id="message" name="message" rows="3" required>Your ID card request has been approved. Please come atfer 3 or 4 days to the clerk office with 200 rupees Fee</textarea>
          </div>
          <input type="hidden" name="id" value="{{$students->first()->id}}">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="submit" class="btn btn-primary">Send Message</button>
              <a href="{{ route('student-it-services.show', $students->first()->id) }}" class="btn btn-info">Back</a>
          </div>
      </form>
      </div>
    </div>
  </div> 

  <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Enter Rejection Reason</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('card-rejection.message') }}" method="POST" class="p-4 border rounded bg-light shadow">
          @csrf
          <h4 class="mb-4 text-center">Send Message</h4>
          <div class="form-group mb-3">
              <label for="sender_name" class="form-label">Sender name:</label>
              <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{auth()->user()->name}}" required>
          </div>
          <div class="form-group mb-3">
              <label for="reciever_id" class="form-label">Receiver ID:</label>
              <input type="text" class="form-control" id="reciever_id" name="reciever_id" value="{{$students->first()->user_id}}" required>
          </div>
          <div class="form-group mb-3">
              <label for="message" class="form-label">Message:</label>
              <textarea class="form-control" id="message" name="message" rows="3" required>Your ID card request has not been approved. Please review the requirements or contact clerk office for assistance.</textarea>
          </div>
          <input type="hidden" name="id" value="{{$students->first()->id}}">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="submit" class="btn btn-primary">Send Message</button>
              <a href="{{ route('student-it-services.show', $students->first()->id) }}" class="btn btn-info">Back</a>
          </div>
      </form>
      </div>
    </div>
  </div> 

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
