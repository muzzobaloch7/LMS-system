<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <title>Faculty IT Services Card Form</title>
</head>
<body>
  <section class="header-section text-center mb-4">
    <div>
    <img class="uni-logo" style =" width:400px; left:3px;" src="{{asset('images/ug-logo.png')}}" alt="University Logo" class="img-fluid">
    </div>
    <div class="title-div">
      <h1>UNIVERSITY OF GWADAR</h1>
      <h2>Faculty IT SERVICES FORM</h2>
    </div>
  </section>

  <section class="form-section container">
    <form action="{{ route('faculty-it-services.store') }}" method="post">
      @csrf
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Full Name:</label>
          <input type="text" id="name" name="faculty_name" class="form-control" placeholder="Enter Your Name" value="{{Auth::user()->name}}" required>
        </div>
        <div class="col-md-6">
          <label for="faculty_designation" class="form-label">Faculty Designation:</label>
          <input type="text" id="faculty_designation" name="faculty_designation" class="form-control" placeholder="Enter Your Designation" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="department" class="form-label">Department:</label>
          <input type="text" id="department" name="department" class="form-control" placeholder="Enter Your Department Name e.g Computer Science" required>
        </div>
        <div class="col-md-6">
          <label for="faculty_status" class="form-label">Faculty Status:</label>
          <select name="faculty_status" id="faculty_status" class="form-select" required>
            <option value="">Select Faculty Status</option>
            <option value="Regular">Regular</option>
            <option value="Contractual">Contractual</option>
            <option value="Temporary">Temporary</option>
            <option value="Other">Other</option>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="faculty_id_no" class="form-label">Faculty Id Card Number:</label>
          <input type="text" name="faculty_id_no" id="faculty_id_no" class="form-control" placeholder="Enter Your Id Card Number" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Gender:</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" required>
            <label class="form-check-label" for="gender_male">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" required>
            <label class="form-check-label" for="gender_female">Female</label>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="email" class="form-label">E-mail:</label>
          <input type="email" id="email" name="faculty_email" class="form-control" placeholder="Enter Your Email e.g example@gmail.com" value="{{Auth::user()->email}}" required>
        </div>
        <div class="col-md-6">
          <label for="contact_no" class="form-label">Contact No:</label>
          <input type="tel" id="contact_no" name="faculty_contact_no" class="form-control" placeholder="Enter Your Contact Number" required>
        </div>
      </div>

      <h4>For Hostel Faculty</h4>
      <div class="hostel-div mb-3">
        <div class="row">
          <div class="col-md-4">
            <label for="hostel_name" class="form-label">Hostel Name:</label>
            <input type="text" name="hostel_name" id="hostel_name" class="form-control" >
          </div>
          <div class="col-md-4">
            <label for="floor_no" class="form-label">Floor No:</label>
            <input type="number" name="floor_no" id="floor_no" class="form-control" >
          </div>
          <div class="col-md-4">
            <label for="room_no" class="form-label">Room No:</label>
            <input type="number" name="room_no" id="room_no" class="form-control" >
          </div>
        </div>
      </div>

      <h4>Please Tick The Service Required</h4>
      <div class="it-services mb-3 d-flex justify-content-center">
        <div class="form-check me-3">
          <input class="form-check-input" type="checkbox" id="internet_user_id" name="services_1" value="Internet-user-ID">
          <label class="form-check-label" for="internet_user_id">Internet user ID</label>
        </div>
        <div class="form-check me-3">
          <input class="form-check-input" type="checkbox" id="turnit_account" name="services_3" value="Turnit-Account">
          <label class="form-check-label" for="turnit_account">Turnit Account</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="microsoft_360_account" name="services_4" value="Microsoft_360-Account">
          <label class="form-check-label" for="microsoft_360_account">Microsoft 360 Account</label>
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{ route('staff') }}" class="btn btn-secondary">Back</a>
    </form>
  </section>

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
