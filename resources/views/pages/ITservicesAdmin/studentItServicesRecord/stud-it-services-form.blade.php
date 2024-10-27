<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <title>Student IT Services Card Form</title>
  <style>
    .form-section {
      border-radius: 15px; /* Apply border radius */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Apply box shadow for 3D effect */
      padding: 20px; /* Add some padding */
      background-color: #fff; /* Ensure background color is white */
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
      <h2>STUDENT IT SERVICES FORM</h2>
    </div>
  </section>


  <section class="form-section container">
    
  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  @if(session('alert'))
    <div class="alert alert-{{ session('alert.type') }} alert-dismissible fade show" role="alert">
        {{ session('alert.message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
    <form action="{{ route('student-it-services.store') }}" method="post">
      @csrf
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="registration_no" class="form-label">Student Registration No:</label>
          <input type="text" name="registration_no" id="registration_no" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="name" class="form-label">Name:</label>
          <input type="text" id="name" name="student_name" class="form-control" placeholder="Enter Your Name" value="{{Auth::user()->name}}" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="student_id" class="form-label">Student Roll No:</label>
          <input type="text" id="student_id" name="student_id_no" class="form-control" placeholder="Enter Your Roll Number" required>
        </div>
        <div class="col-md-6">
          <label for="department" class="form-label">Department:</label>
          <select id="department" name="department" class="form-select" required>
            <option value="" selected disabled>Select Department</option>
            <option value="1" >Computer Science</option>
            <option value="2" >Management Science</option>
            <option value="3" >Education</option>
            <option value="4" >Economics</option>
            <option value="5" >English</option>
            <option value="6" >Chemistry</option>
            <option value="7" >Commerce</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="degree_program" class="form-label">Degree Program:</label>
          <select id="degree_program" name="degree_program" class="form-select" required>
            <option value="0" selected disabled>Select Program</option>
            <option value="1">BSIT</option>
            <option value="2">BSDS</option>
            <option value="3">B.ED</option>
            <option value="4">B.COM</option>
            <option value="5">BBA</option>
            <option value="6">BS.Chemistry</option>
            <option value="7">BS.English</option>
            <option value="8">BS.Economic</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="current-semester" class="form-label">Current Semester:</label>
          <input type="number" id="current-semester" name="current_semester" class="form-control" placeholder="Enter Your Current semester e.g 1" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="session" class="form-label">Session:</label>
          <input type="text" id="session" name="duration" class="form-control" placeholder="2021-2024" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Gender:</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender-male" value="male" required>
            <label class="form-check-label" for="gender-male">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender-female" value="female" required>
            <label class="form-check-label" for="gender-female">Female</label>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="email" class="form-label">E-mail:</label>
          <input type="email" id="email" name="student_email" class="form-control" placeholder="Enter Your Email e.g example@gmail.com" value="{{Auth::user()->email}}" required>
        </div>
        <div class="col-md-6">
          <label for="contact_no" class="form-label">Contact No:</label>
          <input type="tel" id="contact_no" name="student_contact_no" class="form-control" placeholder="Enter Your Contact Number" required>
        </div>
      </div>

      <h4>For Hostel Students(if Applicable)</h4>
      <div class="hostel-div mb-3">
        <div class="row">
          <div class="col-md-4">
            <label for="for-host" class="form-label">Hostel Name (Boys/Girls):</label>
            <input type="text" name="hostel_name" id="for-host" class="form-control" >
          </div>
          <div class="col-md-4">
            <label for="floor-no" class="form-label">Floor No:</label>
            <input type="number" name="floor_no" id="floor-no" class="form-control" >
          </div>
          <div class="col-md-4">
            <label for="room-no" class="form-label">Room No:</label>
            <input type="number" name="room_no" id="room-no" class="form-control" >
          </div>
          <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
          
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{ route('student') }}" class="btn btn-secondary">Back</a>
    </form>
  </section>

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
