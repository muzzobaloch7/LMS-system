<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <title>Student ID Card Form</title>
  <style>
    .photo-preview {
      display: none;
      margin-top: 10px;
      max-width: 200px;
      max-height: 200px;
      border-radius: 10px; /* Apply border radius */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Apply box shadow for 3D effect */
      border: 2px solid #0b2f72; /* Add border for separation */
    }
    .photo-upload-container {
      border-radius: 15px; /* Apply border radius */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Apply box shadow for 3D effect */
      padding: 20px; /* Add some padding */
      background-color: #fff; /* Ensure background color is white */
      border: 2px solid #0b2f72; /* Add dark black border */
    }
    .photo-container {
      border-radius: 15px; /* Apply border radius */
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Apply box shadow for 3D effect */
      padding: 10px; /* Add some padding */
      background-color: #f9f9f9; /* Light background for separation */
      margin-top: 10px; /* Space above the photo container */
    }
  </style>
  <script>
    function previewPhoto(event) {
      const photoPreview = document.getElementById('photo-preview');
      photoPreview.src = URL.createObjectURL(event.target.files[0]);
      photoPreview.style.display = 'block';
    }
  </script>
</head>
<body>
  <section class="header-section text-center mb-4">
    <div>
      <img class="uni-logo" style =" width:200px; left:3px;" src="{{asset('images/ug-logo.png')}}" alt="University Logo" class="img-fluid">
    </div>
    <div class="title-div">
      <h2>UNIVERSITY OF GWADAR</h2>
      <h3>STUDENT IDENTITY CARD FORM</h3>
    </div>
  </section>
    
 
  <section class="form-section container photo-upload-container mb-4 ">
    <form action="{{route('studentrecords.store')}}" enctype="multipart/form-data" method="post">
      @csrf
      @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session('alert'))
    <div class="alert alert-{{ session('alert.type') }} alert-dismissible fade show" role="alert">
        {{ session('alert.message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class=" text-center mb-3">
        <img id="photo-preview" class="photo-preview" alt="Photo Preview" style="display: block; margin: 0 auto;">
      </div>
      <div class="row mb-3 ">
        <div class="col-md-6 ">
          <label for="photo" class="form-label">Upload Photo:</label>
          <input type="file" id="photo" name="photo" class="form-control" accept="image/*" required onchange="previewPhoto(event)">
        </div>
        <div class="col-md-6">
          <label for="name" class="form-label">Name:</label>
          <input type="text" id="name" name="student_name" class="form-control" placeholder="Enter Your Name" value="{{Auth::user()->name}}" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="relationship_status" class="form-label">Relationship Status:</label>
          <select name="relationship_status" id="select" class="form-select" required>
            <option value="" selected disabled>Select your Relation</option>
            <option value="s/o">S/o</option>
            <option value="d/o">D/o</option>
            <option value="w/o">W/o</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="father-name" class="form-label">Father/Husband Name:</label>
          <input type="text" id="father-name" name="father_husband" class="form-control" placeholder="Enter Your Father/Husband Name" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="department" class="form-label">Department:</label>
          <select class="form-select" id="department" name="department" required>
            <option value="" selected disabled>Select Department</option>
            <option value="1">Computer Science</option>
            <option value="2">Management Science</option>
            <option value="3">Education</option>
            <option value="4">Economics</option>
            <option value="5">English</option>
            <option value="6">Chemistry</option>
            <option value="7">Commerce</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="session" class="form-label">Session:</label>
          <input type="text" id="session" name="duration" class="form-control" placeholder="2021-2024" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="student_id" class="form-label">Enrollment No:</label>
          <input type="text" id="student_id" name="student_id_no" class="form-control" placeholder="Enter Your Roll Number">
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">E-mail:</label>
          <input type="email" id="email" name="student_email" class="form-control" placeholder="Enter Your Email e.g example@gmail.com" value="{{Auth::user()->email}}" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="dob" class="form-label">Date of Birth:</label>
          <input type="date" id="dob" name="student_dob" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label for="blood_group" class="form-label">Blood Group:</label>
          <input type="text" id="blood_group" name="student_bg" class="form-control" placeholder="Enter Your Blood Group" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="contact_no" class="form-label">Contact No:</label>
          <input type="tel" id="contact_no" name="student_contact_no" class="form-control" placeholder="Enter Your Contact Number" required>
        </div>
        <div class="col-md-6">
          <label for="emergency_contact_no" class="form-label">Emergency Contact No:</label>
          <input type="tel" id="emergency_contact_no" name="student_emergency_contact_no" class="form-control" placeholder="Enter Your Emergency Number" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="address" class="form-label">Address:</label>
          <input type="text" id="address" name="student_address" class="form-control" placeholder="Enter Your Complete Address" required>
        </div>
        <div class="col-md-6">
          <label for="nic_no" class="form-label">National Identity Card No:</label>
          <input type="number" id="nic_no" name="student_nic_no" class="form-control" placeholder="Enter your NIC Number" required>
        </div>
      </div>
      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{ route('student')}}" class='btn btn-secondary'>Back</a>
      
    </form>
  </section>

  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
