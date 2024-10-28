<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" >
  <title>Single Staff Data</title>
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
      <h2>STAFF SERVICE CARD</h2>
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
      <img src="{{ asset('/storage/'.$staff->staff_photo) }}" class="photo-preview" alt="Staff Photo">
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Name:</strong> {{ $staff->staff_name }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>{{ $staff->relationship_status }}:</strong> {{ $staff->father_husband }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Department:</strong> 
        @switch($staff->first()->department)
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
        <p><strong>Session:</strong> {{ $staff->duration }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
          <p><strong>Staff ID:</strong> {{ $staff->staff_id_no }}</p>
      </div>
      <div class="col-md-6">
          <p><strong>Email:</strong> {{ $staff->staff_email }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Date of Birth:</strong> {{ $staff->staff_dob }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>Blood Group:</strong> {{ $staff->student_bg }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Contact No:</strong> {{ $staff->student_contact_no }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>Emergency Contact No:</strong> {{ $staff->student_emergency_contact_no }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <p><strong>Address:</strong> {{ $staff->student_address }}</p>
      </div>
      <div class="col-md-6">
        <p><strong>National Identity No:</strong> {{ $staff->student_nic_no }}</p>
      </div>
    </div>
    @if($staff->accepted === 0)
    <div class="button-container d-flex justify-content-center">
      <a href="{{ route('admin-panel.id-card-services') }}" class="btn btn-primary">Back</a>
      <a href="{{ route('faculty.accept', $staff->id) }}" class="btn btn-success mx-3">Accept</a>
      <a href="{{ route('faculty.sendMessage', $staff->user_id) }}" class="btn btn-warning mx-3">Send Message</a>
      <form action="{{ route('faculty.destroy',[$staff->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Reject</button>
      </form>
    </div>
    @else
    <div class="button-container d-flex justify-content-center">
      <a href="{{ route('admin-panel.id-card-services') }}" class="btn btn-primary">Back</a>
    </div>
    @endif
  </section>

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
